<?php

namespace App\Http\Controllers;

use App\Models\Jobdesk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class SettingsController extends Controller
{
    /**
     * Display the settings overview.
     */
    public function index()
    {
        return view('Settings.index', [
            "judul" => "Settings",
            "role" => Jobdesk::all(),
        ]);
    }

    /**
     * Show the form for editing the user profile.
     */
    public function edit(Request $request)
    {


        return view('Settings.edit', [
            'judul' => 'Edit Profile',
            'role' => Jobdesk::all(),
        ]);
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Manual uniqueness check
        $existingUsername = User::where('username', $request->input('username'))
            ->where('id', '!=', $user->id)
            ->exists();

        $existingEmail = User::where('email', $request->input('email'))
            ->where('id', '!=', $user->id)
            ->exists();

        if ($existingUsername) {
            return redirect()->back()->withErrors(['username' => 'The username has already been taken.']);
        }

        if ($existingEmail) {
            return redirect()->back()->withErrors(['email' => 'The email has already been taken.']);
        }

        // Proceed with validation and update if no errors
        $request->validate([
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'NIP' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'no_wa' => 'nullable|string|max:20',
            'kelompok' => 'required|string',
            'jobdesk_id' => 'required|exists:jobdesks,id',
        ]);

        try {
            // Handle profile image update
            if ($request->hasFile('profile')) {
                if ($user->profile) {
                    Storage::delete('public/' . $user->profile);
                }

                $imagePath = $request->file('profile')->store('profiles', 'public');
                $user->profile = $imagePath;
            }

            // Handle no_hp and no_wa formatting: Convert numbers starting with 08 to 628
            $no_hp = $request->input('no_hp');
            $no_wa = $request->input('no_wa');

            if (!empty($no_hp) && Str::startsWith($no_hp, '08')) {
                $no_hp = '628' . substr($no_hp, 2);
            }

            if (!empty($no_wa) && Str::startsWith($no_wa, '08')) {
                $no_wa = '628' . substr($no_wa, 2);
            }

            // Update other user attributes
            $user->nama = $request->input('nama');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->NIP = $request->input('NIP');
            $user->no_hp = $no_hp;
            $user->no_wa = $no_wa;
            $user->kelompok = $request->input('kelompok');
            $user->jobdesk_id = $request->input('jobdesk_id');

            // Save updated user information
            $user->save();

            return redirect()->back()->with('status', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
    }

    /**
     * Show the form for changing the password.
     */
    public function changePassword()
    {
        return view('Settings.change', [
            'judul' => 'Change Password',
        ]);
    }

    /**
     * Update the user password.
     */
    public function updatePassword(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:4', 'confirmed'],
        ]);

        // Verifikasi apakah password lama yang diinput sesuai dengan yang ada di database
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password saat ini tidak sesuai.',
            ]);
        }

        // Update password baru di database
        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Redirect atau memberikan response
        return redirect()->route('settings.index')->with('success', 'Password berhasil diubah!');
    }

}
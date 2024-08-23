<?php

namespace App\Http\Controllers;

use App\Models\Jobdesk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
    public function update(Request $request, $username)
    {
        $user = Auth::user();

        // Validate request
        $request->validate([
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'NIP' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'no_wa' => 'nullable|string|max:20',
            'kelompok' => 'required|string',
            'jobdesk_id' => 'required|exists:roles,id',
        ]);

        try {
            // Update profile image if exists
            if ($request->hasFile('profile')) {
                // Delete old image if exists
                if ($user->profile) {
                    Storage::delete('public/' . $user->profile);
                }

                $imagePath = $request->file('profile')->store('profiles', 'public');
                $user->profile = $imagePath;
            }

            // Update other user attributes
            $user->nama = $request->input('nama');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->NIP = $request->input('NIP');
            $user->no_hp = $request->input('no_hp');
            $user->no_wa = $request->input('no_wa');
            $user->kelompok = $request->input('kelompok');
            $user->jobdesk_id = $request->input('jobdesk_id');

            $user->save();

            return redirect()->back()->with('status', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // Handle any errors that occur during the update
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
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Update user password
            $user = Auth::user();
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return redirect()->back()->with('status', 'Password updated successfully!');
        } catch (\Exception $e) {
            // Handle any errors that occur during the password update
            return redirect()->back()->with('error', 'Failed to update password. Please try again.');
        }
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jobdesk;
use App\Models\Penanggung;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PenanggungController extends Controller
{

    public function index()
    {
        $penanggung = User::where('kelompok', 'Tamu')
            ->whereHas('jobdesks', function ($query) {
                $query->where('role', 'Penanggung Jawab');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // Tambahkan titik koma di akhir baris ini

        return view('Penanggung.index', [
            "judul" => "Penanggung Jawab",
            "users" => $penanggung,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Penanggung.create', [
            "judul" => "Penanggung Jawab",
            "jobs" => Jobdesk::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'NIP' => 'required|string|max:255|unique:users,NIP',
            'no_hp' => 'required|string|max:15|unique:users,no_hp',
            'no_wa' => 'required|string|max:15|unique:users,no_wa',
            'kelompok' => 'required|string',
            'jobdesk_id' => 'required|exists:jobdesks,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle no_hp and no_wa formatting
        $validatedData['no_hp'] = str_replace('08', '628', $validatedData['no_hp']);
        $validatedData['no_wa'] = str_replace('08', '628', $validatedData['no_wa']);

        // Handle file upload if there is a profile image
        if ($request->hasFile('profile')) {
            try {
                $profilePath = $request->file('profile')->store('profiles', 'public');
                $validatedData['profile'] = $profilePath;
            } catch (\Exception $e) {
                Log::error('Profile image upload failed: ' . $e->getMessage());
                return redirect()->back()->withInput()->withErrors(['error' => 'Profile image upload failed. Please try again.']);
            }
        }

        // Hash the password before saving
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Generate UUID for the user
        $validatedData['id'] = (string) Str::uuid();

        // Log the validated data for debugging
        Log::info('Validated Data: ', $validatedData);

        // Attempt to save the user and handle errors
        try {
            $user = User::create($validatedData);
            return redirect()->route('penanggung-jawab.index')->with('success', 'User successfully created.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('User creation failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create user. Please try again later.']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('Penanggung.show', [
            "judul" => "Penanggung Jawab",
            "user" => $user,
            "jobs" => Jobdesk::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('Penanggung.edit', [
            "judul" => "Penanggung Jawab",
            "user" => $user,
            "jobs" => Jobdesk::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $username)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $username . ',username',
            'NIP' => 'required|string|max:255|unique:users,NIP,' . $username . ',username',
            'no_hp' => 'required|string|max:15|unique:users,no_hp,' . $username . ',username',
            'no_wa' => 'required|string|max:15|unique:users,no_wa,' . $username . ',username',
            'kelompok' => 'required|string',
            'jobdesk_id' => 'required|exists:jobdesks,id',
            'email' => 'required|email|unique:users,email,' . $username . ',username',
            'password' => 'nullable|min:4',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle no_hp and no_wa formatting
        $validatedData['no_hp'] = str_replace('08', '628', $validatedData['no_hp']);
        $validatedData['no_wa'] = str_replace('08', '628', $validatedData['no_wa']);

        // Find the user by username
        $user = User::where('username', $username)->firstOrFail();

        // Handle file upload if there is a profile image
        if ($request->hasFile('profile')) {
            try {
                // Delete old profile image if it exists
                if ($user->profile) {
                    Storage::disk('public')->delete($user->profile);
                }

                // Store the new profile image
                $profilePath = $request->file('profile')->store('profiles', 'public');
                $validatedData['profile'] = $profilePath;
            } catch (\Exception $e) {
                Log::error('Profile image upload failed: ' . $e->getMessage());
                return redirect()->back()->withInput()->withErrors(['error' => 'Profile image upload failed. Please try again.']);
            }
        }

        // Update the password if provided
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            // Remove password from the data array if not provided
            unset($validatedData['password']);
        }

        // Update the user's record
        try {
            $user->update($validatedData);
            return redirect()->route('penanggung-jawab.index')->with('success', 'User successfully updated.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('User update failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update user. Please try again later.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username)
    {
        // Find the user by username
        $user = User::where('username', $username)->firstOrFail();

        try {
            // Delete the user's profile image if it exists
            if ($user->profile) {
                Storage::disk('public')->delete($user->profile);
            }

            // Delete the user
            $user->delete();

            // Redirect with success message
            return redirect()->route('penanggung-jawab.index')->with('success', 'User successfully deleted.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('User deletion failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'Failed to delete user. Please try again later.']);
        }
    }
}
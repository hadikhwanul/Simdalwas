<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Jobdesk;
use App\Models\Tagihan;
use App\Models\Penanggung;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenanggungController extends Controller
{

    public function index()
    {
        $penanggung = User::where('kelompok', 'Tamu')
            ->whereHas('jobdesks', function ($query) {
                $query->where('role', 'Penanggung Jawab');
            })
            ->latest()
            ->get(); // Tambahkan titik koma di akhir baris ini

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

    public function daftartagih()
    {
        $tagihans = Tagihan::latest()
            ->paginate(10);


        return view('Tagihan.index', [
            "judul" => "Pengembalian Dana",
            "tagihan" => $tagihans,
        ]);
    }
    public function daftarpembayaran($slug)
    {
        // Find the Tagihan by slug or throw a 404 error
        $tagihan = Tagihan::where('slug', $slug)->firstOrFail();

        $pembayaran = Pembayaran::where('tagihan_id', $tagihan->id)->latest()->get();

        return view('Tagihan.show', [
            "judul" => "Pengembalian Dana",
            "tagih" => $tagihan,
            "pembayaran" => $pembayaran,
        ]);
    }

    public function formbayar($slug)
    {
        $tagihan = Tagihan::where('slug', $slug)->firstOrFail();

        return view('Tagihan.create', [
            "judul" => "Pengembalian Dana",
            "tagih" => $tagihan,
        ]);
    }
    public function storebayar(Request $request, $slug)
    {
        // Validasi input
        $validatedData = $request->validate([
            'bayar_rugi' => 'nullable|numeric|min:0',
            'bayar_wajib' => 'nullable|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'resi' => 'required|file|image|max:2048', // Max 2MB image file
        ]);

        // Cari tagihan berdasarkan slug
        $tagihan = Tagihan::where('slug', $slug)->firstOrFail();

        try {
            // Proses upload file resi
            if ($request->hasFile('resi')) {
                $resiPath = $request->file('resi')->store('resi_pembayaran', 'public');
            }

            // Membuat slug yang unik
            $slugBase = Str::slug('pembayaran-' . $tagihan->slug . '-' . now()->timestamp);
            $slugPembayaran = $slugBase;

            // Cek jika slug sudah ada, jika ada, tambahkan angka di belakangnya
            $counter = 1;
            while (Pembayaran::where('slug', $slugPembayaran)->exists()) {
                $slugPembayaran = $slugBase . '-' . $counter;
                $counter++;
            }

            // Simpan pembayaran
            Pembayaran::create([
                'slug' => $slugPembayaran,
                'tagihan_id' => $tagihan->id,
                'bayar_rugi' => $validatedData['bayar_rugi'] ?? 0,
                'bayar_wajib' => $validatedData['bayar_wajib'] ?? 0,
                'tanggal_bayar' => $validatedData['tanggal_bayar'],
                'status' => 'Menunggu Konfirmasi',
                'resi' => $resiPath ?? null,  // Menyimpan path resi
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('daftar.bayar', ['tagihan' => $tagihan->slug])
                ->with('success', 'Pembayaran berhasil disimpan, menunggu konfirmasi.');
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan pembayaran: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }



    public function formeditbayar($slug, $bayaranslug)
    {
        // Log the incoming parameters for debugging
        Log::info('Slug: ' . $slug . ' Bayaranslug: ' . $bayaranslug);

        // Retrieve tagihan by slug
        $tagihan = Tagihan::where('slug', $slug)->first();
        // Log to check if tagihan is found
        Log::info('Tagihan Found: ' . ($tagihan ? 'Yes' : 'No'));

        // Retrieve pembayaran by slug
        $pembayaran = Pembayaran::where('slug', $bayaranslug)->first();
        // Log to check if pembayaran is found
        Log::info('Pembayaran Found: ' . ($pembayaran ? 'Yes' : 'No'));

        // Check if either tagihan or pembayaran is not found
        if (!$tagihan || !$pembayaran) {
            Log::error('Tagihan or Pembayaran not found!');
            return abort(404, 'Data not found');
        }

        // Pass data to the view
        return view('Tagihan.edit', [
            'judul' => 'Edit Pembayaran',
            'pembayaran' => $pembayaran,
            'tagihan' => $tagihan,
        ]);
    }




    public function updatebayar(Request $request, $slug, $bayaranslug)
    {
        // Validasi input
        $validatedData = $request->validate([
            'bayar_rugi' => 'nullable|numeric|min:0',
            'bayar_wajib' => 'nullable|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'resi' => 'nullable|file|image|max:2048', // Optional resi file (max 2MB image)
        ]);

        try {
            // Cari tagihan dan pembayaran berdasarkan slug
            $tagihan = Tagihan::where('slug', $slug)->firstOrFail();
            $pembayaran = Pembayaran::where('slug', $bayaranslug)->firstOrFail();

            // Jika ada file resi yang diupload, proses upload file
            if ($request->hasFile('resi')) {
                // Hapus file lama jika ada
                if ($pembayaran->resi && Storage::exists('public/' . $pembayaran->resi)) {
                    Storage::delete('public/' . $pembayaran->resi);
                }

                // Upload file resi baru
                $resiPath = $request->file('resi')->store('resi_pembayaran', 'public');
            } else {
                // Jika tidak ada file baru, gunakan file lama (tidak diubah)
                $resiPath = $pembayaran->resi;
            }

            // Update pembayaran dengan data baru
            $pembayaran->update([
                'bayar_rugi' => $validatedData['bayar_rugi'] ?? $pembayaran->bayar_rugi,
                'bayar_wajib' => $validatedData['bayar_wajib'] ?? $pembayaran->bayar_wajib,
                'tanggal_bayar' => $validatedData['tanggal_bayar'],
                'resi' => $resiPath, // Menyimpan path resi baru atau lama
                'status' => 'Menunggu Konfirmasi', // Status bisa diubah sesuai kebutuhan
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('daftar.bayar', ['tagihan' => $tagihan->slug])
                ->with('success', 'Pembayaran berhasil diperbarui, menunggu konfirmasi.');

        } catch (\Exception $e) {
            // Log error dan kembalikan pesan kesalahan
            Log::error('Error saat memperbarui pembayaran: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
    public function destroypembayaran($slug, $bayaranslug)
    {
        try {
            // Cari tagihan dan pembayaran berdasarkan slug
            $tagihan = Tagihan::where('slug', $slug)->firstOrFail();
            $pembayaran = Pembayaran::where('slug', $bayaranslug)->firstOrFail();

            // Hapus file resi jika ada
            if ($pembayaran->resi && Storage::exists('public/' . $pembayaran->resi)) {
                Storage::delete('public/' . $pembayaran->resi);
            }

            // Hapus pembayaran
            $pembayaran->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('daftar.bayar', ['tagihan' => $tagihan->slug])
                ->with('success', 'Pembayaran berhasil dihapus.');

        } catch (\Exception $e) {
            // Log error dan kembalikan pesan kesalahan
            Log::error('Error saat menghapus pembayaran: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function daftarvalidasi($slug)
    {
        // Find the Tagihan by slug or throw a 404 error
        $tagihan = Tagihan::where('slug', $slug)->firstOrFail();

        $pembayaran = Pembayaran::where('tagihan_id', $tagihan->id)->latest()->get();

        return view('Validasi.index', [
            "judul" => "Pengembalian Dana",
            "tagih" => $tagihan,
            "pembayaran" => $pembayaran,
        ]);
    }

    public function formvalidasi($slug, $bayaranslug)
    {
        // Log the incoming parameters for debugging
        Log::info('Slug: ' . $slug . ' Bayaranslug: ' . $bayaranslug);

        // Retrieve tagihan by slug
        $tagihan = Tagihan::where('slug', $slug)->first();
        // Log to check if tagihan is found
        Log::info('Tagihan Found: ' . ($tagihan ? 'Yes' : 'No'));

        // Retrieve pembayaran by slug
        $pembayaran = Pembayaran::where('slug', $bayaranslug)->first();
        // Log to check if pembayaran is found
        Log::info('Pembayaran Found: ' . ($pembayaran ? 'Yes' : 'No'));

        // Check if either tagihan or pembayaran is not found
        if (!$tagihan || !$pembayaran) {
            Log::error('Tagihan or Pembayaran not found!');
            return abort(404, 'Data not found');
        }

        // Pass data to the view
        return view('Validasi.edit', [
            'judul' => 'Pengembalian Dana',
            'pembayaran' => $pembayaran,
            'tagihan' => $tagihan,
        ]);
    }

    public function validasipembayaran(Request $request, $tagihanSlug, $bayaranslug)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:Menunggu Konfirmasi,Pembayaran Ditolak,Pembayaran Sukses',
        ]);

        // Ambil data pembayaran berdasarkan slug
        $pembayaran = Pembayaran::where('slug', $bayaranslug)->firstOrFail();

        // Ambil data tagihan terkait berdasarkan slug
        $tagihan = Tagihan::where('slug', $tagihanSlug)->firstOrFail();

        // Perbarui status pembayaran
        $pembayaran->status = $request->status;

        // Jika status adalah "Pembayaran Berhasil", perbarui sisa dan bayar pada tagihan
        if ($request->status === 'Pembayaran Sukses') {
            // Update sisa kerugian dan kewajiban
            $tagihan->sisa_kerugian = max(0, $tagihan->sisa_kerugian - $pembayaran->bayar_rugi);
            $tagihan->bayar_kerugian += $pembayaran->bayar_rugi;

            $tagihan->sisa_kewajiban = max(0, $tagihan->sisa_kewajiban - $pembayaran->bayar_wajib);
            $tagihan->bayar_kewajiban += $pembayaran->bayar_wajib;

            $tagihan->save(); // Simpan perubahan pada tagihan
        }

        // Simpan perubahan pada pembayaran
        $pembayaran->save();

        // Redirect dengan pesan sukses
        return redirect()->route('daftar.valid', ['tagihan' => $tagihan->slug])->with('success', 'Data pembayaran berhasil diperbarui.');
    }

}
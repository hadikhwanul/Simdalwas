<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jobdesk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Jobdesk::create([
          'role' => 'SuperAdmin',  
        ]);
        Jobdesk::create([
          'role' => 'Admin',  
        ]);
        Jobdesk::create([
          'role' => 'Inspektur',  
        ]);
        Jobdesk::create([
          'role' => 'Sekretaris',  
        ]);
        Jobdesk::create([
          'role' => 'IRBAN',  
        ]);
        Jobdesk::create([
          'role' => 'Dalnis',  
        ]);
        Jobdesk::create([
          'role' => 'Anggota',  
        ]);
        Jobdesk::create([
          'role' => 'Staff',  
        ]);

        User::create([
            'id' => Str::uuid(), 
            'nama' => 'Hadi Ikhwanul Fuadi',
            'username' => 'hadi_ikhwanul',
            'NIP' => '225150209111002',
            'no_hp' => '081997963759',
            'no_wa' => '081997963759',
            'kelompok' => 'Admin',
            'jobdesk_id' => '1',
            'email' => 'hadikhwanul@gmail.com',
            'password' => bcrypt('hadi'),
        ]);

    }
}
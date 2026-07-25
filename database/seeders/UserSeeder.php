<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        $admin = User::create([
            'name'     => 'Administrator Warkop',
            'username' => 'admin_garasi',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'status'   => 'aktif', // Status langsung diaktifkan
        ]);

        // Pemasangan Role menggunakan fitur Spatie
        $admin->assignRole('admin');

        // 2. Buat Akun Karyawan
        $karyawan = User::create([
            'name'     => 'Karyawan Shift 1',
            'username' => 'karyawan_satu',
            'email'    => 'karyawan@gmail.com',
            'password' => Hash::make('password'),
            'status'   => 'aktif',
        ]);

        // Pemasangan Role menggunakan fitur Spatie
        $karyawan->assignRole('karyawan');
    }
}

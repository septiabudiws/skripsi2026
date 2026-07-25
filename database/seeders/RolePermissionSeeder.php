<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan cache Spatie agar tidak terjadi error duplikat saat dijalankan ulang
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. DAFTAR PERMISSION (Hak Akses)
        // Kita bedakan antara akses menu utama dan akses detail di dalam dashboard
        $permissions = [
            // Akses Sidebar Menu
            'akses dashboard',
            'akses kategori',
            'akses menu',
            'akses kriteria',
            'akses karyawan',
            'akses perankingan',
            'akses profile',
            'akses metode pembayaran',

            // Akses Detail di dalam Dashboard (Contoh Granular)
            'lihat ranking menu optimal',
            'lihat produk terlaris',
            'lihat change password',
            'lihat permissions',
        ];

        // Masukkan semua permission ke dalam database
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 2. PEMBUATAN ROLE DAN PEMBAGIAN PERMISSION

        // ROLE ADMIN: Diberikan semua akses tanpa terkecuali (Sapu Jagat)
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        // ROLE KARYAWAN: Hanya diberikan akses menu tertentu
        $roleKaryawan = Role::create(['name' => 'karyawan']);
        $roleKaryawan->givePermissionTo([
            'akses dashboard',
            'akses karyawan',
            'akses profile',
            // Misalnya karyawan boleh lihat jumlah pesanan, tapi tidak boleh lihat grafik uang
            'lihat change password',
        ]);
    }
}

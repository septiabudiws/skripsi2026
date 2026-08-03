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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Akses Sidebar Menu
            'akses_dashboard',
            'akses_kategori',
            'akses_menu',
            'akses_kriteria',
            'akses_karyawan',
            'akses_metode_pembayaran',
            'akses_perankingan',
            'akses_profile',
            'akses_pos',
            'transaksi_selesai',

            // Akses Detail di dalam Dashboard (Contoh Granular)
            'lihat_ranking_menu_optimal',
            'lihat_produk_terlaris',
            'lihat_chart',
            'lihat_permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleKaryawan = Role::create(['name' => 'karyawan']);
        $roleKaryawan->givePermissionTo([
            'akses_dashboard',
            'akses_pos',
            'akses_profile',
            'transaksi_selesai',
            'akses_metode_pembayaran',
        ]);
    }
}

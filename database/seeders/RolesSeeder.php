<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'Secretaria']);
        Role::firstOrCreate(['name' => 'Docente']);
        Role::firstOrCreate(['name' => 'Administrador'])
            ->givePermissionTo(Permission::all());
    }
}

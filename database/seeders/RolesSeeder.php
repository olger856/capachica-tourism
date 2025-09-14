<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrCreate(['name' => 'superadmin']);
        Role::updateOrCreate(['name' => 'admin']);
        Role::updateOrCreate(['name' => 'turista']);
    }
}

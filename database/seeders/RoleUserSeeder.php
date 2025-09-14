<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::find(1);
        $roleAdmin = Role::where('name', 'admin')->first();

        if ($user && $roleAdmin) {
            $user->roles()->attach($roleAdmin->id);
        }
    }
}

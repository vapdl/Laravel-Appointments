<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'         => 1,
                'title'      => 'Admin',
                'created_at' => '2023-04-30 12:08:28',
                'updated_at' => '2023-04-30 12:08:28',
            ],
            [
                'id'         => 2,
                'title'      => 'Médico',
                'created_at' => '2023-04-30 12:08:28',
                'updated_at' => '2023-04-30 12:08:28',
            ],
            [
                'id'         => 3,
                'title'      => 'Paciente',
                'created_at' => '2023-04-30 12:08:28',
                'updated_at' => '2023-04-30 12:08:28',
            ],
        ];

        Role::insert($roles);
    }
}

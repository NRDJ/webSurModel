<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $roles = [
            [1,'Administrador','admin'],
            [2,'Usuario','user'],
            [3,'Patrocinador','sponsor'],
            [4,'Trabajador','worker'], //cambiar nombre quizas
        ];

        $roles = array_map(function($role) use ($now) {
           return [
               'id' => $role[0],
               'name' => $role[1],
               'key' => $role[2],
               'updated_at' => $now,
               'created_at' => $now,
           ];
        }, $roles);

        \DB::table('roles')->insert($roles);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Super Admin',
               'email'=>'superadmin@simperdes.com',
               'role'=>4,
               'password'=> bcrypt('123456'),
               'foto'=>'uploads/users/foto/default.jpg'
            ],
            [
               'name'=>'Admin Pemda Kabupaten Kota',
               'email'=>'adminkabkota@simperdes.com',
               'role'=> 3,
               'password'=> bcrypt('123456'),
               'foto'=>'uploads/users/foto/default.jpg'
            ],
            [
               'name'=>'Admin Kecamatan',
               'email'=>'adminkecamatan@simperdes.com',
               'role'=>2,
               'password'=> bcrypt('123456'),
               'foto'=>'uploads/users/foto/default.jpg'
            ],
            [
                'name'=>'Admin Desa Kelurahan',
                'email'=>'admindeskel@simperdes.com',
                'role'=>1,
                'password'=> bcrypt('123456'),
                'foto'=>'uploads/users/foto/default.jpg'
            ],
            [
                'name'=>'Mitra',
                'email'=>'mitra@simperdes.com',
                'role'=>0,
                'password'=> bcrypt('123456'),
                'foto'=>'uploads/users/foto/default.jpg'
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}

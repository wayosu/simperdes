<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TentangKamiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tentang_kamis')->insert([
            'alamat' => 'Gorontalo',
            'link_gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6301154099424!2d123.0611077749649!3d0.5565167994380439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32792b4725525d77%3A0x8d9657ea786d0e03!2sUniversitas%20Negeri%20Gorontalo!5e0!3m2!1sid!2sid!4v1695757470784!5m2!1sid!2sid',
            'email' => 'simperdes@company.com',
            'telepon' => '081234567890',
            'link_facebook' => 'https://www.facebook.com/',
            'link_instagram' => 'https://www.instagram.com/',
            'link_twitter' => 'https://twitter.com/',
        ]);
    }
}

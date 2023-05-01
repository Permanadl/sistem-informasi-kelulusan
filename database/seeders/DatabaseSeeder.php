<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create([
            'name' => 'Administrator',
            'email' => 'admin@domain.com',
            'username' => 'admin',
            'password' => bcrypt('admin')
        ]);

        Pengaturan::create(['key' => 'banner', 'value' => 'banner647.jpg']);
        Pengaturan::create(['key' => 'pengumuman']);
        Pengaturan::create(['key' => 'tanggal_dibuka']);
        Pengaturan::create(['key' => 'tanggal_ditutup']);
    }
}

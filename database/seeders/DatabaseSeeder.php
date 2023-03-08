<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Penulis;
use App\Models\Petugas;
use App\Models\UserPetugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'ijul',
            'username' => 'ijul123',
            'email' => 'ijul@gmail.com',
            'password' => bcrypt('12345')
        ]);



        Petugas::create([
            'nama' => 'ijul',
            'alamat' => 'jalan kedondong',
            'telepon' => '08165000423',
            'email' => 'ijul@gmail.com',
        ]);

        // Penulis::create([
        //     'nama' => 'ijul',
        //     'email' => 'ijul@gmail.com'
        // ]);

        // $petugasId = DB::table('petugas')->where('email', 'ijul@gmail.com')->value('id');

        // UserPetugas::create([
        //     'petugas_id' => $petugasId,
        //     'username' => 'ijul123',
        //     'password' => bcrypt('12345'),
        // ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Penulis;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\UserPetugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Factories\AnggotaFactory;
use Database\Factories\KategoriFactory;
use Database\Factories\PenulisFactory;
use Database\Factories\BukuFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\Admin::create([
        //     'name' => 'ijul',
        //     'username' => 'iju2',
        //     'email' => 'ijul@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);



        // Petugas::create([
        //     'nama' => 'ijul',
        //     'alamat' => 'jalan kedondong',
        //     'telepon' => '08165000423',
        //     'email' => 'ijul@gmail.com',
        //     'username' => 'ijul123',
        //     'password' => bcrypt('12345')
        // ]);
        // Petugas::create([
        //     'nama' => 'alu',
        //     'alamat' => 'jalan rambutan',
        //     'telepon' => '081654210423',
        //     'email' => 'alu@gmail.com',
        //     'username' => 'alu1',
        //     'password' => bcrypt('12345')
        // ]);

        Petugas::create([
            'nama' => 'aluezz',
            'alamat' => 'jalan rambutan',
            'telepon' => '081654210423',
            'email' => 'al22aeu@gmail.com',
            'username' => 'alu11',
            'password' => bcrypt('12345'),
            'is_admin' => true,
            'role' => 'admin'
        ]);

        // Kategori::factory()->count(20)->create();

        // Penulis::factory()->count(20)->create();

        // Buku::factory()->count(20)->create();

        // Anggota::factory()->count(20)->create();


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

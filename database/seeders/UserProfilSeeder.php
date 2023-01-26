<?php

namespace Database\Seeders;

use App\Models\users\UserProfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user_profile1' => [
                'name' => 'Super Admin',
                'description' => 'Profil super administrateur',
            ],

            'user_profil2' => [
                'name' => 'Admin',
                'description' => 'Profil administrateur',
            ],

            'user_profil3' => [
                'name' => 'Utilisateur',
                'description' => 'Profil utilisateur',
            ],
        ];

        \Schema::disableForeignKeyConstraints();
        //UserProfil::query()->truncate();
        foreach ($data as $userProfil) {
            $test_profil = UserProfil::query()->where('name', $userProfil['name'])->first();
            if ($test_profil == null)
                UserProfil::query()->create($userProfil);
        }
        \Schema::enableForeignKeyConstraints();
    }
}

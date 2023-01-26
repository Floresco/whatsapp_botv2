<?php

namespace Database\Seeders;

use App\Models\users\AccessRight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            [
                'wording' => 'manage_dashboard',
            ],
            [
                'wording' => 'manage_admin',
            ],
            [
                'wording' => 'manage_profil',
            ],
            [
                'wording' => 'manage_whatsapp'
            ]
        ];

        \Schema::disableForeignKeyConstraints();
//        AccessRight::query()->truncate();
        foreach ($data as $access_right) {
            $test_wording = AccessRight::query()->where('wording', $access_right['wording'])->first();
            if ($test_wording == null)
                AccessRight::query()->create($access_right);
        }
        \Schema::enableForeignKeyConstraints();
    }
}

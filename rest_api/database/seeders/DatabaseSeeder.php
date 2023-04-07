<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Regional;
use App\Models\Schedule;
use App\Models\Spot;
use App\Models\SpotVaccine;
use App\Models\User;
use App\Models\Vaccine;
use App\Models\SpotVaccines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = User::create([
            'username' => 'doctor',
            'password' => bcrypt('1234'),
            'role' => 'doctor',
        ]);


        Doctor::create([
            'name' => 'Dr. Admin',
            'user_id' => $user->id,
        ]);


        Regional::create([
            'province' => 'DKI Jakarta',
            'district' => 'Central Jakarta'
        ]);


        Regional::create([
            'province' => 'DKI Jakarta',
            'district' => 'South Jakarta'
        ]);

        Regional::create([
            'province' => 'West Java',
            'district' => 'Bandung'
        ]);


        Spot::create([
            'name' => 'Pranowo Hospital',
            'address' => 'Ds. Hasanuddin No. 676, DKI Jakarta',
            'serve' => 1,
            'capacity' => 15,
            'regional_id' => 1
        ]);


        Spot::create([
            'name' => 'Halimah Hospital',
            'address' => 'Kpg. Yoga No. 60, DKI Jakarta',
            'serve' => 1,
            'capacity' => 15,
            'regional_id' => 1
        ]);


        Spot::create([
            'name' => 'Aryani Hospital',
            'address' => 'Jr. Juanda No. 16, DKI Jakarta',
            'serve' => 1,
            'capacity' => 15,
            'regional_id' => 2
        ]);


        Vaccine::create([
            'name' => 'Sinovac'
        ]);


        Vaccine::create([
            'name' => 'AstraZeneca'
        ]);

        Vaccine::create([
            'name' => 'Moderna'
        ]);

        Vaccine::create([
            'name' => 'Pfizer'
        ]);

        Vaccine::create([
            'name' => 'Sinnopharm'
        ]);


        Schedule::create([
            'date' => '2022-05-23',
            'spot_id' => 1
        ]);


        Schedule::create([
            'date' => '2022-05-24',
            'spot_id' => 1
        ]);


        SpotVaccine::create([
            'status' => true,
            'vaccine_id' => 1,
            'spot_id' => 1
        ]);


        SpotVaccine::create([
            'status' => false,
            'vaccine_id' => 2,
            'spot_id' => 1
        ]);
    }
}

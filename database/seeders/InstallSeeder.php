<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user                    = new User();
        $user->name              = "SuperAdmin";
        $user->email             = config('app.admin_email');
        $user->password          = Hash::make(config('app.admin_password'));
        $user->email_verified_at = now();
        $user->save();

        $team = Team::forceCreate([
            'user_id'       => $user->id,
            'name'          => "Administrators",
            'personal_team' => false,
        ]);

        $team->users()->attach(
            $user, ['role' => "SuperAdmin"]
        );

    }
}

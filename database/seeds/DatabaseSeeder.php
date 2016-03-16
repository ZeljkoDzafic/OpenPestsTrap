<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->insert([
            'name' => 'OpenPestTrap',
            'email' => 'admin@openpesttrap.com',
            'password' => bcrypt('debug'),
        ]);

        Model::reguard();
    }
}

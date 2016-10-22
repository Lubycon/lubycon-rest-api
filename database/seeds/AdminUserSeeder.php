<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $admin = array(
            array(
            	'email'=>'lubycon@gmail.com',
            	'name' => 'Admin',
            	'password' => bcrypt('hmdwdhdgkr2015'),
            	'country' => 201,
            	'job' => 1,
            	'is_active' => 'active',
            	'is_accept_terms' => 111,
            	'profile_img' => null,
            	'company' => 'Lubycon co.',
            	'city' => 'Seoul',
            	'mobile' => '010-1234-1234',
            	'fax' => '123-4234-12458',
            	'web' => 'aws.lubycon.com',
            	'description' => 'this is administrator',
            	'email_public' => 'Public',
            	'mobile_public' => 'Public',
            	'fax_public' => 'Public',
            	'web_public' => 'Public',
            ),
        );

        DB::table('users')->insert($admin);
    }
}

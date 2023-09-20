<?php

use Illuminate\Database\Seeder;


class PackageSeeder extends Seeder
{
    public function run()
    {
        // Define default packages
        $packages = [
            ['name' => 'Basic Package', 'price' => 00.00],
            ['name' => 'Premium Package', 'price' => 79.99],
        ];

        
        DB::table('packages')->insert($packages);
    }
}

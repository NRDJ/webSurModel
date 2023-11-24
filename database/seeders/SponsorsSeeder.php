<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $sponsors = [
            [1,'93281000-K','Sociedad Anónima','giro comercial','Av. Carlos Valdovinos 560','Coca cola',' 23764860',''],
            [2,'92001001-8','Sociedad Anónima','giro comercial','Av. Carlos Valdovinos 560','Pepsi','23764861',''],
            [3,'92001002-8','Sociedad Anónima','giro comercial','Av. Carlos Valdovinos 560','Uber','23764862',''],
            [4,'92001003-8','Sociedad Anónima','giro comercial','Av. Carlos Valdovinos 560','Toyota','23764863',''],
            [5,'92001004-8','Sociedad Anónima','giro comercial','Av. Carlos Valdovinos 560','Falabella','23764864',''],
        ];

        $sponsors = array_map(function($sponsor) use ($now) {
           return [
                'id' => $sponsor[0],
                'rut' => $sponsor[1],
                'business_name' => $sponsor[2],
                'main_line' => $sponsor[3],
                'commercial_address' => $sponsor[4],
                'logo' => '',
                'contact_name' => $sponsor[5],
                'contact_phone' => $sponsor[6],
           ];
        }, $sponsors);

        \DB::table('sponsors')->insert($sponsors);
    }
}

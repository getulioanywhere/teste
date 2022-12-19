<?php

namespace Modules\Company\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Company\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class CompanyDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $table = 'company';

    public function run() {

        if (Schema::hasTable($this->table)) {
            $ret = Company::all();
            if (!$ret && is_null($ret) || $ret->count() == 0) {
                Company::create([
                    'name' => 'nome teste',
                    'cnpj' => '00000000000',
                    'foundation' => date('Y-m-d'),
                    'email' => Str::random(10) . "@teste.com",
                    'phone' => "(51)000000000",
                    'facebook' => "https://www.facebook.com/",
                    'instagram' => "https://www.instagram.com/",
                    'whatsapp_1' => "(51)000000000",
                    'whatsapp_2' => "(51)000000000",
                    'twitter' => "https://twitter.com/",
                    'youtube' => "https://www.youtube.com/",
                    'linkedin' => "https://linkedin.com/",
                    'address_street' => "Dom Pedro II",
                    'address_number' => "930",
                    'address_neighborhood' => "São João",
                    'address_city' => "Porto Alegre",
                    'address_state' => "RS",
                    'address_zipcod' => "90550140",
                    'opening_hours' => "Segunda a Quinta: das 08:30 ao 12:00, e da 13:00 ás 17:45.
                Sexta-feira: das 08:30 ao 12:00, e da 13:00 ás 17:00.
                Sábados e Domingos: Fechado",
                    'map' => "R. Dom Pedro II, 930 - São João, Porto Alegre - RS, 90550-140",
                    'http_website'=>''
                ]);
            }
        }
    }

}

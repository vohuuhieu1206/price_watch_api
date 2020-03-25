<?php

use App\Provider;
use App\Specification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       // Model::unguard();

        $providers= [
        	'Thế giới di động',
        	'Fpt shop',
        	'Phong vũ',
            'Điện máy xanh',
        ];
        $specifications = ['duy'];
        foreach ($specifications as $specification){
            Specification::firstOrCreate([
                'display'=>$specification,
            ]);
        };
        foreach ($providers as $provider){
        	Provider::firstOrCreate([
        		'provider_name'=>$provider,
        	]);
        };
       // Model::reguard();
    }
}

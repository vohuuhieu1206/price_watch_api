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
        	'CellphoneS',
            'Viettel Store',
            'Hoàng hà mobile',
            'Điện máy chợ lớn'
        ];
        
        foreach ($providers as $provider){
        	Provider::firstOrCreate([
        		'provider_name'=>$provider,
        	]);
        };
       // Model::reguard();
    }
}

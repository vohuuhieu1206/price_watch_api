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
        	'Thế giới di động' =>  'https://vn-cs.com/data/data/anhpnh/2018/06/27/simple-colour-test-screen-with-white-color.jpg',
        	'Fpt shop' => 'https://img.giaoduc.net.vn/w1050/uploaded/2020/zdhwqcrnw/2014_03_25/logofpt1.jpg',
        	'CellphoneS'=> 'https://cdn.cellphones.com.vn/skin/frontend/default/cpsdesktop/images/media/logo.png',
            'Viettel Store' => 'http://dongphucvnxk.com/wp-content/uploads/2019/08/logo-viettelstore.png',
            'Hoàng hà mobile' => 'https://hoanghamobile.com/Content/v2.1/images/logo-text.png',
            'Điện máy chợ lớn' => 'https://dienmaycholon.vn/public/dienmaycholon/general/img/logo-dmcl.png',
        ];
        foreach ($providers as $key => $value){
        	Provider::firstOrCreate([
        		'provider_name'=>$key,
                'link_logo'=>$value
        	]);
        };
       // Model::reguard();
    }
}

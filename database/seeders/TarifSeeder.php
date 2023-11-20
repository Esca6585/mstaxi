<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Tarif;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tarifs = [
                // id=1
            [
                'name_tm' => 'VIP',
                'name_ru' => 'VIP',
                'minimum_price' => 0.0,
                'every_minute_price' => 10.0,
                'every_km_price' => 7.0,
                'every_waiting_price' => 5.0,
                'every_minute_price_outside' => 5.0,
                'every_km_price_outside' => 5.0,
                'image' => 'mstaxi/vip_tarif.svg',
            ],
                // id=2
            [
                'name_tm' => 'Gijeki',
                'name_ru' => 'Ночной',
                'minimum_price' => 0.0,
                'every_minute_price' => 10.0,
                'every_km_price' => 7.0,
                'every_waiting_price' => 5.0,
                'every_minute_price_outside' => 5.0,
                'every_km_price_outside' => 5.0,
                'image' => 'mstaxi/sienna_tarif.svg',
            ],
                // id=3
            [
                'name_tm' => 'Ýükli',
                'name_ru' => 'Груз',
                'minimum_price' => 0.0,
                'every_minute_price' => 10.0,
                'every_km_price' => 7.0,
                'every_waiting_price' => 5.0,
                'every_minute_price_outside' => 5.0,
                'every_km_price_outside' => 5.0,
                'image' => 'mstaxi/gruz_tarif.svg',
            ],
                // id=4
            [
                'name_tm' => 'Sienna',
                'name_ru' => 'Сиенна',
                'minimum_price' => 0.0,
                'every_minute_price' => 10.0,
                'every_km_price' => 7.0,
                'every_waiting_price' => 5.0,
                'every_minute_price_outside' => 5.0,
                'every_km_price_outside' => 5.0,
                'image' => 'mstaxi/sienna_tarif.svg',
            ],
        ];

        // <-- begin:: Parent Category -->
        foreach ($tarifs as $tarif) 
        {
            Tarif::create([
                'name_tm' => $tarif['name_tm'],
                'name_ru' => $tarif['name_ru'],
                'minimum_price' => $tarif['minimum_price'],
                'every_minute_price' => $tarif['every_minute_price'],
                'every_km_price' => $tarif['every_km_price'],
                'every_waiting_price' => $tarif['every_waiting_price'],
                'every_minute_price_outside' => $tarif['every_minute_price_outside'],
                'every_km_price_outside' => $tarif['every_km_price_outside'],
                'image' => $tarif['image'],
            ]); 
        }
        // <-- end:: Parent Category -->

    }
}

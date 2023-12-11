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
                'name_tm' => 'Standart',
                'name_ru' => 'Стандарт',
                'minimum_price' => 0,
                'every_minute_price' => 1,
                'every_km_price' => 1,
                'every_waiting_price' => 1,
                'free_waiting_minute' => 2,
                'every_minute_price_outside' => 3,
                'every_km_price_outside' => 3,
                'additional_tarif' => 0,
                'image' => 'mstaxi/tarif-seeder/standart_tarif.svg',
            ],
                // id=2
            [
                'name_tm' => 'Gijeki',
                'name_ru' => 'Ночной',
                'minimum_price' => 1,
                'every_minute_price' => 2,
                'every_km_price' => 2,
                'every_waiting_price' => 2,
                'free_waiting_minute' => 3,
                'every_minute_price_outside' => 5,
                'every_km_price_outside' => 5,
                'additional_tarif' => 0,
                'image' => 'mstaxi/tarif-seeder/sienna_tarif.svg',
            ],
                // id=3
            [
                'name_tm' => 'Ýükli',
                'name_ru' => 'Груз',
                'minimum_price' => 2,
                'every_minute_price' => 3,
                'every_km_price' => 3,
                'every_waiting_price' => 3,
                'free_waiting_minute' => 4,
                'every_minute_price_outside' => 7,
                'every_km_price_outside' => 7,
                'additional_tarif' => 0,
                'image' => 'mstaxi/tarif-seeder/gruz_tarif.svg',
            ],
                // id=4
            [
                'name_tm' => 'Sienna',
                'name_ru' => 'Сиенна',
                'minimum_price' => 3,
                'every_minute_price' => 4,
                'every_km_price' => 4,
                'every_waiting_price' => 4,
                'free_waiting_minute' => 5,
                'every_minute_price_outside' => 10,
                'every_km_price_outside' => 10,
                'additional_tarif' => 0,
                'image' => 'mstaxi/tarif-seeder/sienna_tarif.svg',
            ],
                // id=5
            [
                'name_tm' => 'VIP',
                'name_ru' => 'VIP',
                'minimum_price' => 4,
                'every_minute_price' => 5,
                'every_km_price' => 5,
                'every_waiting_price' => 5,
                'free_waiting_minute' => 5,
                'every_minute_price_outside' => 15,
                'every_km_price_outside' => 15,
                'additional_tarif' => 0,
                'image' => 'mstaxi/tarif-seeder/vip_tarif.svg',
            ],
                // id=6
            [
                'name_tm' => 'Goşlar',
                'name_ru' => 'Багаж',
                'minimum_price' => 7,
                'every_minute_price' => 0,
                'every_km_price' => 0,
                'every_waiting_price' => 0,
                'free_waiting_minute' => 7,
                'every_minute_price_outside' => 0,
                'every_km_price_outside' => 0,
                'additional_tarif' => 1,
                'image' => 'mstaxi/tarif-seeder/bagage_additional_tarif.png',
            ],
                // id=7
            [
                'name_tm' => 'Pul',
                'name_ru' => 'Деньги',
                'minimum_price' => 10,
                'every_minute_price' => 0,
                'every_km_price' => 0,
                'every_waiting_price' => 0,
                'free_waiting_minute' => 8,
                'every_minute_price_outside' => 0,
                'every_km_price_outside' => 0,
                'additional_tarif' => 1,
                'image' => 'mstaxi/tarif-seeder/money_additional_tarif.png',
            ],
                // id=8
            [
                'name_tm' => 'Haýwanlar',
                'name_ru' => 'Животные',
                'minimum_price' => 5,
                'every_minute_price' => 0,
                'every_km_price' => 0,
                'every_waiting_price' => 0,
                'free_waiting_minute' => 9,
                'every_minute_price_outside' => 0,
                'every_km_price_outside' => 0,
                'additional_tarif' => 1,
                'image' => 'mstaxi/tarif-seeder/animal_additional_tarif.png',
            ],
                // id=9
            [
                'name_tm' => 'Çaga',
                'name_ru' => 'Ребенок',
                'minimum_price' => 30,
                'every_minute_price' => 0,
                'every_km_price' => 0,
                'every_waiting_price' => 0,
                'free_waiting_minute' => 10,
                'every_minute_price_outside' => 0,
                'every_km_price_outside' => 0,
                'additional_tarif' => 1,
                'image' => 'mstaxi/tarif-seeder/child_additional_tarif.png',
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
                'free_waiting_minute' => $tarif['free_waiting_minute'],
                'every_minute_price_outside' => $tarif['every_minute_price_outside'],
                'every_km_price_outside' => $tarif['every_km_price_outside'],
                'additional_tarif' => $tarif['additional_tarif'],
                'image' => $tarif['image'],
            ]); 
        }
        // <-- end:: Parent Category -->

    }
}

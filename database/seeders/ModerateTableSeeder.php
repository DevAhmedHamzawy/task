<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Unit;
use App\Models\ModerateTable;
use App\Models\ExchangeStore;

class ModerateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ['خيار', 'طماطم' , 'بطاطس' , 'جزر' , 'فلفل' , 'زيتون' , 'لمون' , 'برتقال' , 'موز' , 'عدس' , 'تمر' , 'يوسفى' , 'بلح' , 'بطيخ' , 'برقوق' , 'كوسة' , 'رز' , 'بسلة' , 'مشمش' , 'تفاح'];

        $units = ['كيلو', 'ربع كيلو' , 'نص كيلو' , 'ثلاثة ارباع كيلو' , 'حبة'];


        foreach ($items as $item) {
            Item::updateOrCreate(['name' => $item] , ['name' => $item]);
        }


        foreach ($units as $unit) {
            Unit::updateOrCreate(['name' => $unit] , ['name' => $unit]);
        }


        $exchangeStores = ExchangeStore::inRandomOrder()->pluck('id');
        $items = Item::inRandomOrder()->pluck('id');
        $units = Unit::inRandomOrder()->pluck('id');



        //for($j = 0; $j < 100000; $j++){
            for ($i=0; $i < 5 ; $i++) { 
                if(!ModerateTable::whereExchangeStoreId($exchangeStores[$i])
                                ->whereItemId($items[$i])
                                ->whereUnitId($units[$i])
                                ->exists()) {

                ModerateTable::create([
                    'exchange_store_id' => $exchangeStores[$i],
                    'item_id' => $items[$i],
                    'unit_id' => $units[$i],
                    'price' => rand(0,1000)
                ]);

                }
            }
        //}


    }
}

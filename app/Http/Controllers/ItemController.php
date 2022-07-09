<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModerateTable;

class ItemController extends Controller
{
    public function show($exchange_store_id,$item_id,$unit_id,$qty)
    {
        //dd($exchange_store_id,$item_id,$unit_id);
        //dd($qty);

        $record = ModerateTable::whereExchangeStoreId($exchange_store_id)->whereItemId($item_id)->whereUnitId($unit_id)->first();

        if($record == null) return false;

        $price = $record->price * $qty;

        return [$record->price, $price];
    }
}

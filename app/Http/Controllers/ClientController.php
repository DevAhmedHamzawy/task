<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function create($name)
    {
        Client::create(['name'=>$name]);

        return Client::all();
    }
}

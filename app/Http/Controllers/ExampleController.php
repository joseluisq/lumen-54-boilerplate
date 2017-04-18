<?php

namespace App\Http\Controllers;

use Guztav\Client;

class ExampleController extends Controller
{

    public function test()
    {
        return request()->json(['ok']);
    }

}

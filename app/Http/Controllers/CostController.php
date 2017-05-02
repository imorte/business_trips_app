<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CostController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();

        foreach ($input as $item) {
            echo $item . ' ' . PHP_EOL;
        }
    }
}

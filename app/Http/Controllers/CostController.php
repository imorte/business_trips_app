<?php

namespace App\Http\Controllers;

use App\Cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CostController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();

        if(Cost::create($input)) {
            return collect(['result' => true])->toJson();
        } else {
            return collect(['result' => false])->toJson();
        }
    }
}

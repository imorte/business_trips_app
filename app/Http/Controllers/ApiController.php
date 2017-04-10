<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @param $id
     * @return mixed
     */
    public function getDepartment($id)
    {
        $departments = Department::where('company_id', $id)->get();

        return $departments;
    }
}

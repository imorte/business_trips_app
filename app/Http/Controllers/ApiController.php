<?php

namespace App\Http\Controllers;

use App\Company;
use App\Department;
use App\User;
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

    /**
     * @param $id
     * @return array
     */
    public function getEmployees($id)
    {
        $employees = User::where('company_id', $id)
            ->where('role_id', 2)
            ->where('in_trip', false)
            ->get();

        $companies = [];
        $result = [];

        if(!empty($employees)) {
            foreach ($employees as $employee) {
                $companies[$employee['id']] = User::find($employee['id'])->department->name;
            }
        }

        foreach ($employees as $employee) {
            $id = $employee['id'];
            if(array_key_exists($id, $companies)) {
                $result[$id] = $employee;
                $result[$id]['department'] = $companies[$employee['id']];

            }
        }

        return array_values($result);
    }
}

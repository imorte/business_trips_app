<?php

namespace App\Http\Controllers;

use App\Company;
use App\Cost;
use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::pluck('name', 'id')->toArray();
        if(Auth::user()->role_id == 1) {
            $trips = Trip::all();
        } else {
            $userId = Auth::user()->id;
            $trips = Trip::where('user_id', $userId)->get();
        }

        return view('trip.index', compact('companies', 'trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $companies = Company::pluck('name', 'id')->toArray();
        $input = $request->all();
        $tripDuration = Carbon::parse($input['trip_start'])
            ->diffInDays(Carbon::parse($input['trip_end']));

        if($tripDuration > 365) {
            return view('trip.index', compact('companies'))
                ->withErrors(['error' => 'Длительность не более года']);
        }

        Trip::create($input);
        $trips = Trip::all();
        $user = User::find($input['user_id']);
        $user->in_trip = true;
        $user->save();
        Session::flash('state', 'Командировка создана');

        return view('trip.index', compact('companies', 'trips'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trip = Trip::find($id);

        return view('trip.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find(request()->user_id);
        $user->in_trip = false;
        $user->save();
        Trip::destroy($id);
        Session::flash('state', 'Командировка отменена');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\City;
use Igaster\LaravelCities\Geo;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // private $cityModel;
    // public function __construct()
    // {
    //     $this->cityModel = new City();
    // }

    public function index()
    {
        $getAllCities =
        Geo::getCountry('US');             // Get item by Country code
        Geo::findName('Nomos Kerkyras');   // Find item by (ascii) name
        Geo::searchNames('york');          // Search item by all alternative names. Case insensitive
        Geo::searchNames('vegas', Geo::getCountry('US'));  // ... and belongs to an item
        Geo::getByIds([390903,3175395]);   // Get a Collection of items by Ids

        return response()->json($getAllCities);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}

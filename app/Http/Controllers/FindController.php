<?php

namespace App\Http\Controllers;

use App\Models\Find;
use Illuminate\Http\Request;

class FindController extends Controller
{
    private $findModel;
    public function __construct()
    {
        $this->findModel = new Find();
    }

    public function index()
    {
        $getAllFind = $this->findModel->with('sender','reciever');
        $getAllFind = $this->findModel->get();
        return response()->json($getAllFind);
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
        $createNewFind = $this->findModel->updateOrCreate([
            'id_sender' => auth()->id(),
            'isFriend' => $request->isFriend,
            'id_reciever' => $request->id_reciever,
            'match' => $request->match
        ]);
        return response()->json($createNewFind);
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

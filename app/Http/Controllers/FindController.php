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
        $getAllFind = $this->findModel->get();
        return response()->json($getAllFind);
    }

    public function match()
    {
        $getAllFind = $this->findModel
        // ->with('sender','reciever')
        ->where('id_sender',3);
        // ->where('id_reciever', '!=' , auth()->id());
        $getAllFind = $this->findModel->get();

        // $getAllFind = $getAllFind
        // ->where('id', '==' , auth()->id())

        // ->get();
        return response()->json($getAllFind);
        // dd($getAllFind);
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
            'id_reciever' => $request->id_reciever,
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

<?php

namespace App\Http\Controllers;

use App\Models\Find;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

    // public function matchSimple()
    // {
    //     $getAllFind = $this->findModel->with('sender', 'reciever')->where('id_sender', auth()->id())->where)'';
    // }

    public function match()
    {
        $getAllFind = $this->findModel->with('sender', 'reciever')->where('id_sender', auth()->id())->pluck('id_reciever')->toArray();

        $final = [];
        $match = [];

        for ($i = 0; $i < count($getAllFind); $i++) {
            $match[$i] = $this->findModel->with('sender', 'reciever')->where('id_sender', $getAllFind[$i])->pluck('id_reciever');

            if (count($match[$i]) != 0) {
                for ($j = 0; $j < count($match[$i]); $j++) {
                    $k = $getAllFind[$i] + 1;
                    if ($match[$i][$j] == auth()->id()) {
                        $final[$k] = $this->findModel->with('sender', 'reciever')->where([['id_sender', $getAllFind[$i]], ['id_reciever', auth()->id()]])->get();
                    }
                }
            }
        }
        return response()->json(['data' => $final]);
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

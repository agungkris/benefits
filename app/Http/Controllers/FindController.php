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

    public function match()
    {
        $getAllFind = $this->findModel->with('sender','reciever')->where('id_sender', auth()->id())->pluck('id_reciever')->toArray();


        // foreach ($getAllFind as $getAllFind) {
            // $match = $this->findModel->with('sender','reciever')->whereIn('id_sender', $getAllFind)->get();
        // }
        for ($i=0; $i < count($getAllFind); $i++) {
            // dd($getAllFind[0]);
            $match[$i] = $this->findModel->with('sender','reciever')->where('id_sender', $getAllFind[$i])->pluck('id_reciever');
            // dd(count($match[0]));
            // dd($match[$i]);
            if (count($match[$i]) != 0) {
                for ($j=0; $j < count($match[$i]) ; $j++) {
                    $k = $getAllFind[$i] + 1;
                    // for ($i=0; $i < count($final) ; $i++) {
                    //     $a[$i]
                    // }
                    if ($match[$i][$j] == auth()->id()) {
                        // echo $getAllFind[$i];
                        // $hasil[$j] = $getAllFind[$i];
                        $final[$k] = $this->findModel->with('sender','reciever')->where([['id_sender', $getAllFind[$i]],['id_reciever', auth()->id()]])->get();
                        // dd($match[$i][1]);
                        // dd($final[4]);
                    }
                }
            }
        }
        // dd($match);
        // dd($final);
        // dd($hasil);
        // dd($getAllFind);
        // $final = $this->findModel->with('sender','reciever')->where('id_sender', auth()->id())->get();
        // if ('id_receiver' === 'id_sender') {
        //     return response()->json($getAllFind);
        // }
        // do {
        //     $getAllFind
        // } while ($a <= 10);

        // ->where(function ($where) {
        //     $where->where('id_sender', '==', auth()->id())->orWhere('id_reciever', '==', auth()->id());
        // });

        // ->where('id_reciever');
        // $getAllFind = $getAllFind->where('id_sender', '==', auth()->id());

        // foreach($getAllFind as $k=>$v){
        //     echo $v['id_reciever'] == $v['id_sender'];
        // }
        // foreach($getAllFind as $k => $v){
        //     foreach ($getAllFind as $k2 => $v2) {
        //         echo $k2.' ' .$v2.'<br />';
        //         // return response()->json($getAllFind);
        //     }
        // }

        return response()->json($final);
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

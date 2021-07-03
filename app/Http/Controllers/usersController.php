<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $getAllUsers = $this->userModel->get();
        return response()->json($getAllUsers);
    }

    /**
     * Show the form for creating a new resource.
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
        // if ($request->file('photo1')) {
        //     $photo1 = $request->file('photo1')->move(public_path('documents'), $request->file('photo1')->getClientOriginalName());
        //     $loadData1['photo1'] = $photo1;
        // }
        // if ($request->file('photo2')) {
        //     $photo2 = $request->file('photo2')->move(public_path('documents'), $request->file('photo2')->getClientOriginalName());
        //     $loadData2['photo2'] = $photo2;
        // }
        // if ($request->file('photo3')) {
        //     $photo3 = $request->file('photo3')->move(public_path('documents'), $request->file('photo3')->getClientOriginalName());
        //     $loadData3['photo3'] = $photo3;
        // }
        // if ($request->file('photo4')) {
        //     $photo4 = $request->file('photo4')->move(public_path('documents'), $request->file('photo4')->getClientOriginalName());
        //     $loadData4['photo4'] = $photo4;
        // }
        $createNewUsers = $this->userModel->updateOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'city' => $request->city,
            'photo1' => $request->photo1,
            'photo2' => $request->photo2,
            'photo3' => $request->photo3,
            'photo4' => $request->photo4,
            'about' => $request->about,
            'age' => $request->age,
            'zodiac' => $request->zodiac,
            'drink' => $request->drink,
            'gym' => $request->gym,
            'smoke' => $request->smoke,
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'isFriend' => $request->isFriend,
            'interest' => $request->interest,
            'password' => bcrypt($request->password),
        ]);
        return response()->json($createNewUsers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $findUsers = $this->userModel->find($id);
        return response()->json($findUsers);
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
        $findUsers = $this->userModel->find($id);

        // if ($request->file('photo1')) {
        //     $photo1 = $request->file('photo1')->storeAs('documents', $request->file('photo1')->getClientOriginalName());
        //     $loadData['photo1'] = $photo1;
        // }
        // if ($request->file('photo1')) {
        //     $photo1 = $request->file('photo1')->move(public_path('documents'), $request->file('photo1')->getClientOriginalName());
        //     $loadData['photo1'] = $photo1;
        // }
        // if ($request->file('photo2')) {
        //     $photo2 = $request->file('photo2')->move(public_path('documents'), $request->file('photo2')->getClientOriginalName());
        //     $loadData['photo2'] = $photo2;
        // }
        // if ($request->file('photo3')) {
        //     $photo3 = $request->file('photo3')->move(public_path('documents'), $request->file('photo3')->getClientOriginalName());
        //     $loadData['photo3'] = $photo3;
        // }
        // if ($request->file('photo4')) {
        //     $photo4 = $request->file('photo4')->move(public_path('documents'), $request->file('photo4')->getClientOriginalName());
        //     $loadData['photo4'] = $photo4;
        // }
        // if ($request->file('photo2')) {
        //     if ($findUsers && Storage::exists($findUsers->photo2)) {
        //         Storage::delete($findUsers->photo2);
        //     }
        //     $photo2 = $request->file('photo2')->move(public_path('documents'), $request->file('photo2')->getClientOriginalName());
        //     $loadData['photo2'] = $photo2;
        // }
        $findUsers->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'city' => $request->city,
            // 'photo2' => $request->photo2,
            // 'photo3' => $request->photo3,
            // 'photo4' => $request->photo4,
            'about' => $request->about,
            'age' => $request->age,
            'zodiac' => $request->zodiac,
            'drink' => $request->drink,
            'gym' => $request->gym,
            'smoke' => $request->smoke,
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'isFriend' => $request->isFriend,
            'interest' => $request->interest,
            'password' => bcrypt($request->password),
        ]);
        return response()->json($findUsers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findUsers = $this->userModel->find($id);
        $findUsers->delete();
        return response()->json($findUsers);
    }
}

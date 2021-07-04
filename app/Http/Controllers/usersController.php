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

    public function random()
    {
        $getCity =
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
        $createNewUsers = $this->userModel->create([
            'name' => $request->name ? $request->name : " ",
            'email' => $request->email ? $request->email : " ",
            'phone' => $request->phone ? $request->phone : 0,
            'gender' => $request->gender ? $request->gender : " ",
            'city' => $request->city ? $request->city : " ",
            'photo1' => $request->photo1 ? $request->photo1 : " ",
            'photo2' => $request->photo2 ? $request->photo2 : " ",
            'photo3' => $request->photo3 ? $request->photo3 : " ",
            'photo4' => $request->photo4 ? $request->photo4 : " ",
            'about' => $request->about ? $request->about : " ",
            'age' => $request->age ? $request->age : 0,
            'zodiac' => $request->zodiac ? $request->zodiac : " ",
            'drink' => $request->drink ? $request->drink : " ",
            'gym' => $request->gym ? $request->gym : " ",
            'smoke' => $request->smoke ? $request->smoke : " ",
            'status' => $request->status ? $request->status : " ",
            'latitude' => $request->latitude ? $request->latitude : " ",
            'longitude' => $request->longitude ? $request->longitude : " ",
            'isFriend' => $request->isFriend ? $request->isFriend : 0,
            'interest' => $request->interest ? $request->interest : " ",
            'education' => $request->education ? $request->education : " ",
            'religion' => $request->religion ? $request->religion : " ",
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
        $findUsers->update([
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
            'education' => $request->education,
            'religion' => $request->religion,
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

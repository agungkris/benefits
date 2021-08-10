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

    public function random(Request $request)
    {
        $getAllUsers = $this->userModel;
        if ($request->filled('city')) {
            $getAllUsers = $getAllUsers->where('city', $request->city);
        }
        if ($request->filled('gender')) {
            $getAllUsers = $getAllUsers->where('gender', $request->gender);
        }
        $getAllUsers = $getAllUsers
        ->where('isFriend', 0)
        ->where('id', '!=' , auth()->id())
        ->inRandomOrder()
        ->skip(0)->take($request->limit ?? 20)
        ->get();
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
            'name' => $request->name ? $request->name : "",
            'email' => $request->email ? $request->email : "",
            'phone' => $request->phone ? $request->phone : 0,
            'gender' => $request->gender ? $request->gender : "",
            'city' => $request->city ? $request->city : "",
            'photo1' => $request->photo1 ? $request->photo1 : "",
            'photo2' => $request->photo2 ? $request->photo2 : "",
            'photo3' => $request->photo3 ? $request->photo3 : "",
            'photo4' => $request->photo4 ? $request->photo4 : "",
            'about' => $request->about ? $request->about : "",
            'age' => $request->age ? $request->age : 0,
            'zodiac' => $request->zodiac ? $request->zodiac : "",
            'drink' => $request->drink ? $request->drink : "",
            'gym' => $request->gym ? $request->gym : "",
            'smoke' => $request->smoke ? $request->smoke : "",
            'status' => $request->status ? $request->status : "",
            'latitude' => $request->latitude ? $request->latitude : "",
            'longitude' => $request->longitude ? $request->longitude : "",
            'isFriend' => $request->isFriend ? $request->isFriend : 0,
            'interest' => $request->interest ? $request->interest : "",
            'education' => $request->education ? $request->education : "",
            'religion' => $request->religion ? $request->religion : "",
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
        $name      = !empty($request->name)      ? $request->name      : "";
        $email     = !empty($request->email)     ? $request->email     : "";
        $phone     = !empty($request->phone)     ? $request->phone     : "";
        $gender    = !empty($request->gender)    ? $request->gender    : "";
        $city      = !empty($request->city)      ? $request->city      : "";
        $photo1    = !empty($request->photo1)    ? $request->photo1    : "";
        $photo2    = !empty($request->photo2)    ? $request->photo2    : "";
        $photo3    = !empty($request->photo3)    ? $request->photo3    : "";
        $photo4    = !empty($request->photo4)    ? $request->photo4    : "";
        $about     = !empty($request->about)     ? $request->about     : "";
        $age       = !empty($request->age)       ? $request->age       : "";
        $zodiac    = !empty($request->zodiac)    ? $request->zodiac    : "";
        $drink     = !empty($request->drink)     ? $request->drink     : "";
        $gym       = !empty($request->gym)       ? $request->gym       : "";
        $smoke     = !empty($request->smoke)     ? $request->smoke     : "";
        $status    = !empty($request->status)    ? $request->status    : "";
        $latitude  = !empty($request->latitude)  ? $request->latitude  : "";
        $longitude = !empty($request->longitude) ? $request->longitude : "";
        $isFriend  = !empty($request->isFriend)  ? $request->isFriend  : "";
        $interest  = !empty($request->interest)  ? $request->interest  : "";
        $education = !empty($request->education) ? $request->education : "";
        $religion  = !empty($request->religion)  ? $request->religion  : "";
        $password  = !empty($request->password)  ? $request->password  : "";

        $User      = User::find($id);

        $User->name      = $request->name      ? $name      : $User->name;
        $User->email     = $request->email     ? $email     : $User->email;
        $User->phone     = $request->phone     ? $phone     : $User->phone;
        $User->gender    = $request->gender    ? $gender    : $User->gender;
        $User->city      = $request->city      ? $city      : $User->city;
        $User->photo1    = $request->photo1    ? $photo1    : $User->photo1;
        $User->photo2    = $request->photo2    ? $photo2    : $User->photo2;
        $User->photo3    = $request->photo3    ? $photo3    : $User->photo3;
        $User->photo4    = $request->photo4    ? $photo4    : $User->photo4;
        $User->about     = $request->about     ? $about     : $User->about;
        $User->age       = $request->age       ? $age       : $User->age;
        $User->zodiac    = $request->zodiac    ? $zodiac    : $User->zodiac;
        $User->drink     = $request->drink     ? $drink     : $User->drink;
        $User->gym       = $request->gym       ? $gym       : $User->gym;
        $User->smoke     = $request->smoke     ? $smoke     : $User->smoke;
        $User->status    = $request->status    ? $status    : $User->status;
        $User->latitude  = $request->latitude  ? $latitude  : $User->latitude;
        $User->longitude = $request->longitude ? $longitude : $User->longitude;
        $User->isFriend  = $request->isFriend  ? $isFriend  : $User->isFriend;
        $User->interest  = $request->interest  ? $interest  : $User->interest;
        $User->education = $request->education ? $education : $User->education;
        $User->religion  = $request->religion  ? $religion  : $User->religion;
        $User->password  = $request->password  ? $password  : $User->password;
        $User->save();

        if($User->save()){
            return response()->json($User);
        }

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

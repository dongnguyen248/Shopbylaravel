<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */



    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $users = User::latest()->paginate(8);
        return response()->json($users);
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
        $this->validate($request,[
            'name' => 'required|string|max:40',
            'email' => 'required|string|max:200|unique:users',
            'password' => 'required|string|min:6',
            'type' => 'required',
        ]);

        User::create([
            'name'=> $request['name'],
            'email'=> $request['email'],
            'password'=> Hash::make($request['password']),
            'type'=> $request['type']
        ]);
        return response()->json('Created success user ');
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
    public function profile()
    {
        return auth('api')->user();
    }

    public function updateProfile(Request $request)
    {
        // ]);
        $user = auth('api')->user();
        if($request->file('image')){
            $fileName = $request->file('image')->store('','public');
            $user->photo = $fileName ;
            $request->file('image')->move(public_path('images/profile/'),$fileName);
        }
        $user->name = $request->name;
        $user->save();
        return $request;    
    }

    public function filterUser($filter)
    {
        // dd($filter);
        // exit;
        if($filter == 'all') {
            $users = User::latest()->paginate(8);
        }
        else{
            $users = User::where('type',$filter)->latest()->paginate(8); 
        }
        return response()->json($users);
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
        $this->validate($request,[
            'name' => 'required|string|max:40',
            'email' => 'required|string|max:200|unique:users,email,'.$id,
            'password' => 'sometimes|min:6',
            'type' => 'required',
        ]);
        User::findOrFail($id)->update($request->all());
        return ['message' => 'User updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return ['message' => 'User deleted'];
    }
}

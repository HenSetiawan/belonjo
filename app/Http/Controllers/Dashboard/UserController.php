<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function admin () {
        $admins = User::where('role','admin')->paginate(10);
        return view('dashboard.admin.index', ['admins'=>$admins]);
    }

    public function users () {
        $users = User::where('role','user')->paginate(10);
        return view('dashboard.user.index', ['users'=>$users]);
    }

    public function register (){
        return view('client.user.register');
    }

    public function registerUser(Request $request){
        $this->validate($request, [
                'name'=>['required'],
                'email'=>['required'],
                'password'=>['required'],
                'phone'=>['required'],
                'address'=>['required']
        ]);

        $userCreated = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>'user',
            'password'=>Hash::make($request->password),
            'phone'=>$request->phone,
            'address'=>$request->address
        ]);

        if($userCreated){
            return redirect('/')->with('message','data berhasil ditambahkan');
        }

    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $deletedUser = $user->delete();

        if($deletedUser){
            session()->flash('message', 'berhasil menghapus data');
            return response()->json(['message'=> 'success'],200);
        }
    }


    public function createAdmin () {
       return view('dashboard.admin.input');
    }


    public function storeAdmin (Request $request) {
        $this->validate($request, [
                'name'=>['required'],
                'email'=>['required'],
                'password'=>['required'],
                'phone'=>['required'],
                'address'=>['required']
        ]);

        $userCreated = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>'admin',
            'password'=>Hash::make($request->password),
            'phone'=>['required'],
            'address'=>['required']
        ]);

        if($userCreated){
            return redirect('/admin')->with('message','data berhasil ditambahkan');
        }
    }

    public function editAdmin ($id) {
        $admin = User::findOrFail($id);
        return view('dashboard.admin.update', ['admin'=>$admin]);
    }

    public function updateAdmin (Request $request, $id) {
    $this->validate($request, [
            'name'=>['required'],
            'email'=>['required'],
            'phone'=>['required'],
            'address'=>['required']
    ]);

    $admin = User::findOrFail($id);

    if($request->has('password')) {
        $password = Hash::make($request->password);
    } else {
        $password = $admin->password;
    }

    $updated = $admin->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$password,
        'role'=>'admin',
        'phone'=>$request->phone,
        'address'=>$request->address
    ]);

    if($updated){
        return redirect('/admin')->with('message','data berhasil diubah');
    }
    }

}

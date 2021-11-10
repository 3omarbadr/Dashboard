<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data['users'] = User::orderBy('id', 'DESC')->paginate(1);
        $data['admins'] = Admin::orderBy('id', 'DESC')->paginate(1);

        return view('admin.users.index',)->with($data);
    }

    // public function create()
    // {
    //     $roles = Role::pluck('name', 'name')->all();
    //     return view('admin.users.create', compact('roles'));
    // }


    public function store(Request $request)
    {
       
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully');
        
    }
}

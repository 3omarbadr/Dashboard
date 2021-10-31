<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function index() {
        return view('admin.home.index');
    }

    public function login(Request $request) {
        $admin = Admin::where("email" , $request->email)->first();

        if(!$admin ||! Hash::check($request->password,$admin->password)){
            throw ValidationException::withMessages([
                'email' => ['the provided credentials are incorrect'],

            ]);
        }
        return redirect()->route("dashboard")->with("success","Welcome Admin");
    }
}

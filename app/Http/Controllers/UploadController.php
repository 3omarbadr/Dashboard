<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UploadController extends Controller
{
    public function index(){
     
    	return view('item.uploadstorage');
    }

    public function store(Request $request){

    	  $request->validate([
            'img.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
           
        ]);
//check if file exist 
      if($request->hasFile('img')){
      	$file = $request->file('img');
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/',$filename);
      	return redirect('/uploadfile');
      }
    }
}
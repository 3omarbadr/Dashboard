<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class CatController extends Controller
{
    public function index()
    {
        $category = Cat::orderBy('id', 'ASC')->paginate(3);

        return view('admin.cats.index', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $path = Storage::disk('cats')->put('/', $request->file('img'));

        $attributes = $request->validated();
        $attributes['img'] = $path;
        Cat::create($attributes);
        $request->session()->flash('msg', 'row added successfuly');
        return back();

        // With Ajax

        // $data = ['success' => 'row added successfuly'];
        // return Response::json($data);
    }

    public function update(CategoryRequest $request, Cat $cat)
    {
        $path = $cat->img;

        if ($request->hasFile('img')) {
            Storage::delete($path);
            Storage::disk('cats')->put('/', $request->file('img'));
        }
        $attributes = $request->validated();
        $attributes['img'] = $path;
        $cat->update($attributes);

        $request->session()->flash('msg', 'row updated successfuly');
        return back();

        // With Ajax
        // $data = ['success' => 'row added successfuly'];
        // return Response::json($data);
    }

    public function toggle(Cat $cat)
    {
        $cat->update([
            'active' => !$cat->active
        ]);
        return back();

        //With ajax
        // return Response::json($cat);
    }

    public function delete(Cat $cat, Request $request)
    {
        try {
            $path = $cat->img;
            $cat->delete();
            Storage::delete($path);
            $msg = "row deleted successfully";
        } catch (Exception $e) {
            $msg = "can't delete this row";
        }

        $request->session()->flash('msg', $msg);
        return back();
    }
}

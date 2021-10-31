<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:cat-list|cat-create|cat-edit|cat-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:cat-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cat-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cat-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Cat::latest()->paginate(5);
        return view('cats.index', compact('cats'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'img' => 'required'
        ]);
        Cat::create($request->all());
        return redirect()->route('cats.index')
            ->with('success', 'cat created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
        return view('cats.show', compact('cat'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        return view('cats.edit', compact('cat'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cat $cat)
    {
        // dd($request);
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        $cat->update($request->all());
        return redirect()->route('cats.index')
            ->with('success', 'cat updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cat)
    {
        $cat->delete();
        return redirect()->route('cats.index')
            ->with('success', 'cat deleted successfully');
    }
}

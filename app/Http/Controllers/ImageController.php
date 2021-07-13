<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titrepage = "Importation d'un nouveau media";
        return view('images.form', compact('titrepage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $image = Image::create([
            'name' => $request->name
        ]);

        if ($image) {
            if ($request->hasFile('image')) {
                $image->addMediaFromRequest('image')->toMediaCollection('images');
            }
        }

        session()->flash('success', 'Image create successfully');

        return redirect()->route('images.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);
        return view('images.show', compact('image'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);
        $titrepage = "Édition d'un media existant";
        return view('images.form', compact('image', 'titrepage'));
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $image = Image::find($id);
        $image->name = $request->name;
        $image->save();

        if ($image) {
            if ($request->hasFile('image')) {
                $image->clearMediaCollection('images');
                $image->addMediaFromRequest('image')->toMediaCollection('images');
            }
        }

        session()->flash('success', 'Image Update successfully');

        return redirect()->route('images.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();

        session()->flash('success', 'Image Delete successfully');

        return redirect()->route('images.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = trim(request('q',''));
        $props = Property::query()->where('user_id', auth()->id())
            ->when($q !== '', function($x) use ($q) {
                $like = '%'.str_replace(['%','_'], ['\\%','\\_'], $q).'%';
                $x->where(function($w) use ($like) {
                    $w->where('name','like',$like)
                        ->orWhere('address','like',$like);
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('properties.index', compact('props','q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.create');//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $req)
    {
        Property::create([...$req->validated(), 'user_id' => $req->user()->id]);
        return redirect()->route('properties.index')->with('ok','Dodano.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        \Illuminate\Support\Facades\Gate::authorize("view", $property);
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        \Illuminate\Support\Facades\Gate::authorize("update", $property);
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $req, Property $property)
    {
        \Illuminate\Support\Facades\Gate::authorize("update", $property);
        $property->update($req->validated());
        return redirect()->route('properties.index')->with('ok','Zaktualizowano.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        \Illuminate\Support\Facades\Gate::authorize("delete", $property);
        $property->delete();
        return back()->with('ok','Usunięto.');
    }
}

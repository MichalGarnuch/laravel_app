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
        $q = request('q');
        $props = Property::query()
            ->when($q, fn($x)=>$x->where(fn($w)=>$w
                ->where('name','like',"%$q%")
                ->orWhere('address','like',"%$q%")))
            ->latest()->paginate(10)->withQueryString();

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
        Property::create($req->validated());
        return redirect()->route('properties.index')->with('ok','Dodano.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $req, Property $property)
    {
        $property->update($req->validated());
        return redirect()->route('properties.index')->with('ok','Zaktualizowano.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return back()->with('ok','Usunięto.');
    }
}

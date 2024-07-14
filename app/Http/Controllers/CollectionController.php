<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $collections = Collection::where('user_id', $user->id)->paginate(5);

        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate =  $request->validate([
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'adress' => 'required|string|max:255',
            'postalcode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);
        // dd($validate);
        Collection::create($validate);

        return redirect()->route('collections.index')->with('success', 'Collection created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        return view('collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        return view('collections.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {
        $request->validate([

            'description' => 'nullable|string',
            'adress' => 'required|string|max:255',
            'postalcode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $collection->update($request->all());

        return redirect()->route('collections.index')->with('success', 'Collection updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();

        return redirect()->route('collections.index')->with('success', 'Collection deleted successfully.');
    }
}

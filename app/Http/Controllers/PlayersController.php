<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Players::all();
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $players = Players::all();
        return view('players', compact('players'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|unique:players,name',
            'age'     => 'required|integer',
            'address' => 'nullable|string',
            'image'   => 'required|image|max:2048',
        ]);

        $filename = null;

        if ($request->hasFile('image')) {
            $filename = Str::slug($request->name) . '-player-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $filename);
        }

        Players::create([
            'name'    => $request->name,
            'age'     => $request->age,
            'address' => $request->address,
            'image'   => $filename,
        ]);

        return back()->with('success', 'Player added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Players $players)
    {
        return view('players.show', compact('players'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $players = Players::findOrFail($id);
        return view('players.edit', compact('players'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $players = Players::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'age'     => 'required|integer',
            'address' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        $players->name    = $request->name;
        $players->age     = $request->age;
        $players->address = $request->address;

        if ($request->hasFile('image')) {

            // delete old image
            if ($players->image && file_exists(public_path('uploads/' . $players->image))) {
                unlink(public_path('uploads/' . $players->image));
            }

            $filename = Str::slug($request->name) . '-player-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $filename);

            $players->image = $filename;
        }

        $players->save();

        return back()->with('success', 'Player updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $player = Players::findOrFail($id);

        // delete image
        if ($player->image && file_exists(public_path('uploads/' . $player->image))) {
            unlink(public_path('uploads/' . $player->image));
        }

        $player->delete();

        return back()->with('delete', 'Player deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display all modules.
     */
    public function index()
    {
        $menus = Menu::all();

        return view('menus.index', compact('menus'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a new module.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:menus,name|max:255',
            'slug' => 'required|unique:menus,slug|max:255',
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index')
                         ->with('success', 'Module added successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    /**
     * Update module.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|max:255|unique:menus,name,' . $menu->id,
            'slug' => 'required|max:255|unique:menus,slug,' . $menu->id,
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')
                         ->with('success', 'Module updated successfully.');
    }

    /**
     * Delete module.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')
                         ->with('success', 'Module deleted successfully.');
    }
}
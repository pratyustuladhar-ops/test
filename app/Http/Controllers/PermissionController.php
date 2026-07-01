<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Menu;

class PermissionController extends Controller
{
    /**
     * Display the Permission Management page.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $menus = Menu::all();

        $selectedRole = $request->role_id;

        $assignedMenus = [];

        if ($selectedRole) {

            $assignedMenus = DB::table('role_menu')
                ->where('role_id', $selectedRole)
                ->pluck('menu_id')
                ->toArray();
        }

        return view('permissions.index', compact(
            'roles',
            'menus',
            'selectedRole',
            'assignedMenus'
        ));
    }

    /**
     * Save permissions (Role ↔ Module).
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        DB::table('role_menu')
            ->where('role_id', $request->role_id)
            ->delete();

        if ($request->has('menus')) {

            foreach ($request->menus as $menuId) {

                DB::table('role_menu')->insert([
                    'role_id' => $request->role_id,
                    'menu_id' => $menuId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }

        }

        return redirect()
            ->route('permissions.index', ['role_id' => $request->role_id])
            ->with('success', 'Permissions updated successfully.');
    }
}
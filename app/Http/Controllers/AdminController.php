<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function listUsers(Request $request) {
        $roleFilter = $request->role();
        $query = User::with('kelas');

        if($roleFilter) {
            $query->where('role', $roleFilter);
        }

        $users = $query->paginate(6);
        $roles = ['admin', 'bendahara', 'siswa', 'wali_kelas'];

        return view('admin.index', [
            'users' => $users,
            'roles' => $roles,
            'roleFilter' => $roleFilter
        ]);
    }
}

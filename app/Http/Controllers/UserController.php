<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request){
        // Determine the number of users per page (default to 10 if not provided)
        $perPage = $request->get('limit', 10);

        // Paginate the users
        $users = User::paginate($perPage);

        // Get the total number of users
        $totalUsers = User::count();

        return response()->json([
            'rows' => $users->items(), // Get the users for the current page
            'total' => $totalUsers,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
            'last_page' => $users->lastPage(),
        ], 200);
    }


}

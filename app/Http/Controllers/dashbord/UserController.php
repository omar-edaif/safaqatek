<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', User::CUSTOMER)->with('residence')
            ->when(
                request('search'),
                fn ($query) => $query->where('firstname', 'like', '%' . request('search') . '%')
                    ->orwhere('firstname', 'like', '%' . request('search') . '%')
                    ->orwhere('phone', 'like', '%' . request('search') . '%')
                    ->orwhere('email', 'like', '%' . request('search') . '%')
            )
            ->paginate(20);
        return view('dashbord.users.index', compact('users'));
    }





    public function delete($id)
    {
        $user  =   User::FindOrFail($id);

        $user->delete();

        return redirect()->route('dashbord.users.index')->with('deleted', __('the user was deleted'));
    }
}

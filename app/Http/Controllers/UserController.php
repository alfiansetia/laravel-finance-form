<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    private $title = 'User';

    public function profile()
    {
        return view('user.profile')->with(['title' => $this->title]);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name'  => 'required|min:2|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);
        if ($user) {
            return redirect()->route('user.profile')->with(['success' => 'Profile berhasil diupdate!']);
        } else {
            return redirect()->route('user.profile')->with(['error' => 'Profile gagal diupdate!']);
        }
    }

    public function passwordUpdate(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'password'          =>  ['required', 'same:confirm_password', Password::min(5)->numbers()],
            'confirm_password'  => 'required|',
        ]);
        $user->update([
            'password'  => Hash::make($request->password),
        ]);
        if ($user) {
            return redirect()->route('user.profile')->with(['success' => 'Password berhasil diupdate!']);
        } else {
            return redirect()->route('user.profile')->with(['error' => 'Password gagal diupdate!']);
        }
    }
}

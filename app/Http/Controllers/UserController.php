<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    private $title = 'User';

    public function __construct()
    {
        $this->middleware('role');
    }

    function index()
    {
        $data = User::all();
        return view('user.index', compact('data'))->with(['title' => $this->title]);
    }

    function create()
    {
        return view('user.add')->with(['title' => $this->title]);
    }

    public function show()
    {
        abort(404);
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:50',
            'email'     => 'required|max:50|unique:users,email',
            'password'  => 'required|min:5',
            'role'      => 'required|in:admin,user',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
        ]);

        if ($user) {
            return redirect()->route('user.index')->with(['success' => 'Data berhasil ditambah!']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Data gagal ditambah!']);
        }
    }

    function edit(User $user)
    {
        if (!$user) {
            abort(404);
        }
        $data = $user;
        return view('user.edit', compact('data'))->with(['title' => $this->title]);
    }

    function update(Request $request, User $user)
    {
        if (!$user) {
            abort(404);
        }
        $this->validate($request, [
            'name'      => 'required|max:50',
            'email'     => 'required|max:50|unique:users,email,' . $user->id,
            'password'  => 'min:5|nullable',
            'role'      => 'required|in:admin,user',
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password'  => Hash::make($request->password),
            ]);
        }
        $user = $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
        ]);

        if ($user) {
            return redirect()->route('user.index')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Data gagal diubah!']);
        }
    }

    public function destroy(User $user)
    {
        if (!$user) {
            abort(404);
        }
        $user = $user->delete();
        if ($user) {
            return redirect()->route('user.index')->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Data gagal dihapus!']);
        }
    }






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

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::paginate(7);
        return view('admin.admin', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $last_id = User::orderBy('id', 'desc')->first()->id;
        $new_id = $last_id + 1;
        
        $user = new User;
        $user->id = $new_id;
        $user->password = Hash::make('password');
        $user->role = 'admin';
        $user->save();
        
        $admin = new Admin;
        $admin->id = $new_id;
        $admin->name = $request->name;
        $admin->no_karyawan = $request->no_karyawan;
        $admin->gender = $request->gender;
        $user->admin()->save($admin);

        return redirect()->route('admin')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Admin $admin)
    {
        //
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    public function destroy($id)
    {
        $user = User::with('admin')->find($id);

        if ($user) {
            if ($user->admin) {
                $user->admin->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'Data Admin berhasil dihapus.');
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

// use Auth;
use App\Models\Guru;
// use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
	public function authenticate(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
    
        $user = User::with(['admin','guru','siswa'])->get();
    
        foreach ($user as $data) {
            if ($data->admin) {
                if ($data->admin->no_karyawan == $username && Hash::check($password, $data->password)) {
                    Auth::login($data);
                    return view('user.index');
                }
            } elseif ($data->guru) {
                if ($data->guru->kd_guru == $username && Hash::check($password, $data->password)) {
                    Auth::login($data);
                    return view('user.index');
                }
            } elseif ($data->siswa) {
                if ($data->siswa->nim_murid == $username && Hash::check($password, $data->password)) {
                    Auth::login($data);
                    return view('user.index');
                }
            }
        }
    
        return back()->with(['error' => 'Username atau password salah']);
    }
}

// $username = $request->input('username');
// $password = $request->input('password');

// // $users = User::with('admin','dosen')->get();
// $users = User::with('admin', 'dosen')->get();
// // Check if the user is an admin
// $admin = Admin::where('no_karyawan', $username)->first();
// if ($admin && Hash::check($password, $admin->user->password)) {
//     // Log the admin in
//     Auth::login($admin->user);
//     // return redirect()->route('user.index',compact('users'));
//     return view('user.index');
// }

// // Check if the user is a dosen
// $dosen = Dosen::where('kd_dosen', $username)->first();
// if ($dosen && Hash::check($password, $dosen->user->password)) {
//     // Log the dosen in
//     Auth::login($dosen->user);
//     return view('user.index');
// }

// // If the user is neither an admin nor a dosen, redirect back to the login page
// return redirect()->back()->withErrors(['Invalid username or password.']);
//     }
        
        
// }
	// public function authenticate(Request $request)
    // {
    //     $username = $request->input('username');
	// 	$password = $request->input('password');
	// 	if(substr($username, 0, 3) == "adm"){
	// 		// login sebagai admin
	// 		$admin = Admin::where('no_karyawan', $username)->where('name', $password)->first();
	// 		if($admin){
	// 			// login success
	// 			Auth::login($admin);
	// 			return redirect()->route('admin');
	// 		}else{
	// 			// login failed
	// 			return redirect()->back()->withInput($request->only('username'))->with('error','Wrong Credentials');
	// 		}
	// 	}else{
    //     // login sebagai dosen
    //     $dosen = Dosen::where('kd_dosen', $username)->where('name', $password)->first();
    //     if($dosen){
    //         // login success
    //         Auth::login($dosen);
    //         return redirect()->route('dosen');
    //     }else{
    //         // login failed
    //         return redirect()->back()->withInput($request->only('username'))->with('error','Wrong Credentials');
    //     }
    // }
		

    //     // if (!$admin) {
            
    //     //     if (!$dosen) {
    //     //         return false;
    //     //     }
    //     //     $user = $dosen->user;
    //     // } else {
    //     //     $user = $admin->user;
    //     // }
    //     // return $this->guard()->attempt(
    //     //     $credentials, $request->filled('remember')
    //     // );
    // }


	// public function validateLogin(Request $request)
	// {
	// 	$request->validate([
	// 		'username' => 'required|string',
	// 		'password' => 'required|string',
	// 	]);
	// }

	// public function authenticate(Request $request)
    // {
    //     $this->validateLogin($request);
    //     if ($this->attemptLogin($request)) {
    //         return $this->sendLoginResponse($request);
    //     }
    //     return $this->sendFailedLoginResponse($request);
    // }



	// public function authenticate(Request $request)
    // {
	// 	$input = request()->all();
    //     if (auth()->guard('admin')->attempt(['no_karyawan' => $input['username'], 'name' => $input['password']])) {
	// 		$user = auth()->guard('admin')->user();
	// 		if($user->role() == 'admin') {
	// 			return redirect()->route('admin');
	// 		}
	// 		elseif($user->role() == 'dosen') {
	// 			return redirect()->route('dosen');
	// 		}
	// 		else {
	// 			return redirect()->route('home');
	// 		}
	// 	}		
//     }
// }
	
	// {
	// 	$credentials = request()->only(['username','password']);

	// 	if (Auth::attempt($credentials)) {
	// 		return redirect()->intended('user');
	// 	}else{
	// 		return back()->with('error','Login gagal');
	// 	}
	// }
// }

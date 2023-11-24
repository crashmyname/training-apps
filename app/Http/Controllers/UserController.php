<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $title = "Master User";
        if($request->ajax()){
            $user = User::select('uid','nik','name','email','section','role','foto','created_at','updated_at')
            ->get();
            return DataTables::of($user)
            ->make(true);
        }
        $role = Role::all();
        $dataApi = Http::get('http://10.203.68.47:90/fambook/config/api.php');
        $result = $dataApi->json();
        return view('user.user',compact('title','result','role'));
    }

    public function addUser(Request $request)
    {
        // dd($request);
        // $validate = $request->validate([
        //     'nik' => 'required',
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'section' => 'required',
        //     'role' => 'required',
        //     'foto' => 'image',
        // ]);
        $user = new User();
        $user->nik = $request->has('nik') ? $request->nik : null;
        $user->name = strtoupper($request->name);
        $user->section = strtoupper($request->section);
        $user->password = Hash::make($request->password);

        if ($request->file('foto')) {
            $originalname = $request->foto->getClientOriginalName();
            $namafoto = $request->file('foto')->storeAs('public/profil-user', $originalname);
        }
        
        $user->foto = $request->hasFile('foto') ? $request->file('foto')->getClientOriginalName() : 'default_profil.png';
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        \Artisan::call('storage:link');
        // $request->session()->flash('berhasil','Data '. $request->name .' added successfully');
        $notification = [
            'title' => 'Success!',
            'text' => 'Data ' . $request->name . ' added successfully',
            'icon' => 'success',
        ];
        return redirect()->route('user')->with('notification',$notification);
    }

    public function editUser(Request $request, $id)
    {
        // dd($request);
        $user = User::find($id);
        if($request->filled('password')){
            $user->password = bcrypt($request->password);
        }
        if($request->hasFile('foto')){
            $oriname = $request->foto->getClientOriginalName();
            $foto = $request->file('foto')->storeAs('public/profil-user',$oriname);
            $user->foto = $oriname;
        }
        $user->nik = $request->has('nik') ? $request->nik : null;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        $notification = [
            'title' => 'Success!',
            'text' => 'Data '. $request->name . ' update successfully',
            'icon' => 'success',
        ];
        return redirect()->route('user')->with('notification',$notification);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message'=>'Data deleted successfully']);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function onLogin(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($validasi)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }else{
            $alert = [
                'title' => 'Error',
                'text' => 'The email or password you entered is incorrect!!',
                'icon' => 'error',
            ];
            return back()->with('alert',$alert);
        }
    }

    public function logOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

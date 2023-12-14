<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\User;
use App\Models\Score;
use App\Models\SchTraining;
use App\Models\DataTrain;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        $title = "Dashboard";
        $training = Training::all();
        $user = User::all();
        $schedule = SchTraining::all();
        $datatrain = DataTrain::all();
        $ongo = SchTraining::where(function($query){$query->where('section',auth()->user()->section)->orWhere('section','ALL')->where('statusmonitor','On Going')->orWhere('statusmonitor','Open');})->orderBy('statusmonitor','asc')->orderBy('name_training','asc')->orderBy('actual','asc')->get();
        return view('home',compact('title','training','user','schedule','datatrain','ongo'));
    }

    public function employee(Request $request)
    {
        $title = "Employee";
        if($request->ajax()){
            $emp = Http::get('http://10.203.68.47:90/fambook/config/api2.php');
            $result = $emp->json();
            return DataTables::of($result)
            ->make(true);
        }
        return view('employee.employee',compact('title'));
    }
}

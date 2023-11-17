<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\User;
use App\Models\Score;
use App\Models\SchTraining;
use App\Models\DataTrain;

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
        return view('home',compact('title','training','user','schedule','datatrain'));
    }
}

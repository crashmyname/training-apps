<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ScoreController extends Controller
{
    public function index(Request $request)
    {
        $title = "Master Score";
        if($request->ajax()){
            $score = Score::select('id_score','icon','range_score','keterangan','created_at','updated_at')
            ->get();
            return DataTables::of($score)
            ->make(true);
        }
        return view('score.score',compact('title'));
    }

    public function addScore(Request $request)
    {

    }

    public function editScore(Request $request)
    {

    }

    public function deleteScore(Request $request)
    {

    }
}

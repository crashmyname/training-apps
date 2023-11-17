<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\SchTraining;
use App\Models\DataTrain;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Http;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $title = "Master Training";
        if($request->ajax()){
            $training = Training::select('id_training','kode_training','name_training','created_by','updated_by','created_at','updated_at')
            ->get();
            return DataTables::of($training)
            ->make(true);
        }
        $training = Training::orderBy('kode_training','desc')->first();
        if ($training) {
            $lastCode = intval(substr($training->kode_training, 2)); // Mengambil angka dari kode terakhir
            $newCode = 'KT' . str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT); // Menghasilkan kode baru
        } else {
            $newCode = 'KT001'; // Jika belum ada data, mulai dari KT001
        }
        return view('training.training',compact('title','training','newCode'));
    }

    public function addTraining(Request $request)
    {
        $validate = $request->validate([
            'kode_training' => 'required',
            'name_training' => 'required',
        ]);
        $validate['kode_training'] = strtoupper($validate['kode_training']);
        $validate['name_training'] = strtoupper($validate['name_training']);
        Training::create($validate);
        // $request->session()->flash('berhasil','Data '. $request->name_training .' added successfully');
        $notification = [
            'title' => 'Success!',
            'text' => 'Data '. $request->name_training .' added successfully',
            'icon' => 'success',
        ];
        return redirect()->route('training')->with('notification',$notification);
    }

    public function editTraining(Request $request, $id)
    {
        $training = Training::find($id);
        $request->validate([
            'kode_training' => 'required|max:5',
            'name_training' => 'required',
        ]);
        $training->kode_training = strtoupper($request->kode_training);
        $training->name_training = strtoupper($request->name_training);
        
        $training->save();
        $notification = [
            'title' => 'Success!',
            'text' => 'Changed data successfully',
            'icon' => 'success',
        ];
        return redirect()->route('training')->with('notification',$notification);
    }

    public function deleteTraining(Request $request, $id)
    {
        $training = Training::find($id);
        $training->delete();
        return response()->json(['message'=>'Data deleted successfully']);
    }

    public function dataTraining()
    {
        $title = "Data Training";
        $dataApi = Http::get('http://10.203.68.47:90/fambook/config/api.php');
        $result = $dataApi->json();
        $training = Training::select('kode_training','name_training')->get();
        return view('training.data_training',compact('title','result','training'));
    }

    public function ScheduleTraining(Request $request)
    {
        $title = "Schedule Training";
        $training = Training::select('kode_training','name_training')->get();
        $dept = Http::get('http://10.203.77.64/klinik/function/apidept.php');
        $resultDept = $dept->json();
        $picApi = Http::get('http://10.203.68.47:90/fambook/config/api.php');
        $pic = $picApi->json();
        $dataApi = Http::get('http://10.203.68.47:90/fambook/config/api.php');
        $result = $dataApi->json();
        if($request->ajax()){
            $sch = SchTraining::all();
            return DataTables::of($sch)
            ->make(true);
        }
        return view('training.sch_training',compact('title','training','resultDept','result','pic'));
    }

    public function addSchtraining(Request $request)
    {
        SchTraining::create([
            'name_training' => $request->name_training,
            'name_trainer' => $request->name_trainer,
            'section' => $request->section,
            'plan' => $request->plan,
            'participants' => $request->participants,
            'pic' => $request->pic,
            'duedate' => $request->duedate,
            'statusmonitor' => $request->statusmonitor,
            'desc' => $request->desc,
        ]);
        $notification = [
            'title' => 'Success!',
            'text' => 'Schedule added successfully',
            'icon' => 'success'
        ];
        return redirect()->route('schedule')->with('notification',$notification);
    }

    public function editSchtraining(Request $request, $id)
    {
        $sch = SchTraining::find($id);
        $sch->name_training = $request->name_training;
        $sch->name_trainer = $request->name_trainer;
        $sch->section = $request->section;
        $sch->plan = $request->plan;
        $sch->replan1 = $request->replan1;
        $sch->replan2 = $request->replan2;
        $sch->replan3 = $request->replan3;
        $sch->actual = $request->actual;
        $sch->participants = $request->participants;
        $sch->pic = $request->pic;
        $sch->duedate = $request->duedate;
        $sch->statusmonitor = $request->statusmonitor;
        $sch->desc = $request->desc;
        $sch->save();
        $notification = [
            'title' => 'Success!',
            'text' => 'Update data successfully!!!',
            'icon' => 'success',
        ];
        return redirect()->route('schedule')->with('notification',$notification);
    }

    public function deleteSchtraining($id)
    {
        $schedule = SchTraining::find($id);
        $schedule->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }

    public function formSchtraining($id)
    {
        $schedule = SchTraining::find($id);
        $title = "Form Add Participants";
        $dataApi = Http::get('http://10.203.68.47:90/fambook/config/api.php');
        $result = $dataApi->json();
        return view('training.add_participants',compact('schedule','title','result'));
    }

    public function addParticipants(Request $request, $id)
    {
        DataTrain::create([
            'schedule_id' => $id,
            'nik' => $request->nik,
            'name' => $request->name,
            'section' => $request->section,
            'matepl' => 'OK',
            'questfeedback' => 'OK'
        ]);
        $notification = [
            'title' => 'Success!',
            'text' => $request->name.' Added Successfully',
            'icon' => 'success',
        ];
        return redirect()->route('form-participants',$id)->with('notification',$notification);
    }
}

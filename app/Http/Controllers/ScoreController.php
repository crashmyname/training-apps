<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\ScoreA;
use App\Models\ScoreB;
use App\Models\DataTrain;
use App\Models\SchTraining;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;

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

    public function inputScoreA(Request $request)
    {
        ScoreA::create([
            'train_id' => $request->train_id,
            'schedule_id' => $request->schedule_id,
            'nik' => $request->nik,
            'name' => $request->name,
            'section' => $request->section,
            'pemahaman' => $request->pemahaman,
            'skill' => $request->skill,
            'kinerja' => $request->kinerja,
            'implementasi' => $request->implementasi,
            'improvement' => $request->improvement,
            'mengajarkan' => $request->mengajarkan,
            'kesimpulan' => $request->kesimpulan,
            'status' => 'Close',
            'created_by' => auth()->user()->name,
        ]);
        DataTrain::where('schedule_id',$request->schedule_id)->where('nik',$request->nik)->update([
            'scorea' => 'OK',
            'evaluation' => 'OK',
            'modify_by' => auth()->user()->name,
        ]);
        return response()->json(['status' => 'success']);
    }

    public function formupdateScore($id)
    {
        $title = "Form Update Score";
        $finalscore = DataTrain::find($id);
        $scorea = ScoreA::where('train_id',$id)->get()->first();
        $scoreb = ScoreB::where('train_id',$id)->get()->first();
        $pemahaman = $scorea ? $scorea->pemahaman : null;
        $skill = $scorea ? $scorea->skill : null;
        $kinerja = $scorea ? $scorea->kinerja : null;
        $implementasi = $scorea ? $scorea->implementasi : null;
        $improvement = $scorea ? $scorea->improvement : null;
        $mengajarkan = $scorea ? $scorea->mengajarkan : null;
        $kesimpulan = $scorea ? $scorea->kesimpulan : null;
        $tes = $scoreb ? $scoreb->tes : null;
        return view('score.form_update_score',compact('finalscore','title','scorea','scoreb'));
    }

    public function updateScore(Request $request,$id)
    {
        $scorea = ScoreA::firstWhere('train_id',$id);
        $scoreb = ScoreB::firstWhere('train_id',$id);
        $scorea->pemahaman = $request->pemahaman;
        $scorea->skill = $request->skill;
        $scorea->kinerja = $request->kinerja;
        $scorea->implementasi = $request->implementasi;
        $scorea->improvement = $request->improvement;
        $scorea->mengajarkan = $request->mengajarkan;
        $scorea->kesimpulan = $request->kesimpulan;
        $scoreb->tes = $request->tes;
        $scorea->save();
        $scoreb->save();
        $notification = [
            'title' => 'Success!',
            'text' => $request->name.' Added Successfully',
            'icon' => 'success',
        ];
        return redirect()->route('form-updatescore',$id)->with('notification',$notification);
    }

    public function inputScoreB(Request $request)
    {
        ScoreB::create([
            'train_id' => $request->train_id,
            'schedule_id' => $request->schedule_id,
            'nik' => $request->nik,
            'name' => $request->name,
            'section' => $request->section,
            'tes' => $request->tes,
            'created_by' => auth()->user()->name,
        ]);
        DataTrain::where('schedule_id',$request->schedule_id)->where('nik',$request->nik)->update([
            'scoreb' => 'OK',
            'evaluation'=> 'OK',
            'modify_by' => auth()->user()->name,
        ]);
        return response()->json(['status' => 'success']);
    }

    public function finalScore($id)
    {
        $title = "Final Score";
        $finalscore = DataTrain::find($id);
        // dd($finalscore);
        $scorea = ScoreA::where('train_id',$id)->get()->first();
        $scoreb = ScoreB::where('train_id',$id)->get()->first();
        $pemahaman = $scorea ? $scorea->pemahaman : null;
        $skill = $scorea ? $scorea->skill : null;
        $kinerja = $scorea ? $scorea->kinerja : null;
        $implementasi = $scorea ? $scorea->implementasi : null;
        $improvement = $scorea ? $scorea->improvement : null;
        $mengajarkan = $scorea ? $scorea->mengajarkan : null;
        $tes = $scoreb ? $scoreb->tes : null;
        $totalscorea = $pemahaman+$skill+$kinerja+$implementasi+$improvement+$mengajarkan;
        $averagescorea = round($totalscorea/6,2);
        $total = $averagescorea+$tes;
        $final = round($total/2,2);
        return view('score.final_score',compact('finalscore','title','scorea','scoreb','totalscorea','averagescorea','final'));
    }

    public function test()
    {
        return view('score.pdf_score');
    }

    public function PdfScore(Request $request, $id)
    {
        $title = "PDF Score";
        $existingPdf = public_path('pdf/web1.pdf');
        $finalscore = DataTrain::find($id);
        $iD = $finalscore->schedule_id;
        $folderPath = public_path('pdf/score/'.$iD);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $namefile = $finalscore->nik." ".$finalscore->name; //ini nama file
        $mix = $folderPath.'/'.$namefile.'.pdf';
        $fpdi = new FPDI;
        $count = $fpdi->setSourceFile($existingPdf);
        $sch = SchTraining::where('schedule_id',$finalscore->schedule_id)->first();
        $scorea = ScoreA::where('train_id',$id)->get()->first();
        $scoreb = ScoreB::where('train_id',$id)->get()->first();
        $pemahaman = $scorea ? $scorea->pemahaman : null;
        $skill = $scorea ? $scorea->skill : null;
        $kinerja = $scorea ? $scorea->kinerja : null;
        $implementasi = $scorea ? $scorea->implementasi : null;
        $improvement = $scorea ? $scorea->improvement : null;
        $mengajarkan = $scorea ? $scorea->mengajarkan : null;
        $kesimpulan = $scorea ? $scorea->kesimpulan : null;
        $tes = $scoreb ? $scoreb->tes : null;
        $totalscorea = $pemahaman+$skill+$kinerja+$implementasi+$improvement+$mengajarkan;
        $averagescorea = round($totalscorea/6,2);
        $total = $averagescorea+$tes;
        $final = round($total/2,2);
        for ($i=1; $i<=$count; $i++) {
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
            $fpdi->SetFont("Arial", "B", 9);
            $fpdi->SetTextColor(0,0,0);
            $fpdi->Text(51,35,$sch->name_training);
            $fpdi->Text(51,40,\Carbon\Carbon::parse($sch->actual)->format('d-M-Y'));
            $fpdi->Text(51,44.5,$sch->pic);
            $fpdi->Text(51,49,$sch->name_trainer);
            $fpdi->Text(51,54,$finalscore->nik.' / '.$finalscore->name);
            $fpdi->Text(51,58.5,$finalscore->section);
            $fpdi->Text(51,63.5,\Carbon\Carbon::parse($sch->duedate)->format('d-M-Y'));
            $fpdi->Text(99,94.5,$pemahaman);
            $fpdi->Text(99,100.5,$skill);
            $fpdi->Text(99,107,$kinerja);
            $fpdi->Text(99,113,$implementasi);
            $fpdi->Text(99,119,$improvement);
            $fpdi->Text(99,125.5,$mengajarkan);
            $fpdi->Text(98,205.5,$totalscorea);
            $fpdi->Text(98,205.5,$totalscorea);
            if(strlen($averagescorea) == 2){
                $fpdi->Text(98.9,212,$averagescorea);
            }elseif(is_float($averagescorea)){
                $fpdi->Text(96.8,212,$averagescorea);
            }else{
                $fpdi->Text(98.8,212,$averagescorea);
            }
            $fpdi->SetFont("Arial", "B", 12);
            $fpdi->SetTextColor(0,0,0);
            if(strlen($tes)==2){
                $fpdi->Text(128.5,94.5,$tes);
            }else{
                $fpdi->Text(127.5,94.5,$tes);
            }
            $fpdi->SetFont("Arial", "B", 9);
            $fpdi->SetTextColor(0,0,0);
            if(strlen($averagescorea) == 2){
                $fpdi->Text(145.5,131.5,$averagescorea);
            }elseif(is_float($averagescorea)){
                $fpdi->Text(144,131.5,$averagescorea);
            }else{
                $fpdi->Text(143.5,131.5,$averagescorea);
            }
            if(strlen($total) == 3){
                $fpdi->Text(144.5,143.5,$total);
            }elseif(is_float($total)){
                $fpdi->Text(143,143.5,$total);
            }else{
                $fpdi->Text(142.5,143.5,$total);
            }
            if(strlen($tes) == 2){
                $fpdi->Text(145.5,137.5,$tes);
            }else{
                $fpdi->Text(144.5,137.5,$tes);
            }
            $fpdi->SetFont("Arial", "", 9);
            $fpdi->SetTextColor(0,0,0);
            if(strlen($kesimpulan)>=44){
                $maxWidth = 80;
                $lineHeight = 3;
                $lines = explode("\n",wordwrap($kesimpulan,45,"\n"));
                $x = 117; // Left position
                $y = 197.5; // Top position
                $fpdi->setXY($x,$y);
                foreach ($lines as $index => $line) {
                    $fpdi->MultiCell($maxWidth, $lineHeight, $line, 0, 'L', false);
                    $fpdi->SetXY($x, $fpdi->GetY() + $lineHeight);
                }
            }else{
                $fpdi->Text(117,200,$kesimpulan);
            }
            $fpdi->SetFont("Arial", "B", 9);
            $fpdi->SetTextColor(0,0,0);
            $fpdi->Text(144,153,$final);
        }
        $fpdi->Output($mix, 'F');
        return response()->download($mix);
    }
}

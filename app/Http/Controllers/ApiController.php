<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function DataApiNama(Request $request)
    {
      $nik = $request->nik;
        try{
        $api = Http::get('http://10.203.68.47:90/fambook/config/api2.php?nik='.$nik);
        $result = $api->json();
        if($result !== null){
            return response()->json($result);
          }
        } catch (\Exception $e){
          return response()->json(['error' => $e->getMessage()], 500); // Mengembalikan pesan error dalam format JSON
        }
    }

    public function DataApiSect(Request $request)
    {
      $nik = $request->nik;
        try{
        $api = Http::get('http://10.203.68.47:90/fambook/config/api2.php?nik='.$nik);
        $result = $api->json();
        if($result !== null){
          return response()->json($result);
        }
        } catch (\Exception $e){
          return response()->json(['error' => $e->getMessage()], 500); // Mengembalikan pesan error dalam format JSON
        }
    }
}

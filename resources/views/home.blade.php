@extends('nav/navbar')
@section('content')
<div class="main-content container-fluid">
<div class="page-title">
<h3>{{$title}}</h3>
<p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
</div>
<section class="section">
<div class="row mb-2">
    @if(auth()->user()->role == "Administrator")
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>COUNT User</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$user->Count()}}</p>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="canvas1" style="height:100px !important"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>COUNT Training</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$training->Count()}}</p>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="canvas2" style="height:100px !important"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>Count Schedule</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$schedule->Count()}}</p>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="canvas3" style="height:100px !important"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body p-0">
                <div class="d-flex flex-column">
                    <div class='px-3 py-3 d-flex justify-content-between'>
                        <h3 class='card-title'>Count Data Train</h3>
                        <div class="card-right d-flex align-items-center">
                            <p>{{$datatrain->Count()-7}}</p>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="canvas4" style="height:100px !important"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contextual classes start -->
<div class="row" id="table-contexual">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Schedule Training On Going</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <p>This is table for Information about schedule training </p>
          </div>
          <!-- table contextual / colored -->
          <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr align="center">
                  <th>Name Training</th>
                  <th>Name Trainer</th>
                  <th>Section</th>
                  <th>Actual Date</th>
                  <th>Pic</th>
                  <th>Status</th>
                  <th>Check Participants</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($ongo as $data)   
                <tr class="table-light">
                    <td class="text-bold-500">{{$data->name_training}}</td>
                    <td align="center">{{$data->name_trainer}}</td>
                    <td class="text-bold-500" align="center">{{$data->section}}</td>
                    <td align="center" width="150px">{{\Carbon\Carbon::parse($data->actual)->format('d-M-Y')}}</td>
                    <td align="center">{{$data->pic}}</td>
                    <td align="center">{{$data->statusmonitor}}</td>
                    <td align="center"><a href="{{route('view-participants',['id' => $data->schedule_id])}}" class="btn btn-primary">Check</a></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Contextual classes end -->
</section>
@endsection
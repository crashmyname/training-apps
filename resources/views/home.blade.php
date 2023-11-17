@extends('nav/navbar')
@section('content')
<div class="main-content container-fluid">
<div class="page-title">
<h3>{{$title}}</h3>
<p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
</div>
<section class="section">
<div class="row mb-2">
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
                            <p>{{$datatrain->Count()}}</p>
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
</section>
@endsection
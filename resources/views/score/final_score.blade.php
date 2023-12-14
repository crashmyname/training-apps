@extends('nav.navbar')
@section('content')
<div class="main-content container-fluid">
  <div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Final Score</h3>
            <p class="text-subtitle text-muted">Page of Form Score.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('nilai-training')}}">Training Assessment</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Final Score</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<a href="{{route('nilai-training')}}" class="btn btn-primary">Back</a><hr>
{{-- <a href="{{route('pdf-score')}}" class="btn btn-primary">PDF</a><hr> --}}
<section id="multiple-column-form">
    <div class="row match-height">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">FORM SCORE</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
                @if(session('notification'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: '{{ session('notification.title') }}',
                    text: '{{ session('notification.text') }}',
                    icon: '{{ session('notification.icon') }}',
                    confirmButtonText: 'OK'
                });
            });
            </script>
            @endif
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="first-name-column">NIK</label>
                      <input type="text" name="nik" value="{{$finalscore->nik}}" class="form form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="last-name-column">Name</label>
                      <input type="text" name="name" value="{{$finalscore->name}}" class="form form-control" readonly>
                    </div>
                  </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Section</label>
                        <input type="text" name="section" value="{{$finalscore->section}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Pemahaman terhadap isi dan tujuan materi</label>
                        <input type="text" name="pemahaman" value="{{$scorea ? $scorea->pemahaman : null}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Peningkatan Skill / Kompetensi</label>
                        <input type="text" name="skill" value="{{$scorea ? $scorea->skill : null}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Peningkatan Kerja</label>
                        <input type="text" name="kinerja" value="{{$scorea ? $scorea->kinerja : null}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Implementasi terhadap pekerjaan</label>
                        <input type="text" name="implementasi" value="{{$scorea ? $scorea->implementasi : null}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Melakukan Perbaikan sistem / Improvement</label>
                        <input type="text" name="improvement" value="{{$scorea ? $scorea->improvement : null}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Mampu Mengajarkan kepada orang lain</label>
                        <input type="text" name="mengajarkan" value="{{$scorea ? $scorea->mengajarkan : null}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Kesimpulan / Komentar Pimpinan Kerja</label>
                        <input type="text" name="kesimpulan" value="{{$scorea ? $scorea->kesimpulan : null}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Hasil Test</label>
                        <input type="text" name="tes" value="{{$scoreb ? $scoreb->tes : "" }}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Total Score A</label>
                        <input type="text" name="scoreA" value="{{$totalscorea}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Rata Rata Nilai</label>
                        <input type="text" name="scoreA" value="{{$averagescorea}}" class="form form-control" readonly>
                    </div>
                    </div>
                    <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="city-column">Final Score</label>
                        <input type="text" name="scoreA" value="{{$final}}" class="form form-control" readonly>
                    </div>
                    </div>
                  {{-- <div class="col-12 d-flex justify-content-end">
                  <button type="button"
                    class="btn btn-primary me-1 mb-1"
                    name="simpan" id="simpan">Submit</button>
                    <button
                      type="reset"
                      class="btn btn-light-secondary me-1 mb-1"
                    >
                      Reset
                    </button> --}}
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<script>
  document.getElementById('simpan').addEventListener('click',function(){
    Swal.fire({
      title: 'Are you sure?',
      text: 'Is the data you entered correct?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes',
    }).then((result)=>{
      if(result.isConfirmed){
        document.getElementById('dataFormParticipants').submit();
      }
    });
  });
    $("#nik").change(function(){
                    var nik = $("#nik").val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('DataApi') }}",
                        data: {
                            _token: csrfToken,
                            nik: nik,
                        },
                        success: function(data){
                            var options = '';
                            data.forEach(function (m) {
                                options += "<option value='" + m.nama + "'>" + m.nama + "</option>";
                            });
                            $("#nama").html(options);
                        }
                    });
                    // $("#nik").trigger("change");
                });

                $("#nik").change(function(){
                    var sect = $("#nik").val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('DataApiSection') }}",
                        data: {
                            _token: csrfToken,
                            nik: sect,
                        },
                        success: function(data){
                            var options = '';
                            data.forEach(function (m) {
                                options += "<option value='" + m.kode_section + "'>" + m.kode_section + "</option>";
                            });
                            $("#section").html(options);
                        }
                    });
                    // $("#nik").trigger("change");
                });
</script>
@endsection
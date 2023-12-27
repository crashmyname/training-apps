@extends('nav.navbar')
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>{{$title}}</h3>
              <h4>Employees
                <hr>
            </h4>
              <p class="text-subtitle text-muted">Page of {{$title}}.</p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class='breadcrumb-header'>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="{{route('schedule')}}">Schedule Training</a></li>
                      <li class="breadcrumb-item active" aria-current="page">View Participants</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <section class="section">
    <div class="card">
        <div class="card-header">
            {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#success"><i class="bi bi-plus-square"></i> Score A</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#success1"><i class="bi bi-plus-square"></i> Score B</button> <br><hr> --}}
            @if(session()->has('berhasil'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('berhasil')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
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
            <!--Success theme Modal -->
            <div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel110" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel110">Input {{$title}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 col-12">
                            <div class="card-header">
                                <h4 class="card-title">Form Input</h4>
                            </div>
                            <form class="form form-horizontal" method="post"
                                enctype="multipart/form-data" action="{{route('add-schedule')}}" id="formAddSchedule">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Name Training</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select type="text" name="name_training" id="name_training"
                                                class="choices from-select" required>
                                                <option value="">-- Pilih --</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Name Trainer</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name"
                                                class="form-control" name="name_trainer"
                                                placeholder="Enter name">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Section</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="choices form-select" name="section">
                                                <option value="">-- Pilih --</option>
                                                <option value="ALL">ALL</option>
                                                <option value=""></option>
                                                <option value="OTHERS">OTHERS</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Plan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="first-name"
                                                class="form-control" name="plan"
                                                >
                                        </div>                  
                                        <div class="col-md-4">
                                            <label>Number of Participants</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="first-name"
                                                class="form-control" name="participants"
                                                >
                                        </div>                  
                                        <div class="col-md-4">
                                            <label>Pic</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select type="text" name="pic" id="pic"
                                                class="choices from-select" required>
                                                <option value="">-- Pilih --</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Due Date Monitoring</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="first-name"
                                                class="form-control" name="duedate"
                                                >
                                        </div>                  
                                        <div class="col-md-4">
                                            <label>Status Monitoring</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select name="statusmonitor" class="form form-control">
                                                <option value="">-- Pilih --</option>
                                                <option value="Open">Open</option>
                                                <option value="Close">Close</option>
                                            </select>
                                        </div>                  
                                        <div class="col-md-4">
                                            <label>Description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea name="desc" class="form-control" cols="30" rows="10"></textarea>
                                        </div>                  
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="button"
                                                class="btn btn-primary me-1 mb-1"
                                                name="simpan"
                                                id="Btnsimpan">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            <!--Success theme Modal -->
            <div class="modal fade text-left" id="success1" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel110" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel110">Input {{$title}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 col-12">
                            <div class="card-header">
                                <h4 class="card-title">Form Input</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            Action : <button type="submit" title="Add Score A" class="btn icon btn-primary" id="showModalButton"><i class="bi bi-plus-circle"></i> Score A</button> 
            <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Input Score A</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Tempatkan Informasi Training yang dipilih di sini -->
                            <div id="selectedScheduleInfo"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>           
            <button type="submit" id="editModalButton" title="Add Score B" class="btn icon btn-success"><i class="bi bi-plus-circle-dotted"></i> Score B</button>  
            <div class="modal fade" id="scheduleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Training</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Tempatkan Informasi Training yang dipilih di sini -->
                            <div id="selectedScheduleEdit"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>    
            <button type="submit" id="UpdateScore" title="Update Score" class="btn icon btn-warning"><i class="bi bi-award-fill"></i> Update Score</button>
            <button type="submit" id="finalScore" title="Final Score" class="btn icon btn-info"><i class="bi bi-award-fill"></i> Final Score</button>
            <button type="submit" id="pdfscore" title="Pdf Score" class="btn icon btn-danger"><i class="bi bi-filetype-pdf"></i> Pdf Score</button>
        </div>        
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Name Training</th>
                        <th>Name Trainer</th>
                        <th>Date</th>
                        <th>Status Score A</th>
                        <th>Status Score B</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Name Training</th>
                        <th>Name Trainer</th>
                        <th>Date</th>
                        <th>Status Score A</th>
                        <th>Status Score B</th>
                </tfoot>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript">
  $(document).ready(function () {
      var dataTable = $('#table1').DataTable({
          processing: true,
          serverside: true,
          responsive: true,
          select: true,
          searching: true,
          ajax: '{{route('nilai-training')}}',
          columns:[
              {
                  data: 'train_id',
                  name: 'train_id',
                  render:function(data, type, row, meta){
                      return meta.row + meta.settings._iDisplayStart + 1;
                  },
              },
              {data: 'nik', name: 'nik', className: 'filter-select'},
              {data: 'name', name: 'name'},
              {data: 'section', name: 'section'},
              {data: 'name_training', name: 'name_training'},
              {data: 'name_trainer', name: 'name_trainer'},
              {data: 'actual', name: 'actual', width:'15%', render:function(data,type,row){
                var date = new Date(data);
                var day = date.getDate();
                var monthName = [
                    'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'
                ];
                var month = monthName[date.getMonth()];
                var year = date.getFullYear();
                var format = day + '-' + month + '-' + year;
                return format;
              }},
              {data: 'scorea', name: 'scorea'},
              {data: 'scoreb', name: 'scoreb'},
          ],
          initComplete: function () {
        this.api()
            .columns()
            .every(function () {
                let column = this;
 
                // Create select element
                let select = document.createElement('select');
                select.classList.add('form-select', 'appearance-none');
                select.add(new Option(''));
                column.footer().replaceChildren(select);
 
                // Apply listener for user change in value
                select.addEventListener('change', function () {
                    var val = DataTable.util.escapeRegex(select.value);
 
                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });
 
                // Add list of options
                column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                        select.add(new Option(d));
                    });
            });
    },
          lengthMenu: [10, 25, 50, 100],
          dom: 'Blfrtip',
          buttons:[
              {
                  extend: 'copy',
                  text:'COPY',
                  exportOptions:{
                      columns:':visible',
                  columnDefs:[{
                      targets: -1,
                      visible: false
                  }]
                  }
              },
              {
                  extend: 'pdf',
                  text:'PDF',
                  exportOptions:{
                      columns:':visible',
                  columnDefs:[{
                      targets: -1,
                      visible: false
                  }]
                  }
              },
              {
                  extend: 'print',
                  text:'CETAK',
                  exportOptions:{
                      columns:':visible',
                  columnDefs:[{
                      targets: -1,
                      visible: false
                  }]
                  }
              },
              {
                  extend: 'csv',
                  text:'CSV',
                  exportOptions:{
                      columns:':visible',
                  columnDefs:[{
                      targets: -1,
                      visible: false
                  }]
                  }
              },
              {
                  extend: 'excel',
                  text:'EXCEL',
                  exportOptions:{
                      columns:':visible',
                  columnDefs:[{
                      targets: -1,
                      visible: false
                  }]
                  }
              },
              {
                  extend: 'colvis',
                  text:'COLUMN VISIBLE',
                  exportOptions:{
                      columns:':visible',
                  columnDefs:[{
                      targets: -1,
                      visible: false
                  }]
                  }
              }
          ]
      });
      $('#showModalButton').on('click', function () {
        var selectedData = dataTable.rows({ selected: true }).data();
        var modalContent = $('#selectedScheduleInfo');

        modalContent.empty(); // Kosongkan konten modal sebelum menambahkan informasi baru

        if (selectedData.length > 0) {
            selectedData.each(function (data) {
                const createdAt = new Date(data.created_at); // Mengonversi string ke objek Date
                const formattedCreatedAt = createdAt.toLocaleString('en-US', {
                    timeZone: 'Asia/Jakarta',
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });
                var ScoreA = '{{route('input-scoreA')}}';
                var csrf = '@csrf';
                var info = '<form class="form form-control" id="formScoreA" enctype="multipart/form-data" method="post">' + csrf +
                    '<table>' + 
                        '<tr>' + '<td width="50%">' + 'NIK' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td>' + '<input type="text" name="nik" class="form-control" value="' + data.nik + '" readonly><input type="hidden" name="train_id" class="form-control" value="' + data.train_id + '">' + '</td>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Name' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="name" class="form-control" value="' + data.name + '"readonly>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Section' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="section" class="form-control" value="' + data.section + '"readonly><input type="hidden" name="schedule_id" class="form-control" value="' + data.schedule_id + '">' + '</td>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Pemahaman terhadap isi dan tujuan materi' + '<span style="color: red;">*</span>' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="number" name="pemahaman" class="form-control">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Peningkatan Skill / Kompetensi' + '<span style="color: red;">*</span>' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="number" name="skill" class="form-control">' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Peningkatan Kerja' + '<span style="color: red;">*</span>' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="number" name="kinerja" class="form-control">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Implementasi terhadap pekerjaan' + '<span style="color: red;">*</span>' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="number" name="implementasi" class="form-control">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Melakukan Perbaikan sistem / Improvement' + '<span style="color: red;">*</span>' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="number" name="improvement" class="form-control">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Mampu Mengajarkan kepada orang lain' + '<span style="color: red;">*</span>' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="number" name="mengajarkan" class="form-control">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Kesimpulan / Komentar Pimpinan Kerja' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<textarea name="kesimpulan" class="form-control"></textarea>' + '</tr>' + 
                        '<tr>' + '<td>' + '' + '</td>' + '<td>' + '' + '</td>' + '<td align="right">' + '<button type="submit" class="btn btn-success" name="submitNilai" id="BtnScoreA">Submit</button>' + '</td>' + '</tr>' + '</table></form>';
                console.log(data.schedule_id);
                modalContent.html(info);
                // $('#formScoreA input[name="pemahaman"]').prop('required',true);
                $('#BtnScoreA').on('click', function(e){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: ScoreA,
                        data: $('#formScoreA').serialize(),
                        dataType: 'json',
                        success: function (response) {
                            // Tanggapan dari server setelah berhasil diupdate
                            console.log(response);
                            // Tambahkan logika atau tindakan lain setelah pembaruan
                            if(response.status === 'success'){
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Input Score Successfully',
                                    });
                                    reloadData();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to input Score',
                                    });
                                }
                        },
                        error: function (error) {
                            console.error(error);
                            // Tambahkan logika atau tindakan lain jika terjadi kesalahan
                        }
                    });
                });
                function reloadData(){
                    dataTable.ajax.reload();
                }
            });
        } else {
            // Jika tidak ada data yang dipilih, tampilkan pesan kosong
            modalContent.html('No data selected.');
        }

        $('#scheduleModal').modal('show'); // Tampilkan modal
        });
      $('#editModalButton').on('click', function () {
        var selectedData = dataTable.rows({ selected: true }).data();
        var modalContent = $('#selectedScheduleEdit');

        modalContent.empty(); // Kosongkan konten modal sebelum menambahkan informasi baru

        if (selectedData.length > 0) {
            selectedData.each(function (data) {
                const createdAt = new Date(data.created_at); // Mengonversi string ke objek Date
                const formattedCreatedAt = createdAt.toLocaleString('en-US', {
                    timeZone: 'Asia/Jakarta',
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });
                var ScoreA = '{{route('input-scoreB')}}';
                var csrf = '@csrf';
                var info = '<form class="form form-control" id="formScoreB" enctype="multipart/form-data" method="post">' + csrf +
                    '<table>' + 
                        '<tr>' + '<td width="50%">' + 'NIK' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td>' + '<input type="text" name="nik" class="form-control" value="' + data.nik + '" readonly><input type="hidden" name="train_id" class="form-control" value="' + data.train_id + '">' + '</td>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Name' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="name" class="form-control" value="' + data.name + '"readonly>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Section' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="section" class="form-control" value="' + data.section + '"readonly><input type="hidden" name="schedule_id" class="form-control" value="' + data.schedule_id + '">' + '</td>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Hasil test' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="number" name="tes" class="form-control">' + '</tr>' + 
                        '<tr>' + '<td>' + '' + '</td>' + '<td>' + '' + '</td>' + '<td align="right">' + '<button type="submit" class="btn btn-success" name="submitNilai" id="BtnScoreB">Submit</button>' + '</td>' + '</tr>' + '</table></form>';
                console.log(data.schedule_id);
                modalContent.html(info);
                $('#BtnScoreB').on('click', function(e){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: ScoreA,
                        data: $('#formScoreB').serialize(),
                        dataType: 'json',
                        success: function (response) {
                            // Tanggapan dari server setelah berhasil diupdate
                            console.log(response);
                            // Tambahkan logika atau tindakan lain setelah pembaruan
                            if(response.status === 'success'){
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Input Score Successfully',
                                    });
                                    reloadData();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to input Score',
                                    });
                                }
                        },
                        error: function (error) {
                            console.error(error);
                            // Tambahkan logika atau tindakan lain jika terjadi kesalahan
                        }
                    });
                });
                function reloadData(){
                    dataTable.ajax.reload();
                }
            });
        } else {
            // Jika tidak ada data yang dipilih, tampilkan pesan kosong
            modalContent.html('No data selected.');
        }

        $('#scheduleModal1').modal('show'); // Tampilkan modal
        });
        $('#UpdateScore').on('click', function(){
            var selectData = dataTable.rows({ selected: true}).data();
            if (selectData.length > 0) {
                    selectData.each(function (data) {
                        const iD = data.train_id;
                        console.log(iD);
                        var url = "{{url('/formupdatescore')}}"+"/"+iD;
                        window.open(url, '_blank');
                        // window.location.href="{{url('/viewparticipants')}}"+"/"+idSchedule;
                        var link = $('<a>', {
                            href: url,
                            text: 'Go to Add Participants',
                            class: 'btn btn-primary',
                            target: '_blank',
                        });

                        // Tambahkan tombol ke dokumen
                        $('#buttonContainer').append(link);
                    });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'No data selected.',
                });
            };
        });
        $('#finalScore').on('click', function(){
            var selectData = dataTable.rows({ selected: true}).data();
            if (selectData.length > 0) {
                    selectData.each(function (data) {
                        const iD = data.train_id;
                        var url = "{{url('/finalscore')}}"+"/"+iD;
                        window.open(url, '_blank');
                        // window.location.href="{{url('/viewparticipants')}}"+"/"+idSchedule;
                        var link = $('<a>', {
                            href: url,
                            text: 'Go to Add Participants',
                            class: 'btn btn-primary',
                            target: '_blank',
                        });

                        // Tambahkan tombol ke dokumen
                        $('#buttonContainer').append(link);
                    });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'No data selected.',
                });
            };
        });
        $('#pdfscore').on('click', function(){
            var selectData = dataTable.rows({ selected: true}).data();
            if (selectData.length > 0) {
                    selectData.each(function (data) {
                        const iD = data.train_id;
                        var url = "{{url('/pdfscore')}}"+"/"+iD;
                        window.open(url, '_blank');
                        // window.location.href="{{url('/viewparticipants')}}"+"/"+idSchedule;
                        var link = $('<a>', {
                            href: url,
                            text: 'Go to Add Participants',
                            class: 'btn btn-primary',
                            target: '_blank',
                        });

                        // Tambahkan tombol ke dokumen
                        $('#buttonContainer').append(link);
                    });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'No data selected.',
                });
            };
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
                    $("#nik").trigger("change");
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
                    $("#nik").trigger("change");
                });
</script>
@endsection
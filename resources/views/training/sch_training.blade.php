@extends('nav.navbar')
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>{{$title}}</h3>
              <p class="text-subtitle text-muted">Page of {{$title}}.</p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class='breadcrumb-header'>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Schedule Training</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <section class="section">
    <div class="card">
        <div class="card-header">
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
            @if (!auth()->check() || auth()->user()->role == 'Administrator' || auth()->user()->role == 'Group Leader')
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#success"><i class="bi bi-plus-square"></i> Add Data</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#success1"><i class="bi bi-plus-square"></i> Add Data Manual</button> <br><hr>
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
                                                @foreach ($training as $data)
                                                <option value="{{$data->name_training}}">{{$data->name_training}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Name Trainer</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select type="text" name="name_trainer" id="pic"
                                                class="choices from-select" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach ($pic as $picname)
                                                <option value="{{$picname['nama']}}">{{$picname['nama']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Section</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="choices form-select" name="section">
                                                <option value="">-- Pilih --</option>
                                                <option value="ALL">ALL</option>
                                                @foreach ($resultDept as $dept)
                                                <option value="{{$dept['kode_section']}}">{{$dept['kode_section']}}</option>
                                                @endforeach
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
                                                @foreach ($pic as $picname)
                                                <option value="{{$picname['nama']}}">{{$picname['nama']}}</option>
                                                @endforeach
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
                                                @foreach ($training as $data)
                                                <option value="{{$data->name_training}}">{{$data->name_training}}</option>
                                                @endforeach
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
                                                @foreach ($resultDept as $dept)
                                                <option value="{{$dept['kode_section']}}">{{$dept['kode_section']}}</option>
                                                @endforeach
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
                                                @foreach ($pic as $picname)
                                                <option value="{{$picname['nama']}}">{{$picname['nama']}}</option>
                                                @endforeach
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
            Action : <button type="submit" title="info" class="btn icon btn-primary" id="showModalButton"><i class="bi bi-info-circle"></i></button> |
            <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Information Training</h5>
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
            <button type="submit" id="editModalButton" title="edit user" class="btn icon btn-warning"><i class="bi bi-pencil-square"></i></button> | 
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
            <button type="submit" id="delete" title="delete user" class="btn icon btn-danger"><i class="bi bi-trash"></i></button> |
            <a id="addParticipants" type="button" title="Add Participants" target="_blank" class="btn btn-info"><i class="bi bi-person-add"></i></a>
            <a id="viewParticipants" type="button" title="View Participants" target="_blank" class="btn btn-secondary"><i class="bi bi-people-fill"></i></a>
            @else
            @endif
        </div>        
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name Training</th>
                        <th>Name Trainer</th>
                        <th>Section</th>
                        <th>Plan</th>
                        <th>Re Plan 1</th>
                        <th>Re Plan 2</th>
                        <th>Re Plan 3</th>
                        <th>Actual Date</th>
                        <th>Number of Participants</th>
                        <th>Pic</th>
                        <th>Due Date</th>
                        <th>Status Monitoring</th>
                        <th>Desc</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript">
  $(document).ready(function () {
      dataTable = $('#table1').DataTable({
          processing: true,
          serverside: true,
          responsive: true,
          select: true,
          ajax: '{{route('schedule')}}',
          columns:[
              {
                  data: 'schedule_id',
                  name: 'schedule_id',
                  render:function(data, type, row, meta){
                      return meta.row + meta.settings._iDisplayStart + 1;
                  },
              },
              {data: 'name_training', name: 'name_training'},
              {data: 'name_trainer', name: 'name_trainer'},
              {data: 'section', name: 'section'},
              {data: 'plan', name: 'plan'},
              {data: 'replan1', name: 'replan1'},
              {data: 'replan2', name: 'replan2'},
              {data: 'replan3', name: 'replan3'},
              {data: 'actual', name: 'actual'},
              {data: 'participants', name: 'participants'},
              {data: 'pic', name: 'pic'},
              {data: 'duedate', name: 'duedate'},
              {data: 'statusmonitor', name: 'statusmonitor'},
              {data: 'desc', name: 'desc'},
          ],
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
            var info = '<table>';
            selectedData.each(function (data) {
                const createdAt = new Date(data.created_at); // Mengonversi string ke objek Date
                const updatedAt = new Date(data.updated_at); // Mengonversi string ke objek Date
                const formattedCreatedAt = createdAt.toLocaleString('en-US', {
                timeZone: 'Asia/Jakarta',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                });
                const formattedUpdatedAt = updatedAt.toLocaleString('en-US', {
                timeZone: 'Asia/Jakarta',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                });
                info += '<tr>' + '<td width="15%">' + 'Name Training' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td class="form-control">' + data.name_training + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Name Trainer' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.name_trainer + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Section' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.section + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Plan' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.plan + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Re-Plan 1' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.replan1 + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Re-Plan 2' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.replan2 + '</td>' + '</tr>'+ '<tr>' + '<td>' + 'Re-Plan 3' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.replan3 + '</td>' + '</tr>'+ '<tr>' + '<td>' + 'Actual Date' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.actual + '</td>' + '</tr>'+ '<tr>' + '<td>' + 'Number of Participants' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.participants + '</td>' + '</tr>' + '<tr>' + '<td>' + 'PIC' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.pic + '</td>' + '</tr>'+ '<tr>' + '<td>' + 'Due Date' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.duedate + '</td>' + '</tr>'+ '<tr>' + '<td>' + 'Status Monitoring' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.statusmonitor + '</td>' + '</tr>'+ '<tr>' + '<td>' + 'Desc' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.desc + '</td>' + '</tr>'+ '<tr>' + '<td>' + 'Created at' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + formattedCreatedAt + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Updated at' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + formattedUpdatedAt + '</td>' + '</tr>';
            });
            info += '</table>';
            modalContent.html(info);
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
                var isDisable = data.statusmonitor === "Close";
                $('#editModalButton').prop('disabled', isDisable);
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
                var editData = "{{ url('/scheduletraining') }}";
                var csrf = '@csrf';
                var iD = data.schedule_id;
                var info = '<form class="form form-control" id="formEditSchedule" action="' + editData + '/' + iD +'" enctype="multipart/form-data" method="post">' + csrf +
                    '<table>' + 
                        '<tr>' + '<td width="15%">' + 'Name Training' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td>' + '<input type="text" name="name_training" class="form-control" value="' + data.name_training + '">' + '</td>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Name Trainer' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="name_trainer" class="form-control" value="' + data.name_trainer + '">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Section' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="section" class="form-control" value="' + data.section + '">' + '</td>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Plan' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="date" name="plan" class="form-control" value="' + data.plan + '">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Re-plan 1' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="date" name="replan1" class="form-control" value="' + data.replan1 + '">' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Re-plan 2' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="date" name="replan2" class="form-control" value="' + data.replan2 + '">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Re-plan 3' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="date" name="replan3" class="form-control" value="' + data.replan3 + '">' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Actual' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="date" name="actual" class="form-control" value="' + data.actual + '">' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Number of participants' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="participants" class="form-control" value="' + data.participants + '">' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Pic' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="pic" class="form-control" value="' + data.pic + '">' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Due Date' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="date" name="duedate" class="form-control" value="' + data.duedate + '">' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Status Monitoring' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<select name="statusmonitor" class="form form-control"><option value="'+data.statusmonitor+'" selected></option><option value="Open">Open</option><option value="Close">Close</option></select>' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Desc' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="desc" class="form-control" value="' + data.desc + '">' + '</tr>'+ 
                        '<tr>' + '<td>' + '' + '</td>' + '<td>' + '' + '</td>' + '<td align="right">' + '<button type="submit" class="btn btn-warning" name="update" id="BtnUpdate">Update</button>' + '</td>' + '</tr>' + '</table></form>';
                console.log(data.schedule_id);
                modalContent.html(info);
            });
        } else {
            // Jika tidak ada data yang dipilih, tampilkan pesan kosong
            modalContent.html('No data selected.');
        }

        $('#scheduleModal1').modal('show'); // Tampilkan modal
        });
        $('#addParticipants').on('click', function(){
            var selectData = dataTable.rows({ selected: true}).data();
            if (selectData.length > 0) {
                    selectData.each(function (data) {
                        const idSchedule = data.schedule_id;
                        const Namatraining = data.name_training;
                        const dAtE = data.plan;
                        var url = "{{url('/participants')}}"+"/"+idSchedule;
                        var cardTitle = "FORM INPUT PEMAKAIAN " + Namatraining + " - DATE: " + dAtE;
                        var Tanggal = "DATE :" + data.plan;
                        $('#judultraining').text(cardTitle);
                        // window.location.href="{{url('/participants')}}"+"/"+idSchedule;
                        window.open(url, '_blank');
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
        $('#viewParticipants').on('click', function(){
            var selectData = dataTable.rows({ selected: true}).data();
            if (selectData.length > 0) {
                    selectData.each(function (data) {
                        const idSchedule = data.schedule_id;
                        var url = "{{url('/viewparticipants')}}"+"/"+idSchedule;
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
        $('#delete').on('click', function(){
            var selectData = dataTable.rows({ selected: true}).data();
            if (selectData.length > 0) {
                Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete selected data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    selectData.each(function (data) {
                        const idSchedule = data.schedule_id;
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('/scheduletraining') }}" + '/' + idSchedule,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.message === 'Data deleted successfully') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Data deleted successfully',
                                    });
                                    reloadData();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to delete data',
                                    });
                                }
                            }
                        });
                        function reloadData() {
                            dataTable.ajax.reload();
                        }
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'No data selected.',
            });
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
        document.getElementById('Btnsimpan').addEventListener('click', function(){
        Swal.fire({
            title: 'Are you sure?',
            text: 'Is the data you entered correct?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        }).then((result)=>{
            if(result.isConfirmed){
                document.getElementById('formAddSchedule').submit();
            }
        });
    });
        document.getElementById('BtnUpdate').addEventListener('click', function(){
        Swal.fire({
            title: 'Are you sure?',
            text: 'Is the data you entered correct?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        }).then((result)=>{
            if(result.isConfirmed){
                document.getElementById('formEditSchedule').submit();
            }
        });
    });
</script>
@endsection
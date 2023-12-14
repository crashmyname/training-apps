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
                      <li class="breadcrumb-item active" aria-current="page">Training</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <section class="section">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#success"><i class="bi bi-plus-square"></i> Add Data</button> <br><hr>
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
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
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
                                enctype="multipart/form-data" action="{{route('add_user')}}">
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
                                                <option value="{{$data->kode_training}}">{{$data->name_training}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>NIK</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input list="datalist" class="form-control" name="nik" id="nik" required>
                                            <datalist id="datalist">
                                                <option value=""> - </option>
                                                @foreach ($result as $data)
                                                <option value="{{$data['nik']}}">{{$data['nik']}} {{$data['nama']}}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-control" name="name" id="nama"> </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Section</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-control" name="section" id="section"></select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Date</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="first-name"
                                                class="form-control" name="date"
                                                >
                                        </div>                  
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit"
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
            <div class="modal fade" id="karyawanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div id="selectedKaryawanInfo"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>           
            <button type="submit" id="editModalButton" title="edit user" class="btn icon btn-warning"><i class="bi bi-pencil-square"></i></button> | 
            <div class="modal fade" id="karyawanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div id="selectedKaryawanInfo"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>  
            <button type="submit" id="delete" title="delete user" class="btn icon btn-danger"><i class="bi bi-trash"></i></button>
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
                        <th>Training Materials</th>
                        <th>Quest & Feedback</th>
                        <th>Evaluation</th>
                        <th>History Golongan</th>
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
      var dataTable = $('#table1').DataTable({
          processing: true,
          serverside: true,
          responsive: true,
          select: true,
          autoWidth: true,
          ajax: '{{route('data-training')}}',
          columns:[
              {
                  data: 'train_id',
                  name: 'train_id',
                  render:function(data, type, row, meta){
                      return meta.row + meta.settings._iDisplayStart + 1;
                  },
              },
              {data: 'nik', name: 'nik'},
              {data: 'name', name: 'name'},
              {data: 'section', name: 'section'},
              {data: 'name_training', name: 'name_training'},
              {data: 'name_trainer', name: 'name_trainer'},
              {data: 'actual', name: 'actual', width:'25%',render: function(data, type, row){
                // return moment(data).format('ll');
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
              {data: 'matepl', name: 'matepl'},
              {data: 'questfeedback', name: 'questfeedback'},
              {data: 'evaluation', name: 'evaluation'},
              {data: 'history_gol', name: 'history_gol'},
            //   {data: 'scorea', name: 'scorea'},
            //   {data: 'scoreb', name: 'scoreb'},
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
      function reloadData(){
        dataTable.ajax.reload(null, false);
      }
      setInterval(reloadData,300000);
      $('#showModalButton').on('click', function () {
        var selectedData = dataTable.rows({ selected: true }).data();
        var modalContent = $('#selectedKaryawanInfo');

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
                info += '<tr>' + '<td width="15%">' + 'NIK' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td class="form-control">' + data.nik + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Name' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.name + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Email' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.email + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Section' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.section + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Picture' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.foto + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Created at' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + formattedCreatedAt + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Updated at' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + formattedUpdatedAt + '</td>' + '</tr>';
            });
            info += '</table>';
            modalContent.html(info);
        } else {
            // Jika tidak ada data yang dipilih, tampilkan pesan kosong
            modalContent.html('No data selected.');
        }

        $('#karyawanModal').modal('show'); // Tampilkan modal
        });
      $('#editModalButton').on('click', function () {
        var selectedData = dataTable.rows({ selected: true }).data();
        var modalContent = $('#selectedKaryawanInfo');

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
                var editData = "{{ url('/user') }}";
                var foto = "{{asset('storage/profil-user/')}}";
                var csrf = '@csrf';
                var iD = data.datatrain.train_id;
                var info = '<form class="form form-control" action="' + editData + '/' + iD +'" enctype="multipart/form-data" method="post">' + csrf +'<table>' + '<tr>' + '<td width="15%">' + 'NIK' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td>' + '<input type="text" name="nik" class="form-control" value="' + data.nik + '" readonly>' + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Name' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="name" class="form-control" value="' + data.name + '" readonly>' + '<tr>' + '<td>' + 'Email' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="email" name="email" class="form-control" value="' + data.email + '">' + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Section' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="section" class="form-control" value="' + data.section + '">' + '</tr>' + '<tr>' + '<td>' + 'Password' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="password" name="password" class="form-control" value="" >' + '</tr>' + '<tr>' + '<td>' + '' + '</td>' + '<td>' + '' + '</td>' + '<td align="right">' + '<button type="submit" class="btn btn-warning" name="update" id="BtnUpdate">Update</button>' + '</td>' + '</tr>' + '</table></form>';
                console.log(data.uid);
                modalContent.html(info);
            });
        } else {
            // Jika tidak ada data yang dipilih, tampilkan pesan kosong
            modalContent.html('No data selected.');
        }

        $('#karyawanModal').modal('show'); // Tampilkan modal
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
                        const idUser = data.uid;
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('/user') }}" + '/' + idUser,
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
        });
        document.getElementById('Btnsimpan').addEventListener('click', function(){
        Swal.fire({
            title: 'Are you sure?',
            text: 'Is the data you entered correct?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result)=>{
            if(result.isConfirmed){
                document.querySelector('form').submit();
            }
        });
    });
    //     document.getElementById('BtnUpdate').addEventListener('click', function(){
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: 'Is the data you entered correct?',
    //         icon: 'question',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes'
    //     }).then((result)=>{
    //         if(result.isConfirmed){
    //             document.querySelector('form').submit();
    //         }
    //     });
    // });
</script>
@endsection
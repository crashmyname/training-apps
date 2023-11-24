@extends('nav/navbar')
@section('content')
<div class="main-content container-fluid">
  <div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Title of Training</h3>
            <p class="text-subtitle text-muted">Page of Training.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                    <li class="breadcrumb-item active" aria-current="page">Training Name</li>
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
                    <h5 class="modal-title white" id="myModalLabel110">Input Training</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Form Input</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" method="post"
                                            enctype="multipart/form-data" action="{{route('add_training')}}" id="simpanTraining">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Code Training</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="first-name"
                                                            class="form-control" name="kode_training"
                                                            value="{{$newCode}}" style="text-transform:uppercase;" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Training Name</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="text" id="first-name"
                                                            class="form-control" name="name_training"
                                                            placeholder="Enter the name of the training" style="text-transform:uppercase;">
                                                    </div>
                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                        <button type="button"
                                                            class="btn btn-primary me-1 mb-1"
                                                            name="simpan" id="Btnsimpan"
                                                            >Submit</button>
                                                        <button type="reset"
                                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
{{-- 
                    <button type="button" class="btn btn-success ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button> --}}
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
            <button type="submit" id="editModalButton" title="edit data" class="btn icon btn-warning"><i class="bi bi-pencil-square"></i></button> | 
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
            <button type="submit" id="delete" title="delete data" class="btn icon btn-danger"><i class="bi bi-trash"></i></button>
        </div>        
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Code Training</th>
                        <th>Training Name</th>
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
          ajax: '{{route('training')}}',
          columns:[
              {
                  data: 'id_training',
                  name: 'id_training',
                  render:function(data, type, row, meta){
                      return meta.row + meta.settings._iDisplayStart + 1;
                  },
              },
              {data: 'kode_training', name: 'kode_training'},
              {data: 'name_training', name: 'name_training'},
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
                info += '<tr>' + '<td width="15%">' + 'Code' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td class="form-control">' + data.kode_training + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Name' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.name_training + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Created By' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.created_by + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Updated By' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.updated_by + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Created at' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + formattedCreatedAt + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Updated at' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + formattedUpdatedAt + '</td>' + '</tr>';
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
                var editData = "{{ url('/training') }}";
                var csrf = '@csrf';
                var iD = data.id_training;
                var info = '<form action="' + editData + '/' + iD +'" method="post">' + csrf +'<table>' + '<tr>' + '<td width="15%">' + 'Code' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td>' + '<input type="text" name="kode_training" class="form-control" value="' + data.kode_training + '" readonly>' + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Name' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="name_training" class="form-control" value="' + data.name_training + '">' + '</td>' + '</tr>' + '<tr>' + '<td>' + '' + '</td>' + '<td>' + '' + '</td>' + '<td align="right">' + '<button type="submit" class="btn btn-warning" name="update">Update</button>' + '</td>' + '</tr>' + '</table></form>';
                    console.log(data.id_training);
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
                        const idTraining = data.id_training;
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('/training') }}" + '/' + idTraining,
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
            document.getElementById('simpanTraining').submit();
        }
    });
  });
</script>
@endsection
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
            data-bs-target="#success"><i class="bi bi-plus-square"></i> Add Data</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#success1"><i class="bi bi-plus-square"></i> Add Data Manual</button> <br><hr> --}}
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
            <button type="submit" id="delete" title="delete user" class="btn icon btn-danger"><i class="bi bi-trash"></i></button>
        </div>        
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Divisi</th>
                        <th>Dept</th>
                        <th>Section</th>
                        <th>Position</th>
                        <th>Status Employee</th>
                        <th>Level</th>
                        <th>Group</th>
                        <th>Team</th>
                        <th>Birth Place</th>
                        <th>Birth Date</th>
                        <th>Name Mother</th>
                        <th>Hire Date</th>
                        <th>Ktp Address</th>
                        <th>Domicili</th>
                        <th>Telp</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>Private Email</th>
                        <th>Work Email</th>
                        <th>Work Email Pass</th>
                        <th>Religion</th>
                        <th>Last Education</th>
                        <th>Major</th>
                        <th>Blood Type</th>
                        <th>Gender</th>
                        <th>Marriage Status</th>
                        <th>Number of Child</th>
                        <th>Tax Status</th>
                        <th>NPWP</th>
                        <th>KTP</th>
                        <th>KK</th>
                        <th>BPJSTK</th>
                        <th>BPJSKS</th>
                        <th>Couple Work Stanley</th>
                        <th>Transport</th>
                        <th>Bank</th>
                        <th>Rekening Number</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Divisi</th>
                        <th>Dept</th>
                        <th>Section</th>
                        <th>Position</th>
                        <th>Status Employee</th>
                        <th>Level</th>
                        <th>Group</th>
                        <th>Team</th>
                        <th>Birth Place</th>
                        <th>Birth Date</th>
                        <th>Name Mother</th>
                        <th>Hire Date</th>
                        <th>Ktp Address</th>
                        <th>Domicili</th>
                        <th>Telp</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>Private Email</th>
                        <th>Work Email</th>
                        <th>Work Email Pass</th>
                        <th>Religion</th>
                        <th>Last Education</th>
                        <th>Major</th>
                        <th>Blood Type</th>
                        <th>Gender</th>
                        <th>Marriage Status</th>
                        <th>Number of Child</th>
                        <th>Tax Status</th>
                        <th>NPWP</th>
                        <th>KTP</th>
                        <th>KK</th>
                        <th>BPJSTK</th>
                        <th>BPJSKS</th>
                        <th>Couple Work Stanley</th>
                        <th>Transport</th>
                        <th>Bank</th>
                        <th>Rekening Number</th>
                    </tr>
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
                  data: 'noid',
                  name: 'noid',
                  render:function(data, type, row, meta){
                      return meta.row + meta.settings._iDisplayStart + 1;
                  },
              },
              {data: 'nik', name: 'nik', className: 'filter-select'},
              {data: 'nama', name: 'nama'},
              {data: 'divisi', name: 'divisi'},
              {data: 'dept', name: 'dept'},
              {data: 'kode_section', name: 'kode_section'},
              {data: 'posisi', name: 'posisi'},
              {data: 'status_emp', name: 'status_emp'},
              {data: 'level', name: 'level'},
              {data: 'grup', name: 'grup'},
              {data: 'teamm', name: 'teamm'},
              {data: 'birth_place', name: 'birth_place'},
              {data: 'birth_date', name: 'birth_date'},
              {data: 'ibukandung', name: 'ibukandung'},
              {data: 'hire_date', name: 'hire_date'},
              {data: 'ktp_address', name: 'ktp_address'},
              {data: 'domisili', name: 'domisili'},
              {data: 'telp', name: 'telp'},
              {data: 'phone1', name: 'phone1'},
              {data: 'phone2', name: 'phone2'},
              {data: 'priv_email', name: 'priv_email'},
              {data: 'work_email', name: 'work_email'},
              {data: 'work_email_pass', name: 'work_email_pass'},
              {data: 'religion', name: 'religion'},
              {data: 'last_education', name: 'last_education'},
              {data: 'jurusan', name: 'jurusan'},
              {data: 'blood_type', name: 'blood_type'},
              {data: 'jenis_kelamin', name: 'jenis_kelamin'},
              {data: 'marriage_status', name: 'marriage_status'},
              {data: 'num_of_child', name: 'num_of_child'},
              {data: 'tax_status', name: 'tax_status'},
              {data: 'npwp', name: 'npwp'},
              {data: 'ktp', name: 'ktp'},
              {data: 'nokk', name: 'nokk'},
              {data: 'bpjs_tk_number', name: 'bpjs_tk_number'},
              {data: 'bpjs_ks_number', name: 'bpjs_ks_number'},
              {data: 'couple_work_stanley', name: 'couple_work_stanley'},
              {data: 'jemputan', name: 'jemputan'},
              {data: 'bank', name: 'bank'},
              {data: 'rekening_no', name: 'rekening_no'},
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
                info += '<tr>' + '<td width="15%">' + 'NIK' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td class="form-control">' + data.nik + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Name' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.name + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Section' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.section + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Materials' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.matepl + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Question & Feedback' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.questfeedback + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Evaluation' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.evaluation + '</td>' + '</tr>'+ '<tr>' + '<td>' + 'History Golongan' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + data.history_gol + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Created at' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + formattedCreatedAt + '</td>' + '</tr>' + '<tr>' + '<td>' + 'Updated at' + '</td>' + '<td>' + ':' + '</td>' + '<td class="form-control">' + formattedUpdatedAt + '</td>' + '</tr>';
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
                var editData = "{{ url('/viewparticipants') }}";
                // var foto = "{{asset('storage/profil-user/')}}";
                var csrf = '@csrf';
                var iD = data.train_id;
                var info = '<form class="form form-control" id="formEditSchedule" action="' + editData + '/' + iD +'" enctype="multipart/form-data" method="post">' + csrf +
                    '<table>' + 
                        '<tr>' + '<td width="15%">' + 'NIK' + '</td>' + '<td width="10%">' + ':' + '</td>' + '<td>' + '<input type="text" name="nik" class="form-control" value="' + data.nik + '">' + '</td>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Name' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="name" class="form-control" value="' + data.name + '">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Section' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="section" class="form-control" value="' + data.section + '">' + '</td>' + '</tr>' + 
                        '<tr>' + '<td>' + 'Materials' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="matepl" class="form-control" value="' + data.matepl + '">' + '</tr>' + 
                        '<tr>' + '<td>' + 'Question & Feedback' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="questfeedback" class="form-control" value="' + data.questfeedback + '">' + '</tr>'+ 
                        '<tr>' + '<td>' + 'Evaluation' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="evaluation" class="form-control" value="' + data.evaluation + '">' + '</tr>' + 
                        '<tr>' + '<td>' + 'History Golongan' + '</td>' + '<td>' + ':' + '</td>' + '<td>' + '<input type="text" name="history_gol" class="form-control" value="' + data.history_gol + '">' + '</tr>'+ 
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
                        const idParticipants = data.train_id;
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('/viewparticipants') }}" + '/' + idParticipants,
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
</script>
@endsection
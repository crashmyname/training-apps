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
                      <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                      <li class="breadcrumb-item active" aria-current="page">Employee</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <section class="section">
    <div class="card">
        <div class="card-header">
            <button type="submit" id="photo" title="view photo" class="btn btn-info" data-photo-url=""><i class="bi bi-images"></i> Photo</button>
            <div class="modal fade" id="modalPhoto" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Info Photo</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="selectedPhoto">
                                <table class="table table-bordered" align="center">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selectedPhoto">
                                        <!-- Data akan ditampilkan di sini -->
                                    </tbody>
                                </table>
                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
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
                        {{-- <th>Photo</th> --}}
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
                        {{-- <th>Photo</th> --}}
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
          ajax: '{{route('employee')}}',
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
            //   {data: 'nik',
            //    name: 'photo',
            //     render: function(data, type, row){
            //         return `<img src="http://10.203.68.47:90/fambook/files/photos/${data}.jpg" width="50" height="50"/>`
            //     }}
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
    $('#photo').on('click', function () {
        var selectedData = dataTable.rows({ selected: true }).data();
        var modalContent = $('#selectedPhoto');

        modalContent.empty(); // Kosongkan konten modal sebelum menambahkan informasi baru
        if (selectedData.length > 0) {
            modalContent.append('<tr><th>Nama</th><th>Photo</th></tr>');
            selectedData.each(function(data){
                var path = 'http://10.203.68.47:90/fambook/files/photos/'+data.photo;
                var row = $('<tr>');
                    row.append($('<td>').text(data.nama));
                    row.append($('<td>').append($('<img>').attr('src',path).attr('width','50%')));
                // var img = $('<img>').attr('src',path).attr('width','50%');
                modalContent.append(row);
            })
        } else {
            // Jika tidak ada data yang dipilih, tampilkan pesan kosong
            modalContent.html('No data selected.');
        }

        $('#modalPhoto').modal('show'); // Tampilkan modal
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
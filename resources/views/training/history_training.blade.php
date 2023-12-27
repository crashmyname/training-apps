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
                      <li class="breadcrumb-item active" aria-current="page">History Training</li>
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
            <!--Success theme Modal -->  
            <button type="submit" id="viewHistory" title="View History" class="btn icon btn-primary">Cek Histroy <i class="bi bi-clock-history"></i> </button>
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
          ajax: '{{route('history-training')}}',
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
      $('#viewHistory').on('click', function(){
        var selectedData = dataTable.rows({selected:true}).data();
        if(selectedData.length > 0){
            selectedData.each(function(data){
                const Id = data.nik;
                console.log(Id);
                var url = "{{url('/history')}}"+"/"+Id;
                window.open(url, '_blank');
                var link = $('<a>',{
                    href: url,
                    text: 'Go to View History',
                    class: 'btn btn-primary',
                    target: '_blank',
                });
                $('#buttonContainer').append(link);
            });
        } else {
            Swal.fire({
                icon: 'info',
                text: 'No Data Selected',
                title: 'Info',
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
</script>
@endsection
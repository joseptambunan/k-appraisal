<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/asset/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/asset/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body class="hold-transition sidebar-mini">
<input type="hidden" id="token" value="{{csrf_token()}}" />
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
   
    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Id</label>
                  <input type="text" class="form-control" id="id" name="id">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Owner (Isian Wajib)</label>
                  <input type="email" class="form-control" id="owner" name="owner" maxlength="100" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Asset Name (Isian Wajib)</label>
                  <input type="text" class="form-control" id="asset_name" name="asset_name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Value (Isian Wajib)</label>
                  <input type="text" class="form-control" id="value_data" name="value_data" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Added At (Isian Wajib)</label>
                  <input type="text" class="form-control" id="added_at" name="added_at" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Check At</label>
                  <input type="text" class="form-control" id="last_check_at" name="last_check_at" required>
                </div>
                <div class="card-footer">
                  <button type="button" class="btn btn-primary" onClick="submitData();">Submit</button>
                </div>
                <hr>
                <form action="{{url('/')}}/search" method="get">
                <div class="form-group">
                  <label for="exampleInputEmail1">Owner (Isian Wajib)</label>
                  <input type="email" class="form-control" id="ownerSearch" name="ownerSearch">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Asset Name (Isian Wajib)</label>
                  <input type="text" class="form-control" id="assetSearch" name="assetSearch">
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Cari</button>
                  <a href="{{url('/')}}" class="btn btn-reset">Reset</a>
                </div>
                </form>

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Owner</th>
                    <th>Asset Name(s)</th>
                    <th>Value</th>
                    <th>Days</th>
                    <th>Added At</th>
                    <th>Last Check At</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ( $data as $key => $value )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->owner }}</td>
                    <td>{{ $value->asset_name }}</td>
                    <td>{{ number_format($value->value) }}</td>
                    <td>{{ $value->days }}</td>
                    <td>{{ date("d-M-Y", strtotime($value->added_at)) }}</td>
                    <td>{{ date("d-M-Y", strtotime($value->last_check_at)) }}</td>
                    <td><button type="button" class="btn btn-danger" onClick="deleteData('{{$value->id}}')">Delete</button></td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!--script src="{{url('/')}}/asset/plugins/jquery/jquery.min.js"></script-->

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{url('/')}}/asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('/')}}/asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{url('/')}}/asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('/')}}/asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('/')}}/asset/plugins/jszip/jszip.min.js"></script>
<script src="{{url('/')}}/asset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('/')}}/asset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url('/')}}/asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('/')}}/asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('/')}}/asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/asset/dist/js/adminlte.min.js"></script>
<script src="{{url('/')}}/asset/plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $("#added_at").datepicker({
      dateFormat : "yy-mm-dd"
    });
    $("#last_check_at").datepicker({
      dateFormat : "yy-mm-dd"
    });

  });

  function submitData(){
    var request = $.ajax({
        url : "{{url('/')}}/api/asset",
        dataType : "json",
        type : "post",
        data : {
          owner : $("#owner").val(),
          asset_name : $("#asset_name").val(),
          value : $("#value_data").val(),
          added_at : $("#added_at").val(),
          last_check_at : $("#last_check_at").val(),
          id : $("#id").val()
        },
        headers : {
          "Headers" : $("#token").val()
        },
        error: function(data) {
          alert(data.responseText);
        },
    });

    request.done(function(data){
      if ( data.status == true){
        window.location.reload();
      }
    });

  }

  function getData(pageId){
    var request = $.ajax({
        url : "{{url('/')}}/api/management",
        dataType : "json",
        type : "get",
        data : {
          page : pageId
        },
        headers : {
          "Headers" : $("#token").val()
        },
        error: function(data) {
          alert(data.responseText);
        },
    });

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  }

  function deleteData(id){
    if ( confirm("Apakah anda yakin ingin mendelete data ini ?")){
        var request = $.ajax({
           url : "{{url('/')}}/api/asset/delete",
           dataType : "json",
           type : "post",
           data : {
            id : id
           },
           headers : {
            "Headers" : $("#token").val()
          },
          error: function(data) {
            alert(data.responseText);
          },
        });

        request.done(function(data){
          alert("Data sudah dihapus");
          window.location.reload();
        })
    }else{
      return false;
    }
  }
</script>
</body>
</html>


@extends('admin.layout.layout')

@section('content');
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ADD BANNER</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Banner</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Banner</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                      
              @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif

              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error: </strong> {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
                          
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong> {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              <form method="post" action="{{ url('admin/banner-add') }}" enctype="multipart/form-data">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="admin_id">Admin ID</label>
                    <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                  </div>
                  <div class="form-group" style="display:none;">
                    <label for="banner_type">Banner File Type*</label>
                    <select  class="form-control select2" id="banner_type" name="banner_type" required style="width: 100%;">
                        <!--<option value="">Select Banner Type</option>
                        <option value="image">Image</option>-->
                        <option value="video">Video</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="banner_name">Banner Caption*</label>
                    <input type="text" class="form-control"  name="banner_name" id="banner_name" placeholder="Banner Caption">
                  </div>
                  <div class="form-group">
                    <label for="banner_desc">Banner Description</label>
                    <textarea class="form-control" id="banner_desc" name="banner_desc" placeholder="Banner Description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="banner_file">Banner File(Video)*</label>
                    <input type="file" class="form-control" id="banner_file" name="banner_file">
                      </a>
                  </div>
           
           
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">Add</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
 
            <!-- /.card -->



          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
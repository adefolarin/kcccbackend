
@extends('admin.layout.layout')

@section('content');
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0">Edit Banner</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Banner</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
 


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Edit Banner</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">

              @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
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

              <?php /*@if(empty($cmspage['id'])) 
                $url = 'admin/add-edit-cms-page';
              @else 
                $url = 'admin/add-edit-cms-page/'.$cmspage['id'];
              @endif
              <?php */ ?>
              <h5 class="text-center alert alert-primary">Edit Banner Data</h5>
              <form name="bannerform" id="bannerform" 
               action="{{ url('admin/banner-edit/'.$banner['banner_id']) }}" method="post" enctype="multipart/form-data">@csrf
                <div class="card-body">
                <div class="form-group" style="display:none;">
                    <label for="banner_id">Banner ID*</label>
                    <input type="text" class="form-control" id="banner_id" name="banner_id" required @if(!empty($banner['banner_id'])) value="{{ $banner['banner_id'] }}" @endif readonly>
                  </div>
                <div class="form-group" style="display:none;">
                    <label for="banner_type">Banner File Type*</label>
                    <select  class="form-control select2" id="banner_type" name="banner_type" required style="width: 100%;">
                        <option @if(!empty($banner['banner_type'])) value="{{ $banner['banner_type'] }}" @endif>@if(!empty($banner['banner_type'])) {{ ucwords($banner['banner_type']) }} @endif</option>
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="banner_name">Banner Caption*</label>
                    <input type="text" class="form-control" id="banner_name" name="banner_name" required @if(!empty($banner['banner_name'])) value="{{ $banner['banner_name'] }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="banner_desc">Banner Description</label>
                    <textarea class="form-control" rows="3" id="banner_desc" name="banner_desc"   required>@if(!empty($banner['banner_desc'])) {{ $banner['banner_desc'] }} @endif</textarea>
                   </div>
                   
                   <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="banner_sub">Submit</button>
                   </div>
                  
                </div>
                <!-- /.card-body -->

               
              </form>

              <hr style="border-top:1px solid grey;">

              <h5 class="text-center alert alert-primary">Change Banner Video</h5>
              <hr style="border-top:1px solid grey;">
              <div>
                    @if($banner['banner_type'] == 'image')
                      <div id="div_img">
                        <img src="{{ asset('admin/img/banners/'.$banner['banner_file']) }}" class="img-circle elevation-2" alt="Banner Image">
                      </div>
                    @else
                      <div id="div_video">
                        <video class="embed-responsive-item" controls>
                              <source src="{{ asset('storage/admin/videos/banners/'.$banner['banner_file']) }}" type="video/mp4">
                              Your browser does not support the video tag.
                         </video>
                      </div>
                     @endif
              </div>
              <form name="bannerform" id="bannerform" 
               action="{{ url('admin/banner-file-edit/'.$banner['banner_id']) }}" method="post" enctype="multipart/form-data">@csrf
                <div class="card-body">
                <div class="form-group" style="display:none;">
                    <label for="banner_id">Banner ID*</label>
                    <input type="text" class="form-control" id="banner_id" name="banner_id" required @if(!empty($banner['banner_id'])) value="{{ $banner['banner_id'] }}" @endif readonly>
                 </div>
                 <div class="form-group" style="display:none;">
                    <label for="banner_type">Banner Type</label>
                    <input type="text" class="form-control" id="banner_type" name="banner_type" required @if(!empty($banner['banner_type'])) value="{{ $banner['banner_type'] }}" @endif readonly>
                 </div>

                 <div class="form-group">
                    <label for="banner_file">Banner File(Video)*</label>
                    <input type="file" class="form-control" id="banner_file" name="banner_file">
                      </a>
                  </div>
                   
                <div class="form-group">
                   <button type="submit" class="btn btn-primary btn-block" name="banner_file_sub">Submit</button>
                </div>
                  
                </div>
                <!-- /.card-body -->

               
              </form>
              </div>

            </div>
          
          </div>

        </div>

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
</div>
<!-- /.content-wrapper -->

@endsection
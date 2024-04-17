
@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">BANNER TABLE</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">BANNER TABLE</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                  
            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success: </strong> {{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">BANNERS</h3>
                <a href="{{ url('admin/banner-add') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Banner
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablepages" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>File Type</th>
                    <th>Caption</th>
                    <th>Description</th>
                    <th>File</th>
                    <th>Created On</th>
                    <th>Actions </th>
                  </tr>
                  </thead>
                  <tbody> 
                    @foreach($banners as $banner)           
                  <tr>
                    <td>{{ ucwords($banner['banner_type']) }}</td>
                    <td>{{ $banner['banner_name'] }}</td>
                    <td>
                      @if(!empty($banner['banner_desc']))
                         {{ $banner['banner_desc'] }}
                      @else 
                          Not Available
                      @endif
                    </td>
                    <td>
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
                    </td>
                    <td>{{ date("F j, Y", strtotime($banner['banner_date'])) }} </td>
                    <td>                     
                      <a href="{{  url('admin/banner-edit/'.$banner['banner_id']) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="banner" recordid="{{ $banner['banner_id'] }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Banner" title="Delete Banner">
                        <i class="fas fa-trash"></i>
                      </a> 
                    </td>
                  </tr>   
                  @endforeach          
                  </tbody>
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
</div>
<!-- /.content-wrapper -->

@endsection
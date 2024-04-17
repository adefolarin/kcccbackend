@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">FOOD BANK GALLERY ( {{ ucwords($foodbankone['foodbanks_name']) }} )</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">FOOD BANK GALLERY</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="card card-primary">
                <div class="card-header">
                    @if(empty($foodbankgalleriesone['foodbankgalleries_id']))
                     <h3 class="card-title">Add Food Bank Gallery Picture</h3>
                    @else
                     <h3 class="card-title">Edit Food Bank Gallery Picture</h3>
                    @endif
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
                
                @if(empty($foodbankgalleriesone['foodbankgalleries_id']))
                <form method="post" action="{{ url('admin/foodbankgallery/' . $foodbankone['foodbanks_id']) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="foodbanks_id">Food Bank Gallerys ID</label>
                        <input type="text"  class="form-control" id="foodbanks_id" value="{{ $foodbankone['foodbanks_id'] }}" readonly name="foodbanks_id">
                    </div>       

                    <div class="form-group">
                        <label for="foodbanks_file">Image</label>
                        <input type="file" class="form-control"  name="foodbankgalleries_file" id="foodbankgalleries_file" placeholder="Food Bank Gallery Gallery Image" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" 
                  action="{{ url('admin/foodbankgallery/'. $foodbankone['foodbanks_id'] . '/' . $foodbankgalleriesone['foodbankgalleries_id'] ) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="foodbanksid">Food Bank Gallery ID</label>
                        <input type="text" class="form-control"  name="foodbanksid" id="foodbanksid" value="{{ $foodbankgalleriesone['foodbanksid'] }}" required>
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="foodbankgalleries_id">Food Bank Gallery Gallery ID</label>
                        <input type="text" class="form-control"  name="foodbankgalleries_id" id="foodbankgalleries_id" value="{{ $foodbankgalleriesone['foodbankgalleries_id'] }}" required>
                    </div> 
                    <div class="form-group">
                        <label for="foodbankgalleries_file">Image (Optional)</label>
                        <input type="file" class="form-control"  name="foodbankgalleries_file" id="foodbankgalleries_file" placeholder="Food Bank Gallery Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentfoodbankgalleries_file">Current Image</label>
                        <input type="text" class="form-control"  name="currentfoodbankgalleries_file" id="currentfoodbankgalleries_file" placeholder="Food Bank Gallery Gallery Image" value="{{ $foodbankgalleriesone['foodbankgalleries_file'] }}">
                    </div>   
                    <div id="div_img">
                        <img src="{{ asset('admin/img/foodbankgalleries/'.$foodbankgalleriesone['foodbankgalleries_file']) }}" class="img-circle elevation-2" alt="Food Bank Gallery Image">
                     </div>         
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Edit</button>
                    </div>
                </form>
                @endif
                </div>
            </div>
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">FOOD BANK GALLERY ({{ ucwords($foodbankone['foodbanks_name']) }})</h3>
                @if(!empty($foodbankgalleriesone['foodbankgalleries_id']))
                <a href="{{ url('admin/foodbankgallery/' . $foodbankone['foodbanks_id']) }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Food Bank Gallery Pictures
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped" >
                  
                <thead>
                  <tr> 
                    <th>Image</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($foodbankgalleries as $foodbankgallery)           
                  <tr>
                    <td>
                       <div id="div_img">
                         <img src="{{ asset('admin/img/foodbankgalleries/'.$foodbankgallery->foodbankgalleries_file) }}" class="img-circle elevation-2" alt="Food Bank Gallery Image">
                       </div>
                    </td>
                    <td>                     
                      <a href="{{  url('admin/foodbankgallery/' . $foodbankgallery->foodbanksid . '/'.$foodbankgallery->foodbankgalleries_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="foodbankgallery" 
                      recordid="{{ $foodbankgallery->foodbanksid . '/' . $foodbankgallery->foodbankgalleries_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Food Bank Gallery Picture" title="Delete Food Bank Gallery Picture">
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

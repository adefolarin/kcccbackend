@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">FOOD BANKS</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">FOOD BANKS</li>
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
                    @if(empty($foodbankone['foodbanks_id']))
                     <h3 class="card-title">Add Food Bank</h3>
                    @else
                     <h3 class="card-title">Edit Food Bank</h3>
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
                
                @if(empty($foodbankone['foodbanks_id']))
                <form method="post" action="{{ url('admin/foodbank') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="foodbankscategories_name">Food Bank Category Name</label>
                      <select  class="form-control select2" id="foodbankcategoriesid" name="foodbankcategoriesid" required style="width: 100%;">
                      @foreach($foodbankcategories as $foodbankcategory) 
                          <option value="">Select Food Bank Category</option>
                          <option value="{{ $foodbankcategory['foodbankcategories_id'] }}">
                            {{ ucwords($foodbankcategory['foodbankcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="foodbanks_title">Food Bank Name</label>
                        <input type="text" class="form-control"  name="foodbanks_name" id="foodbanks_name" placeholder="Food Bank Name" required >
                    </div> 
                     
                    <div class="form-group">
                       <label>Food Bank Date</label>
                       <div class="input-group date" id="foodbanks_date" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#foodbanks_date" required name="foodbanks_date">
                        <div class="input-group-append" data-target="#foodbanks_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>
     
                    <div class="form-group">
                        <label for="foodbanks_imagefile">Image</label>
                        <input type="file" class="form-control"  name="foodbanks_imagefile" id="foodbanks_imagefile" placeholder="Food Bank Image">
                    </div>
                    
                    <div class="form-group">
                        <label for="foodbanks_videofile">Video</label>
                        <input type="file" class="form-control"  name="foodbanks_videofile" id="foodbanks_videofile" placeholder="Food Bank Video">
                    </div> 
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/foodbank/'. $foodbankone->foodbanks_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="foodbanks_id">Food Bank ID</label>
                        <input type="text" class="form-control"  name="foodbanks_id" id="foodbanks_id" value="{{ $foodbankone['foodbanks_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="foodbankscategories_name">Food Bank Category Name</label>
                      <select  class="form-control select2" id="foodbankcategoriesid" name="foodbankcategoriesid" required style="width: 100%;">
                      <option value="{{ $foodbankcategoryone['foodbankcategories_id'] }}">
                        {{ $foodbankcategoryone['foodbankcategories_name'] }}
                      </option>
                      @foreach($foodbankcategories as $foodbankcategory) 
                          <option value="{{ $foodbankcategory['foodbankcategories_id'] }}">
                            {{ ucwords($foodbankcategory['foodbankcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="foodbanks_title">Name</label>
                        <input type="text" class="form-control"  name="foodbanks_name" id="foodbanks_name" placeholder="Food Bank Name" required value="{{ $foodbankone['foodbanks_name'] }}">
                    </div> 
                    <div class="form-group">
                       <label>Food Bank Date</label>
                       <div class="input-group date" id="foodbanks_date" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#foodbanks_date" required name="foodbanks_date" value="{{ $foodbankone['foodbanks_date'] }}">
                        <div class="input-group-append" data-target="#foodbanks_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>
              
                    <div class="form-group">
                        <label for="foodbanks_imagefile">Image (Optional)</label>
                        <input type="file" class="form-control"  name="foodbanks_imagefile" id="foodbanks_imagefile" placeholder="Food Bank Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentfoodbanks_imagefile">Current Image</label>
                        <input type="text" class="form-control"  name="currentfoodbanks_imagefile" id="currentfoodbanks_imagefile" placeholder="Food Bank Image" value="{{ $foodbankone['foodbanks_imagefile'] }}">
                    </div> 
                    
                    <div class="form-group">
                        <label for="foodbanks_file">Video (Optional)</label>
                        <input type="file" class="form-control"  name="foodbanks_videofile" id="foodbanks_videofile" placeholder="Food Bank Video">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentfoodbanks_videofile">Current Video</label>
                        <input type="text" class="form-control"  name="currentfoodbanks_videofile" id="currentfoodbanks_videofile" placeholder="Food Bank Video" value="{{ $foodbankone['foodbanks_videofile'] }}">
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
                <h3 class="card-title">FOOD BANKS</h3>
                @if(!empty($foodbankone['foodbanks_id']))
                <a href="{{ url('admin/foodbank') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Food Bank
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped" >
                  
               
                  <tr>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Video</th>
                    <th>Gallery</th>
                    <th>Date</th>
                    <th>Actions </th>
                  </tr>
             
                  
                  <tbody> 
                    @foreach($foodbanks as $foodbank)           
                  <tr>
                    <td>{{ ucwords($foodbank->foodbankcategories_name) }}</td>
                    <td>{{ ucwords($foodbank->foodbanks_name) }}</td>
                    <td>
                        @if(!empty($foodbank->foodbanks_imagefile))
                        <div id="div_img">
                            <img src="{{ asset('admin/img/foodbanks/'.$foodbank->foodbanks_imagefile) }}" class="img-circle elevation-2" alt="Food Bank Image">
                        </div>
                       @else
                         Not Available
                       @endif
                    </td>
                    <td>
                       @if(!empty($foodbank->foodbanks_videofile))
                       <div id="div_video">
                        <video class="embed-responsive-item" controls>
                              <source src="{{ asset('storage/admin/videos/foodbanks/'.$foodbank->foodbanks_videofile) }}" type="video/mp4">
                              Your browser does not support the video tag.
                         </video>
                      </div>
                       @else
                         Not Available
                       @endif
                    </td>
                    <td>
                      <a href="{{  url('admin/foodbankgallery/'.$foodbank->foodbanks_id) }}" style="color:#3f6ed3;">
                        View / Add
                       </a>
                    </td>
                    <td>{{ ucwords($foodbank->foodbanks_date) }}</td>
                    <td>                     
                      <a href="{{  url('admin/foodbank/'.$foodbank->foodbanks_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="foodbank" 
                      recordid="{{ $foodbank->foodbanks_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Food Bank" title="Delete Food Bank">
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

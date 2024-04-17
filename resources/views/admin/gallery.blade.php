@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">GALLERY</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">GALLERY</li>
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
                    @if(empty($galleryone['galleries_id']))
                     <h3 class="card-title">Add Galleries</h3>
                    @else
                     <h3 class="card-title">Edit Galleries</h3>
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
                
                @if(empty($galleryone['news_id']))
                <form method="post" action="{{ url('admin/gallery') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="newscategories_name">Gallery Category Name</label>
                      <select  class="form-control select2" id="gallerycategoriesid" name="gallerycategoriesid" required style="width: 100%;">
                      @foreach($gallerycategories as $gallerycategory) 
                          <option value="">Select News Category</option>
                          <option value="{{ $gallerycategory['gallerycategories_id'] }}">
                            {{ ucwords($gallerycategory['gallerycategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="galleries_title">Title</label>
                        <input type="text" class="form-control"  name="galleries_title" id="galleries_title" placeholder="Gallery Title" required >
                    </div>                      
                    <div class="form-group">
                        <label for="galleries_file">Gallery Image</label>
                        <input type="file" class="form-control"  name="galleries_file" id="galleries_file" placeholder="Gallery Image" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/gallery/'. $galleryone->galleries_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="galleries_id">Gallery ID</label>
                        <input type="text" class="form-control"  name="galleries_id" id="galleries_id" value="{{ $galleryone['galleries_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="gallerycategories_name">Gallery Category Name</label>
                      <select  class="form-control select2" id="gallerycategoriesid" name="gallerycategoriesid" required style="width: 100%;">
                      <option value="{{ $gallerycategoryone['gallerycategories_id'] }}">
                        {{ $gallerycategoryone['gallerycategories_name'] }}
                      </option>
                      @foreach($gallerycategories as $gallerycategory) 
                          <option value="{{ $gallerycategory['gallerycategories_id'] }}">
                            {{ ucwords($gallerycategory['gallerycategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="galleries_title">Title</label>
                        <input type="text" class="form-control"  name="galleries_title" id="galleries_title" placeholder="Gallery Title" required value="{{ $galleryone['galleries_title'] }}">
                    </div> 
      
                    <div class="form-group">
                        <label for="galleries_file">Gallery Image (Optional)</label>
                        <input type="file" class="form-control"  name="galleries_file" id="galleries_file" placeholder="Gallery Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentgalleries_file">Current Image</label>
                        <input type="text" class="form-control"  name="currentgalleries_file" id="currentgalleries_file" placeholder="Gallery Image" value="{{ $galleryone['galleries_file'] }}">
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
                <h3 class="card-title">GALLERY</h3>
                @if(!empty($galleryone['news_id']))
                <a href="{{ url('admin/gallery') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add News
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped" >
                  
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($galleries as $gallery)           
                  <tr>
                    <td>{{ ucwords($gallery->newscategories_name) }}</td>
                    <td>{{ ucwords($gallery->news_title) }}</td>
                    <td>
                       <div id="div_img">
                         <img src="{{ asset('admin/img/gallery/'.$gallery->galleries_file) }}" class="img-circle elevation-2" alt="Gallery Image">
                       </div>
                    </td>
                    <td>                     
                      <a href="{{  url('admin/gallery/'.$gallery->galleries_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="gallery" 
                      recordid="{{ $gallery->galleries_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Gallery" title="Delete Gallery">
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

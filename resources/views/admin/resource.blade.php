@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">RESOURCES</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">RESOURCES</li>
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
                    @if(empty($resourceone['resources_id']))
                     <h3 class="card-title">Add Resource</h3>
                    @else
                     <h3 class="card-title">Edit Resource</h3>
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
                
                @if(empty($resourceone['resources_id']))
                <form method="post" action="{{ url('admin/resource') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="resourcescategories_name">Resource Category Name</label>
                      <select  class="form-control select2" id="resourcecategoriesid" name="resourcecategoriesid" required style="width: 100%;">
                      @foreach($resourcecategories as $resourcecategory) 
                          <option value="">Select Resource Category</option>
                          <option value="{{ $resourcecategory['resourcecategories_id'] }}">
                            {{ ucwords($resourcecategory['resourcecategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="resources_title">File Name</label>
                        <input type="text" class="form-control"  name="resources_name" id="resources_name" placeholder="Resource Name" required >
                    </div> 

                    <div class="form-group">
                        <label for="resources_file">File</label>
                        <input type="file" class="form-control"  name="resources_file" id="resources_file" placeholder="Resource File" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/resource/'. $resourceone->resources_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="resources_id">Resource ID</label>
                        <input type="text" class="form-control"  name="resources_id" id="resources_id" value="{{ $resourceone['resources_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="resourcescategories_name">Resource Category Name</label>
                      <select  class="form-control select2" id="resourcecategoriesid" name="resourcecategoriesid" required style="width: 100%;">
                      <option value="{{ $resourcecategoryone['resourcecategories_id'] }}">
                        {{ $resourcecategoryone['resourcecategories_name'] }}
                      </option>
                      @foreach($resourcecategories as $resourcecategory) 
                          <option value="{{ $resourcecategory['resourcecategories_id'] }}">
                            {{ ucwords($resourcecategory['resourcecategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="resources_name">Name</label>
                        <input type="text" class="form-control"  name="resources_name" id="resources_name" placeholder="Resource Name" required value="{{ $resourceone['resources_name'] }}">
                    </div>  

                      <div class="form-group">
                            <label for="resources_file">File</label>
                            <input type="file" class="form-control"  name="resources_file" id="resources_file" placeholder="Resource File">
                        </div> 
                        <div class="form-group" style="display:none;">
                            <label for="currentresources_file">Current File</label>
                            <input type="text" class="form-control"  name="currentresources_file" id="currentresources_file" placeholder="Resource File" value="{{ $resourceone['resources_file'] }}">
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
                <h3 class="card-title">RESOURCES</h3>
                @if(!empty($resourceone['resources_id']))
                <a href="{{ url('admin/resource') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Resource
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped" >
                  
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Name of File</th>
                    <th>File</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($resources as $resource)           
                  <tr>
                    <td>{{ ucwords($resource->resourcecategories_name) }}</td>
                    <td>{{ ucwords($resource->resources_name) }}</td>
                    <td>
                       <div id="div_img">
                         <a  href="{{ url('storage/admin/docs/resources/'.$resource->resources_file) }}" target="_blank">
                           {{ ucwords($resource->resources_name) }}
                         </a>
                       </div>
                    </td>
                    <td>                     
                      <a href="{{  url('admin/resource/'.$resource->resources_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="resource" 
                      recordid="{{ $resource->resources_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Resource" title="Delete Resource">
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

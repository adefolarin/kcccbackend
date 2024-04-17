@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">DEPARTMENTS</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DEPARTMENTS</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-3">
            <div class="card card-primary">
                <div class="card-header">
                    @if(empty($departmentone['departments_id']))
                     <h3 class="card-title">Add Department</h3>
                    @else
                     <h3 class="card-title">Edit Department</h3>
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
                
                @if(empty($departmentone['departments_id']))
                <form method="post" action="{{ url('admin/department') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="deptcategories_name">Department Name</label>
                      <select  class="form-control select2" id="deptcategoriesid" name="deptcategoriesid" required style="width: 100%;">
                      <option value="">Select Department</option>
                      @foreach($deptcategories as $deptcategory)                      
                          <option value="{{ $deptcategory['deptcategories_id'] }}">
                            {{ ucwords($deptcategory['deptcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
    
                    <div class="form-group">
                        <label for="departments_content">Content</label>
                        <textarea class="form-control" id="departments_content" name="departments_content" placeholder="Department Content" required></textarea>
                    </div> 

                    <div class="form-group">
                        <label for="departments_file">Image</label>
                        <input type="file" class="form-control"  name="departments_file" id="departments_file" placeholder="Department Image" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/department/'. $departmentone->departments_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="departments_id">Department ID</label>
                        <input type="text" class="form-control"  name="departments_id" id="departments_id" value="{{ $departmentone['departments_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="deptcategories_name">Department Name</label>
                      <select  class="form-control select2" id="deptcategoriesid" name="deptcategoriesid" required style="width: 100%;">
                      <option value="{{ $deptcategoryone['deptcategories_id'] }}">
                        {{ $deptcategoryone['deptcategories_name'] }}
                      </option>
                      @foreach($deptcategories as $deptcategory) 
                          <option value="{{ $deptcategory['deptcategories_id'] }}">
                            {{ ucwords($deptcategory['deptcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div> 
                    <div class="form-group">
                        <label for="departments_content">Content</label>
                        <textarea class="form-control" id="departments_content" name="departments_content" placeholder="Department Content" required>{{ $departmentone['departments_content'] }}</textarea>
                    </div>  
                    <div class="form-group">
                        <label for="departments_file">Image (Optional)</label>
                        <input type="file" class="form-control"  name="departments_file" id="departments_file" placeholder="Department Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentdepartments_file">Current Image</label>
                        <input type="text" class="form-control"  name="currentdepartments_file" id="currentdepartments_file" placeholder="Department Image" value="{{ $departmentone['departments_file'] }}">
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
          <div class="col-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DEPARTMENTS</h3>
                @if(!empty($departmentone['departments_id']))
                <a href="{{ url('admin/department') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Department
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped text-center" >
                  
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Gallery</th>
                    <th>Registered Members</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($departments as $department)           
                  <tr>
                    <td>{{ ucwords($department->deptcategories_name) }}</td>
                    <td>{{ $department->departments_content }}</td>
                    <td>
                       <div id="div_img">
                         <img src="{{ asset('admin/img/departments/'.$department->departments_file) }}" class="img-circle elevation-2" alt="Department Image">
                       </div>
                    </td>
                    <td>
                    <a href="{{  url('admin/departmentgallery/'.$department->departments_id) }}" style="color:#3f6ed3;">
                        Add & View
                      </a>
                    </td>
                    <td>
                    <a href="{{  url('admin/deptmembreg/'.$department->deptcategories_id) }}" style="color:#3f6ed3;">
                        View
                      </a>
                    </td>
                    <td>                     
                      <a href="{{  url('admin/department/'.$department->departments_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="department" 
                      recordid="{{ $department->departments_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Department" title="Delete Department">
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

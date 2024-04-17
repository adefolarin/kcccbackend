@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">VERSION</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">VERSION</li>
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
                    @if(empty($versionone['versions_id']))
                     <h3 class="card-title">Add Version</h3>
                    @else
                     <h3 class="card-title">Edit Version</h3>
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
                
                @if(empty($versionone['versions_id']))
                <form method="post" action="{{ url('admin/version') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="versions_name">Version Name</label>
                        <input type="text" class="form-control"  name="versions_name" id="versions_name" placeholder="Version Name" required >
                    </div> 
                    <div class="form-group">
                        <label for="versions_androidnumber">Android Version Number</label>
                        <input type="text" class="form-control"  name="versions_androidnumber" id="versions_androidnumber" placeholder="Android Version Number" required >
                    </div> 
                    <div class="form-group">
                        <label for="version_iosnumber">IOS Version Number</label>
                        <input type="text" class="form-control"  name="versions_iosnumber" id="versions_iosnumber" placeholder="IOS Version Number" required >
                    </div> 
             
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/version/'. $versionone->versions_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="versions_id">Version ID</label>
                        <input type="text" class="form-control"  name="versions_id" id="versions_id" value="{{ $versionone['versions_id'] }}" required>
                    </div> 

                    <div class="form-group">
                        <label for="versions_name">Version Name</label>
                        <input type="text" class="form-control"  name="versions_name" id="versions_name" placeholder="Version Name" required value="{{ $versionone['version_id'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="versions_androidnumber">Android Version Number</label>
                        <input type="text" class="form-control"  name="versions_androidnumber" id="versions_androidnumber" placeholder="Android Version Number" required value="{{ $versionone['version_id'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="versions_iosnumber">Version Number</label>
                        <input type="text" class="form-control"  name="versions_iosnumber" id="versions_iosnumber" placeholder="IOS Version Number" required value="{{ $versionone['version_id'] }}">
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
                <h3 class="card-title">VERSION</h3>
                @if(!empty($versionone['versions_id']))
                <a href="{{ url('admin/version') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Version
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped" >
                  
                <thead>
                  <tr>
                    <th>Date and Time</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($versions as $version)           
                  <tr>
                    <td>{{ ucwords($version->versioncategories_datetime) }}</td>
                    <td>                     
                      <a href="{{  url('admin/version/'.$version->versions_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="version" 
                      recordid="{{ $version->versions_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Version" title="Delete Version">
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

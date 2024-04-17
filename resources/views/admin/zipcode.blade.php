
@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ZIP CODE</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">ZIP CODE</li>
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
                    @if(empty($zipcodeone['zipcodes_id']))
                     <h3 class="card-title">Add Zip Code</h3>
                    @else
                     <h3 class="card-title">Edit Zip Code</h3>
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
                
                @if(empty($zipcodeone['zipcodes_id']))
                <form method="post" action="{{ url('admin/zipcode') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="zipcodes_name">Zip Code</label>
                        <input type="text" class="form-control"  name="zipcodes_name" id="zipcodes_name" placeholder="Zip Code">
                    </div>
                    <div class="form-group">
                        <label for="zipcodes_price">Price</label>
                        <input type="text" class="form-control"  name="zipcodes_price" id="zipcodes_price" placeholder="Zip Code Price">
                    </div>                
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/zipcode/'.$zipcodeone['zipcodes_id']) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="zipcodes_id">Zip Code ID</label>
                        <input type="text" class="form-control"  name="zipcodes_id" id="zipcodes_id" value="{{ $zipcodeone['zipcodes_id'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="zipcodes_name">Zip Code</label>
                        <input type="text" class="form-control"  name="zipcodes_name" id="zipcodes_name" placeholder="Zip Code" value="{{ $zipcodeone['zipcodes_name'] }}">
                    </div>    
                    <div class="form-group">
                        <label for="zipcodes_price">Price</label>
                        <input type="text" class="form-control"  name="zipcodes_price" id="zipcodes_price" placeholder="Zip Code Price" value="{{ $zipcodeone['zipcodes_price'] }}">
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
                <h3 class="card-title">ZIP CODE</h3>
                @if(!empty($zipcodeone['zipcodes_id']))
                <a href="{{ url('admin/zipcode') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Zip Codes
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablepages" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Zip Codes</th>
                    <th>Price</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody> 
                    @foreach($zipcodes as $zipcode)           
                  <tr>
                    <td>{{ ucwords($zipcode['zipcodes_name']) }}</td>
                    <td>{{ ucwords($zipcode['zipcodes_price']) }}</td>
                    <td>                     
                      <a href="{{  url('admin/zipcode/'.$zipcode['zipcodes_id']) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="zipcode" 
                      recordid="{{ $zipcode['zipcodes_id'] }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Zip Code" title="Delete Zip Code">
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
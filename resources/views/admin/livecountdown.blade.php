@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">COUNTDOWN</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">COUNTDOWN</li>
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
                    @if(empty($livecountdownone['livecountdowns_id']))
                     <h3 class="card-title">Add Count Down</h3>
                    @else
                     <h3 class="card-title">Edit Count Down</h3>
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
                
                @if(empty($livecountdownone['livecountdowns_id']))
                <form method="post" action="{{ url('admin/livecountdown') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                       <label>Count Down Date and Time</label>
                       <div class="input-group date" id="livecountdowns_datetime" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#livecountdowns_datetime" required name="livecountdowns_startdate">
                        <div class="input-group-append" data-target="#livecountdowns_datetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>
             
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/livecountdown/'. $livecountdownone->livecountdowns_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="livecountdowns_id">Count Down ID</label>
                        <input type="text" class="form-control"  name="livecountdowns_id" id="livecountdowns_id" value="{{ $livecountdownone['livecountdowns_id'] }}" required>
                    </div> 

                    <div class="form-group">
                       <label>Count Down Date and Time</label>
                       <div class="input-group date" id="livecountdowns_datetime" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#livecountdowns_datetime" required name="livecountdowns_startdate" value="{{ $livecountdownone['livecountdowns_datetime'] }}">
                        <div class="input-group-append" data-target="#livecountdowns_datetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
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
                <h3 class="card-title">COUNTDOWN</h3>
                @if(!empty($livecountdownone['livecountdowns_id']))
                <a href="{{ url('admin/livecountdown') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Count Down
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
                    @foreach($livecountdowns as $livecountdown)           
                  <tr>
                    <td>{{ ucwords($livecountdown->livecountdowncategories_datetime) }}</td>
                    <td>                     
                      <a href="{{  url('admin/livecountdown/'.$livecountdown->livecountdowns_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="livecountdown" 
                      recordid="{{ $livecountdown->livecountdowns_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Count Down" title="Delete Count Down">
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

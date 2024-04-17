@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Volunteer Date and Time ( {{ $volcategoryone['volcategories_name'] }} )</h5>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">VOLUNTEER DATE AND TIME</li>
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
                    @if(empty($volformone['volforms_id']))
                     <h3 class="card-title">Add Volunteer Date and Time</h3>
                    @else
                     <h3 class="card-title">Edit Volunteer Date and Time</h3>
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
                
                @if(empty($volformone['volforms_id']))
                <form method="post" action="{{ url('admin/volform/' . $volcategoryone['volcategories_id']) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                      <label for="volcategories_name">Volunteer Programm Name</label>
                      <select  class="form-control select2" id="volcategoriesid" name="volcategoriesid" required style="width: 100%;">
                          <option value="{{ $volcategoryone['volcategories_id'] }}">
                            {{ ucwords($volcategoryone['volcategories_name']) }}
                          </option>
                      </select>
                    </div>
                      
                    <div class="form-group">
                       <label>Volunteer Date and Time</label>
                       <div class="input-group date" id="voldatetime" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#voldatetime" required name="voldatetime">
                        <div class="input-group-append" data-target="#voldatetime" data-toggle="datetimepicker">
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
                <form method="post" action="{{ url('admin/volform/' . $volcategoryone['volcategories_id'] . '/' . $volformone['volforms_id']) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="volforms_id">Event ID</label>
                        <input type="text" class="form-control"  name="volforms_id" id="volforms_id" value="{{ $volformone['volforms_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="volcategories_name">Volunteer Programe Name</label>
                      <select  class="form-control select2" id="volcategoriesid" name="volcategoriesid" required style="width: 100%;">
                      <option value="{{ $volcategoryone['volcategories_id'] }}">
                        {{ $volcategoryone['volcategories_name'] }}
                      </option>
                      </select>
                    </div>
                    <div class="form-group">
                       <label>Date and Time</label>
                       <div class="input-group date" id="voldatetime" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#voldatetime" required name="voldatetime" value="{{ $volformone['voldatetime'] }}">
                        <div class="input-group-append" data-target="#voldatetime" data-toggle="datetimepicker">
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
                <h3 class="card-title">Volunteer Date and Time ( {{ $volcategoryone['volcategories_name'] }} )</h3>
                @if(!empty($volformone['volforms_id']))
                <a href="{{ url('admin/volform/' . $volcategoryone['volcategories_id']) }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Volunteer Date and Time
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
                    @foreach($volforms as $volform)           
                  <tr>
                    <td>{{ ucwords($volform->voldatetime) }}</td>
                    <td>                     
                      <a href="{{  url('admin/volform/'.$volform->volcategoriesid.'/'.$volform->volforms_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="volform" 
                      recordid="{{ $volform->volcategoriesid . '/' .$volform->volforms_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Volunteer Form" title="Delete Volunteer Date and Time">
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

@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">EVENT GALLERY ( {{ ucwords($eventone['events_title']) }} )</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">EVENT GALLERY</li>
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
                    @if(empty($eventgalleriesone['eventgalleries_id']))
                     <h3 class="card-title">Add Event Picture</h3>
                    @else
                     <h3 class="card-title">Edit Event Picture</h3>
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

                @if(empty($eventgalleriesone['eventgalleries_id']))
                <form method="post" action="{{ url('admin/eventgallery/' . $eventone['events_id']) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="text"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="events_id">Events ID</label>
                        <input type="text"  class="form-control" id="events_id" value="{{ $eventone['events_id'] }}" readonly name="events_id">
                    </div>       

                    <div class="form-group">
                        <label for="events_file">Image</label>
                        <input type="file" class="form-control"  name="eventgalleries_file" id="eventgalleries_file" placeholder="Event Gallery Image" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" 
                action="{{ url('admin/eventgallery/'. $eventone['events_id'] . '/' . $eventgalleriesone['eventgalleries_id'] ) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="text"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="eventsid">Event ID</label>
                        <input type="text" class="form-control"  name="eventsid" id="eventsid" value="{{ $eventgalleriesone['eventsid'] }}" required>
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="eventgalleries_id">Event Gallery ID</label>
                        <input type="text" class="form-control"  name="eventgalleries_id" id="eventgalleries_id" value="{{ $eventgalleriesone['eventgalleries_id'] }}" required>
                    </div> 
                    <div class="form-group">
                        <label for="eventgalleries_file">Image*</label>
                        <input type="file" class="form-control"  name="eventgalleries_file" id="eventgalleries_file" placeholder="Event Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currenteventgalleries_file">Current Image</label>
                        <input type="text" class="form-control"  name="currenteventgalleries_file" id="currenteventgalleries_file" placeholder="Event Gallery Image" value="{{ $eventgalleriesone['eventgalleries_file'] }}">
                    </div>  
                     <div id="div_img">
                         <img src="{{ asset('admin/img/eventgalleries/'.$eventgalleriesone['eventgalleries_file']) }}" class="img-circle elevation-2" alt="Event Image">
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
                <h3 class="card-title">EVENT GALLERY ({{ ucwords($eventone['events_title']) }})</h3>
                @if(!empty($eventgalleriesone['eventgalleries_id']))
                <a href="{{ url('admin/eventgallery/' . $eventone['events_id']) }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Event Pictures
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
                    @foreach($eventgalleries as $eventgallery)           
                  <tr>
                    <td>
                       <div id="div_img">
                         <img src="{{ asset('admin/img/eventgalleries/'.$eventgallery->eventgalleries_file) }}" class="img-circle elevation-2" alt="Event Image">
                       </div>
                    </td>
                    <td>                     
                      <a href="{{  url('admin/eventgallery/' . $eventgallery->eventsid . '/'.$eventgallery->eventgalleries_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="eventgallery" 
                      recordid="{{ $eventgallery->eventsid . '/' . $eventgallery->eventgalleries_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Event Picture" title="Delete Event Picture">
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

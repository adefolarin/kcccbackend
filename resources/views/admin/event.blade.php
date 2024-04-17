@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">EVENTS</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">EVENTS</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  @if(!empty($eventcategories))
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    @if(empty($eventone['events_id']))
                     <h3 class="card-title">Add Event</h3>
                    @else
                     <h3 class="card-title">Edit Event</h3>
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
                
                @if(empty($eventone['events_id']))
                <form method="post" action="{{ url('admin/event') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="eventscategories_name">Event Category Name</label>
                      <select  class="form-control select2" id="eventcategoriesid" name="eventcategoriesid" required style="width: 100%;">
                      @foreach($eventcategories as $eventcategory) 
                          <option value="">Select Event Category</option>
                          <option value="{{ $eventcategory['eventcategories_id'] }}">
                            {{ ucwords($eventcategory['eventcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="events_title">Title</label>
                        <input type="text" class="form-control"  name="events_title" id="events_title" placeholder="Event Title" required >
                    </div> 
                    <div class="form-group">
                        <label for="events_desc">Description</label>
                        <textarea class="form-control" id="events_desc" name="events_desc" placeholder="Event Description" required></textarea>
                    </div> 
                     
                    <div class="form-group">
                       <label>Event Start Date</label>
                       <div class="input-group date" id="events_startdate" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#events_startdate" required name="events_startdate">
                        <div class="input-group-append" data-target="#events_startdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>
                      
                    <div class="form-group">
                       <label>Event End Date</label>
                       <div class="input-group date" id="events_enddate" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#events_enddate" required name="events_enddate">
                        <div class="input-group-append" 
                        data-target="#events_enddate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>  
                    <div class="form-group">
                        <label for="events_venue">Venue</label>
                        <input type="text" class="form-control"  name="events_venue" id="events_venue" placeholder="Event Venue" required>
                    </div>  
                    <div class="form-group">
                        <label for="events_address">Address</label>
                        <input type="text" class="form-control"  name="events_address" id="events_addres" placeholder="Event Address" required>
                    </div>  
                    <div class="form-group">
                        <label for="events_organizer">Organizer</label>
                        <input type="text" class="form-control"  name="events_organizer" id="events_organizer" placeholder="Event Organizer" required>
                    </div> 
                    <div class="form-group">
                        <label for="events_preacher">Preacher</label>
                        <input type="text" class="form-control"  name="events_preacher" id="events_preacher" placeholder="Event Preacher" required>
                    </div> 
                    <div class="form-group">
                        <label for="events_file">Image</label>
                        <input type="file" class="form-control"  name="events_file" id="events_file" placeholder="Event Image" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/event/'. $eventone->events_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="events_id">Event ID</label>
                        <input type="text" class="form-control"  name="events_id" id="events_id" value="{{ $eventone['events_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="eventscategories_name">Event Category Name</label>
                      <select  class="form-control select2" id="eventcategoriesid" name="eventcategoriesid" required style="width: 100%;">
                      <option value="{{ $eventcategoryone['eventcategories_id'] }}">
                        {{ $eventcategoryone['eventcategories_name'] }}
                      </option>
                      @foreach($eventcategories as $eventcategory) 
                          <option value="{{ $eventcategory['eventcategories_id'] }}">
                            {{ ucwords($eventcategory['eventcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="events_title">Title</label>
                        <input type="text" class="form-control"  name="events_title" id="events_title" placeholder="Event Title" required value="{{ $eventone['events_title'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="events_desc">Description</label>
                        <textarea class="form-control" id="events_desc" name="events_desc" placeholder="Event Description" required>{{ $eventone['events_desc'] }}</textarea>
                    </div>  
                    <div class="form-group">
                       <label>Event Start Date</label>
                       <div class="input-group date" id="events_startdate" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#events_startdate" required name="events_startdate" value="{{ $eventone['events_startdate'] }}">
                        <div class="input-group-append" data-target="#events_startdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>
                    <div class="form-group">
                       <label>Event End Date</label>
                       <div class="input-group date" id="events_enddate" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#events_enddate" required name="events_enddate" value="{{ $eventone['events_enddate'] }}">
                        <div class="input-group-append" data-target="#events_enddate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>  
                    <div class="form-group">
                        <label for="events_venue">Venue</label>
                        <input type="text" class="form-control"  name="events_venue" id="events_venue" placeholder="Event Venue" required value="{{ $eventone['events_venue'] }}">
                    </div>  
                    <div class="form-group">
                        <label for="events_address">Address</label>
                        <input type="text" class="form-control"  name="events_address" id="events_addres" placeholder="Event Address" required value="{{ $eventone['events_address'] }}">
                    </div>  
                    <div class="form-group">
                        <label for="events_organizer">Organizer</label>
                        <input type="text" class="form-control"  name="events_organizer" id="events_organizer" placeholder="Event Organizer" required value="{{ $eventone['events_organizer'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="events_preacher">Preacher</label>
                        <input type="text" class="form-control"  name="events_preacher" id="events_preacher" placeholder="Event Preacher" required value="{{ $eventone['events_preacher'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="events_file">Image (Optional)</label>
                        <input type="file" class="form-control"  name="events_file" id="events_file" placeholder="Event Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentevents_file">Current Image</label>
                        <input type="text" class="form-control"  name="currentevents_file" id="currentevents_file" placeholder="Event Image" value="{{ $eventone['events_file'] }}">
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">EVENTS</h3>
                @if(!empty($eventone['events_id']))
                <a href="{{ url('admin/event') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Event
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped text-center" >
                  
            
                  <tr>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Venue</th>
                    <th>Address</th>
                    <th>Organizer</th>
                    <th>Preacher</th>
                    <th>Gallery</th>
                    <th>Registered Members</th>
                    <th>Actions </th>
                  </tr>
                
         
                  
                  <tbody> 
                    @foreach($events as $event)           
                  <tr>
                    <td>{{ ucwords($event->eventcategories_name) }}</td>
                    <td>{{ ucwords($event->events_title) }}</td>
                    <td>{{ $event->events_desc }}</td>
                    <td>
                       <div id="div_img">
                         <img src="{{ asset('admin/img/events/'.$event->events_file) }}" class="img-circle elevation-2" alt="Event Image">
                       </div>
                    </td>
                    <td>{{ ucwords($event->events_startdate) }}</td>
                    <td>{{ ucwords($event->events_enddate) }}</td>
                    <td>{{ ucwords($event->events_venue) }}</td>
                    <td>{{ ucwords($event->events_address) }}</td>
                    <td>{{ ucwords($event->events_organizer) }}</td>
                    <td>{{ ucwords($event->events_preacher) }}</td>
                    <td>
                      <a href="{{  url('admin/eventgallery/'.$event->events_id) }}" style="color:#3f6ed3;">
                        Add & View
                      </a>
                    </td>
                    <td>
                      <a href="{{  url('admin/eventreg/'.$event->events_id) }}" style="color:#3f6ed3;">
                        View
                      </a>
                    </td>
                    <td>                     
                      <a href="{{  url('admin/event/'.$event->events_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="event" 
                      recordid="{{ $event->events_id }}"  style="color:#ee4b2b;" class="confirmDelete" name="Event" title="Delete Event">
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
@else
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card card-primary">
                <div class="card-header">
                  <h4 class="text-center" style="text-transform:uppercase;">There must be at least one event category before you can proceed</h4>
                </div>
          </div>
          </div>
        </div>
       </div>
</section>
@endif
</div>
<!-- /.content-wrapper -->

@endsection

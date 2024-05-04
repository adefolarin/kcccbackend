@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">PODCASTS</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">PODCASTS</li>
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
                    @if(empty($podcastone['podcasts_id']))
                     <h3 class="card-title">Add Podcast</h3>
                    @else
                     <h3 class="card-title">Edit Podcast</h3>
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
                
                @if(empty($podcastone['podcasts_id']))
                <form method="post" action="{{ url('admin/podcast') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="podcastscategories_name">Podcast Category Name</label>
                      <select  class="form-control select2" id="podcastcategoriesid" name="podcastcategoriesid" required style="width: 100%;">
                      @foreach($podcastcategories as $podcastcategory) 
                          <option value="">Select Podcast Category</option>
                          <option value="{{ $podcastcategory['podcastcategories_id'] }}">
                            {{ ucwords($podcastcategory['podcastcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="podcasts_title">Title</label>
                        <input type="text" class="form-control"  name="podcasts_title" id="podcasts_title" placeholder="Podcast Title" required >
                    </div> 
                           
                <div class="form-group">
                        <label for="podcasts_location">Location</label>
                        <input type="text" class="form-control"  name="podcasts_location" id="podcasts_location" placeholder="Podcast Location" required>
                    </div>  
                    <div class="form-group">
                        <label for="podcasts_preacher">Preacher</label>
                        <input type="text" class="form-control"  name="podcasts_preacher" id="podcasts_preacher" placeholder="Podcast Preacher" required>
                    </div> 
                    
                    <div class="form-group">
                       <label>Date Podcast Was Preached</label>
                       <div class="input-group date" id="podcasts_date" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#podcasts_date" required name="podcasts_date">
                        <div class="input-group-append" data-target="#podcasts_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>

                    <div class="form-group" style="display:none;">
                      <label for="podcasts_filetype">Podcast File Type</label>
                      <select  class="form-control select2" id="podcasts_filetype" name="podcasts_filetype" required style="width: 100%;">
                          <!--<option value="">Select File Type</option>-->
                          <option value="remote">Remote</option>
                          <!--<option value="local">Local</option>-->
                      </select>
                    </div>

                    <!--<div class="form-group">
                        <label for="podcasts_videofile">Audio</label>
                        <input type="file" class="form-control"  name="podcasts_videofile" id="podcasts_videofile" placeholder="Podcast Audio" required>
                    </div>-->
                    
                    <div class="form-group">
                        <label for="podcasts_urlfile">Audio(Podcast URL)</label>
                        <input type="text" class="form-control"  name="podcasts_urlfile" id="podcasts_urlfile" placeholder="Podcast  URL" required>
                    </div>  
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/podcast/'. $podcastone->podcasts_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="podcasts_id">Podcast ID</label>
                        <input type="text" class="form-control"  name="podcasts_id" id="podcasts_id" value="{{ $podcastone['podcasts_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="podcastscategories_name">Podcast Category Name</label>
                      <select  class="form-control select2" id="podcastcategoriesid" name="podcastcategoriesid" required style="width: 100%;">
                      <option value="{{ $podcastcategoryone['podcastcategories_id'] }}">
                        {{ $podcastcategoryone['podcastcategories_name'] }}
                      </option>
                      @foreach($podcastcategories as $podcastcategory) 
                          <option value="{{ $podcastcategory['podcastcategories_id'] }}">
                            {{ ucwords($podcastcategory['podcastcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="podcasts_title">Title</label>
                        <input type="text" class="form-control"  name="podcasts_title" id="podcasts_title" placeholder="Podcast Title" required value="{{ $podcastone['podcasts_title'] }}">
                    </div>  
                    <div class="form-group">
                        <label for="podcasts_location">Location</label>
                        <input type="text" class="form-control"  name="podcasts_location" id="podcasts_location" placeholder="Podcast Location" required value="{{ $podcastone['podcasts_location'] }}">
                    </div>  
                    <div class="form-group">
                        <label for="podcasts_preacher">Preacher</label>
                        <input type="text" class="form-control"  name="podcasts_preacher" id="podcasts_preacher" placeholder="Preacher" required value="{{ $podcastone['podcasts_preacher'] }}">
                    </div>  
                    <div class="form-group">
                       <label>Date Podcast Was Preached</label>
                       <div class="input-group date" id="podcasts_date" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#podcasts_date" required name="podcasts_date" value="{{ $podcastone['podcasts_date'] }}">
                        <div class="input-group-append" data-target="#podcasts_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>

                    <div class="form-group" style="display:none;">
                      <label for="podcasts_filetype">Podcast File Type</label>
                      <select  class="form-control select2" id="podcasts_filetype" name="podcasts_filetype" required style="width: 100%;">
                         <!--<option value="<?php //{{ $podcastone['podcasts_filetype'] }} ?>">
                           <?php // {{ $podcastone['podcasts_filetype'] }} ?>
                         </option>-->
                          <option value="remote">Remote</option>
                          <!--<option value="local">Local</option>-->
                      </select>
                    </div>

                      <!--<div class="form-group">
                            <label for="podcasts_file">Audio (Optional)</label>
                            <input type="file" class="form-control"  name="podcasts_videoile" id="podcasts_videofile" placeholder="Podcast Audio">
                        </div> 
                        <div class="form-group" style="display:none;">
                            <label for="currentpodcasts_file">Current Audio</label>
                            <input type="text" class="form-control"  name="currentpodcasts_file" id="currentpodcasts_file" placeholder="Podcast Audio" value="{{ <?php //$podcastone['podcasts_file'] }} ?>">
                            
                        </div>--> 
                        
                        <div class="form-group">
                          <label for="podcasts_urlfile">Audio(Podcast  URL)</label>
                          <input type="text" class="form-control"  name="podcasts_urlfile" id="podcasts_urlfile" placeholder="Podcast  URL" required 
                          value="{{ $podcastone['podcasts_file'] }}">
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
                <h3 class="card-title">PODCASTS</h3>
                @if(!empty($podcastone['podcasts_id']))
                <a href="{{ url('admin/podcast') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Podcast
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped" >
                  
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Title</th>
                    <th>File</th>
                    <th>Location of Podcast</th>
                    <th>Likes</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($podcasts as $podcast)           
                  <tr>
                    <td>{{ ucwords($podcast->podcastcategories_name) }}</td>
                    <td>{{ ucwords($podcast->podcasts_title) }}</td>
                    <td>
                       
                        <audio controls> 
                           <source src="{{ $podcast->podcasts_file }}" type="audio/mpeg">
                        </audio>
                     
                    </td>
                    <td>{{ ucwords($podcast->podcasts_location) }}</td>
                    <td>{{ ucwords($podcast->podcasts_likes) }}</td>
                    <td>                     
                      <a href="{{  url('admin/podcast/'.$podcast->podcasts_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="podcast" 
                      recordid="{{ $podcast->podcasts_id }}" 
                      style="color:#ee4b2b;" class="confirmDelete" name="Podcast" title="Delete Podcast">
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

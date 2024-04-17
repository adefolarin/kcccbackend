@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">SERMONS</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">SERMONS</li>
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
                    @if(empty($sermonone['sermons_id']))
                     <h3 class="card-title">Add Sermon</h3>
                    @else
                     <h3 class="card-title">Edit Sermon</h3>
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
                
                @if(empty($sermonone['sermons_id']))
                <form method="post" action="{{ url('admin/sermon') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="sermonscategories_name">Sermon Category Name</label>
                      <select  class="form-control select2" id="sermoncategoriesid" name="sermoncategoriesid" required style="width: 100%;">
                      @foreach($sermoncategories as $sermoncategory) 
                          <option value="">Select Sermon Category</option>
                          <option value="{{ $sermoncategory['sermoncategories_id'] }}">
                            {{ ucwords($sermoncategory['sermoncategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="sermons_title">Title</label>
                        <input type="text" class="form-control"  name="sermons_title" id="sermons_title" placeholder="Sermon Title" required >
                    </div> 
                           
                <div class="form-group">
                        <label for="sermons_location">Location</label>
                        <input type="text" class="form-control"  name="sermons_location" id="sermons_location" placeholder="Sermon Location" required>
                    </div>  
                    <div class="form-group">
                        <label for="sermons_preacher">Preacher</label>
                        <input type="text" class="form-control"  name="sermons_preacher" id="sermons_preacher" placeholder="Sermon Preacher" required>
                    </div> 
                    
                    <div class="form-group">
                       <label>Date Sermon Was Preached</label>
                       <div class="input-group date" id="sermons_date" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#sermons_date" required name="sermons_date">
                        <div class="input-group-append" data-target="#sermons_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>

                    <div class="form-group" style="display:none;">
                      <label for="sermons_filetype">Sermon File Type</label>
                      <select  class="form-control select2" id="sermons_filetype" name="sermons_filetype" required style="width: 100%;">
                          <!--<option value="">Select File Type</option>-->
                          <option value="remote">Remote</option>
                          <!--<option value="local">Local</option>-->
                      </select>
                    </div>

                    <!--<div class="form-group">
                        <label for="sermons_videofile">Video</label>
                        <input type="file" class="form-control"  name="sermons_videofile" id="sermons_videofile" placeholder="Sermon Video" required>
                    </div>-->
                    
                    <div class="form-group">
                        <label for="sermons_urlfile">Video(Sermon Youtube URL)</label>
                        <input type="text" class="form-control"  name="sermons_urlfile" id="sermons_urlfile" placeholder="Sermon Youtube URL" required>
                    </div>  
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/sermon/'. $sermonone->sermons_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="sermons_id">Sermon ID</label>
                        <input type="text" class="form-control"  name="sermons_id" id="sermons_id" value="{{ $sermonone['sermons_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="sermonscategories_name">Sermon Category Name</label>
                      <select  class="form-control select2" id="sermoncategoriesid" name="sermoncategoriesid" required style="width: 100%;">
                      <option value="{{ $sermoncategoryone['sermoncategories_id'] }}">
                        {{ $sermoncategoryone['sermoncategories_name'] }}
                      </option>
                      @foreach($sermoncategories as $sermoncategory) 
                          <option value="{{ $sermoncategory['sermoncategories_id'] }}">
                            {{ ucwords($sermoncategory['sermoncategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="sermons_title">Title</label>
                        <input type="text" class="form-control"  name="sermons_title" id="sermons_title" placeholder="Sermon Title" required value="{{ $sermonone['sermons_title'] }}">
                    </div>  
                    <div class="form-group">
                        <label for="sermons_location">Location</label>
                        <input type="text" class="form-control"  name="sermons_location" id="sermons_location" placeholder="Sermon Location" required value="{{ $sermonone['sermons_location'] }}">
                    </div>  
                    <div class="form-group">
                        <label for="sermons_preacher">Preacher</label>
                        <input type="text" class="form-control"  name="sermons_preacher" id="sermons_preacher" placeholder="Preacher" required value="{{ $sermonone['sermons_preacher'] }}">
                    </div>  
                    <div class="form-group">
                       <label>Date Sermon Was Preached</label>
                       <div class="input-group date" id="sermons_date" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#sermons_date" required name="sermons_date" value="{{ $sermonone['sermons_date'] }}">
                        <div class="input-group-append" data-target="#sermons_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>

                    <div class="form-group" style="display:none;">
                      <label for="sermons_filetype">Sermon File Type</label>
                      <select  class="form-control select2" id="sermons_filetype" name="sermons_filetype" required style="width: 100%;">
                         <!--<option value="<?php //{{ $sermonone['sermons_filetype'] }} ?>">
                           <?php // {{ $sermonone['sermons_filetype'] }} ?>
                         </option>-->
                          <option value="remote">Remote</option>
                          <!--<option value="local">Local</option>-->
                      </select>
                    </div>

                      <!--<div class="form-group">
                            <label for="sermons_file">Video (Optional)</label>
                            <input type="file" class="form-control"  name="sermons_videoile" id="sermons_videofile" placeholder="Sermon Video">
                        </div> 
                        <div class="form-group" style="display:none;">
                            <label for="currentsermons_file">Current Video</label>
                            <input type="text" class="form-control"  name="currentsermons_file" id="currentsermons_file" placeholder="Sermon Video" value="{{ <?php //$sermonone['sermons_file'] }} ?>">
                            
                        </div>--> 
                        
                        <div class="form-group">
                          <label for="sermons_urlfile">Video(Sermon Youtube URL)</label>
                          <input type="text" class="form-control"  name="sermons_urlfile" id="sermons_urlfile" placeholder="Sermon Youtube URL" required 
                          value="{{ $sermonone['sermons_file'] }}">
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
                <h3 class="card-title">SERMONS</h3>
                @if(!empty($sermonone['sermons_id']))
                <a href="{{ url('admin/sermon') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Sermon
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
                    <th>Location of Sermon</th>
                    <th>Likes</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($sermons as $sermon)           
                  <tr>
                    <td>{{ ucwords($sermon->sermoncategories_name) }}</td>
                    <td>{{ ucwords($sermon->sermons_title) }}</td>
                    <td>
                       <div id="div_video">
                        <iframe width="200" height="100" src="{{ $sermon->sermons_file }}">
                        </iframe>
                       </div>
                    </td>
                    <td>{{ ucwords($sermon->sermons_location) }}</td>
                    <td>{{ ucwords($sermon->sermons_likes) }}</td>
                    <td>                     
                      <a href="{{  url('admin/sermon/'.$sermon->sermons_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="sermon" 
                      recordid="{{ $sermon->sermons_id }}" 
                      style="color:#ee4b2b;" class="confirmDelete" name="Sermon" title="Delete Sermon">
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

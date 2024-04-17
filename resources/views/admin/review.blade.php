@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">YEAR IN REVIEW</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">YEAR IN REVIEW</li>
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
                    @if(empty($reviewone['reviews_id']))
                     <h3 class="card-title">Add Review</h3>
                    @else
                     <h3 class="card-title">Edit Review</h3>
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
                
                @if(empty($reviewone['reviews_id']))
                <form method="post" action="{{ url('admin/review') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>                     
                    <div class="form-group">
                       <label>Year</label>
                       <div class="input-group date" id="reviews_year" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reviews_year" required name="reviews_year">
                        <div class="input-group-append" data-target="#reviews_year" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div>
                    <div class="form-group">
                        <label for="reviews_file">Video (Max Size: 100MB)</label>
                        <input type="file" class="form-control"  name="reviews_file" id="reviews_file" placeholder="Video File" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/review/'. $reviewone->reviews_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="reviews_id">Review ID</label>
                        <input type="text" class="form-control"  name="reviews_id" id="reviews_id" value="{{ $reviewone['reviews_id'] }}" required>
                    </div> 

                    <div class="form-group">
                       <label>Year</label>
                       <div class="input-group date" id="reviews_year" 
                       data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reviews_year" required name="reviews_year" value="{{ $reviewone['reviews_year'] }}">
                        <div class="input-group-append" data-target="#reviews_year" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                       </div> 
                    </div> 
                    <div class="form-group">
                        <label for="reviews_file">Video</label>
                        <input type="file" class="form-control"  name="reviews_file" id="reviews_file" placeholder="Video File">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentreviews_file">Current Video</label>
                        <input type="text" class="form-control"  name="currentreviews_file" id="currentreviews_file" placeholder="Video" value="{{ $reviewone['reviews_file'] }}">
                    </div> 
                    <div id="div_video">
                        <video class="embed-responsive-item" controls>
                              <source src="{{ asset('storage/admin/videos/reviews/'.$reviewone['reviews_file']) }}" type="video/mp4">
                              Your browser does not support the video tag.
                         </video>
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
                <h3 class="card-title">YEAR IN REVIEW</h3>
                @if(!empty($reviewone['reviews_id']))
                <a href="{{ url('admin/review') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Review
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped text-center" >
                  
            
                  <tr>
                    <th>Year</th>
                    <th>Video</th>
                    <th>Actions</th>
                  </tr>
                
         
                  
                  <tbody> 
                    @foreach($reviews as $review)           
                  <tr>
                    <td>{{ ucwords($review->reviews_year) }}</td>
                    <td>
                       <div id="div_video">
                        <video class="embed-responsive-item" controls>
                              <source src="{{ asset('storage/admin/videos/reviews/'.$review->reviews_file) }}" type="video/mp4">
                              Your browser does not support the video tag.
                         </video>
                        </div>
                    </td>

                    <td>                     
                      <a href="{{  url('admin/review/'.$review->reviews_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="review" 
                      recordid="{{ $review->reviews_id }}"  style="color:#ee4b2b;" class="confirmDelete" name="Review" title="Delete Review">
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

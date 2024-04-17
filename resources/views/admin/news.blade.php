@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">NEWS</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">NEWS</li>
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
                    @if(empty($newsone['news_id']))
                     <h3 class="card-title">Add News</h3>
                    @else
                     <h3 class="card-title">Edit News</h3>
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
                
                @if(empty($newsone['news_id']))
                <form method="post" action="{{ url('admin/news') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="newscategories_name">News Category Name</label>
                      <select  class="form-control select2" id="newscategoriesid" name="newscategoriesid" required style="width: 100%;">
                      @foreach($newscategories as $newscategory) 
                          <option value="">Select News Category</option>
                          <option value="{{ $newscategory['newscategories_id'] }}">
                            {{ ucwords($newscategory['newscategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="news_title">Title</label>
                        <input type="text" class="form-control"  name="news_title" id="news_title" placeholder="News Title" required >
                    </div> 
                    <div class="form-group">
                        <label for="news_content">Content</label>
                        <textarea class="form-control" id="news_content" name="news_content" placeholder="News Content" required></textarea>
                    </div> 
                     
                    <div class="form-group">
                        <label for="news_file">News Image</label>
                        <input type="file" class="form-control"  name="news_file" id="news_file" placeholder="News Image" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/news/'. $newsone->news_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="news_id">News ID</label>
                        <input type="text" class="form-control"  name="news_id" id="news_id" value="{{ $newsone['news_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="newscategories_name">News Category Name</label>
                      <select  class="form-control select2" id="newscategoriesid" name="newscategoriesid" required style="width: 100%;">
                      <option value="{{ $newscategoryone['newscategories_id'] }}">
                        {{ $newscategoryone['newscategories_name'] }}
                      </option>
                      @foreach($newscategories as $newscategory) 
                          <option value="{{ $newscategory['newscategories_id'] }}">
                            {{ ucwords($newscategory['newscategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="news_title">Title</label>
                        <input type="text" class="form-control"  name="news_title" id="news_title" placeholder="News Title" required value="{{ $newsone['news_title'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="news_title">Content</label>
                        <textarea class="form-control" id="news_content" name="news_content" placeholder="News Content" required>{{ $newsone['news_content'] }}</textarea>
                    </div>  
      
                    <div class="form-group">
                        <label for="news_file">News Image (Optional)</label>
                        <input type="file" class="form-control"  name="news_file" id="news_file" placeholder="News Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentnews_file">Current Image</label>
                        <input type="text" class="form-control"  name="currentnews_file" id="currentnews_file" placeholder="News Image" value="{{ $newsone['news_file'] }}">
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
                <h3 class="card-title">NEWS</h3>
                @if(!empty($newsone['news_id']))
                <a href="{{ url('admin/news') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add News
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
                    <th>Content</th>
                    <th>Image</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($news as $new)           
                  <tr>
                    <td>{{ ucwords($new->newscategories_name) }}</td>
                    <td>{{ ucwords($new->news_title) }}</td>
                    <td>{{ $new->news_content }}</td>
                    <td>
                       <div id="div_img">
                         <img src="{{ asset('admin/img/news/'.$new->news_file) }}" class="img-circle elevation-2" alt="News Image">
                       </div>
                    </td>
                    <td>                     
                      <a href="{{  url('admin/news/'.$new->news_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="news" 
                      recordid="{{ $new->news_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="News" title="Delete News">
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

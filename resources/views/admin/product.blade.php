@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">PRODUCTS</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">PRODUCTS</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  @if(!empty($productcategories))
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="card card-primary">
                <div class="card-header">
                    @if(empty($productone['products_id']))
                     <h3 class="card-title">Add Product</h3>
                    @else
                     <h3 class="card-title">Edit Product</h3>
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
                
                @if(empty($productone['products_id']))
                <form method="post" action="{{ url('admin/product') }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="productscategories_name">Product Category Name</label>
                      <select  class="form-control select2" id="productcategoriesid" name="productcategoriesid" required style="width: 100%;">
                      @foreach($productcategories as $productcategory) 
                          <option value="">Select Product Category</option>
                          <option value="{{ $productcategory['productcategories_id'] }}">
                            {{ ucwords($productcategory['productcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="products_title">Name</label>
                        <input type="text" class="form-control"  name="products_name" id="products_name" placeholder="Product Name" required >
                    </div> 
                    <div class="form-group">
                        <label for="products_title">Description</label>
                        <textarea class="form-control" id="products_description" name="products_description" placeholder="Product Description" required></textarea>
                    </div> 
                       
                    <div class="form-group">
                        <label for="products_price">Price</label>
                        <input type="text" class="form-control"  name="products_price" id="products_price" placeholder="Product Price" required>
                    </div>   
                    <div class="form-group">
                        <label for="products_image">Image</label>
                        <input type="file" class="form-control"  name="products_image" id="products_image" placeholder="Product Image" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{ url('admin/product/'. $productone->products_id) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="products_id">Product ID</label>
                        <input type="text" class="form-control"  name="products_id" id="products_id" value="{{ $productone['products_id'] }}" required>
                    </div> 
                    <div class="form-group">
                      <label for="productscategories_name">Product Category Name</label>
                      <select  class="form-control select2" id="productcategoriesid" name="productcategoriesid" required style="width: 100%;">
                      <option value="{{ $productcategoryone['productcategories_id'] }}">
                        {{ $productcategoryone['productcategories_name'] }}
                      </option>
                      @foreach($productcategories as $productcategory) 
                          <option value="{{ $productcategory['productcategories_id'] }}">
                            {{ ucwords($productcategory['productcategories_name']) }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="products_name">Name</label>
                        <input type="text" class="form-control"  name="products_name" id="products_name" placeholder="Product Name" required value="{{ $productone['products_name'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="products_description">Description</label>
                        <textarea class="form-control" id="products_description" name="products_description" placeholder="Product Description" required>{{ $productone['products_description'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="products_price">Price</label>
                        <textarea class="form-control" id="products_price" name="products_price" placeholder="Product Price" required>{{ $productone['products_description'] }}</textarea>
                    </div>      
                    <div class="form-group">
                        <label for="products_image">Image (Optional)</label>
                        <input type="file" class="form-control"  name="products_image" id="products_image" placeholder="Product Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentproducts_file">Current Image</label>
                        <input type="text" class="form-control"  name="currentproducts_file" id="currentproducts_file" placeholder="Product Image" value="{{ $productone['products_image'] }}">
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
                <h3 class="card-title">PRODUCTS</h3>
                @if(!empty($productone['products_id']))
                <a href="{{ url('admin/product') }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Product
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped" >
                  
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Likes</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($products as $product)           
                  <tr>
                    <td>{{ ucwords($product->productcategories_name) }}</td>
                    <td>
                       <div id="div_img" style="width:100px;margin:auto;">
                         <img src="{{ asset('admin/img/products/'.$product->products_image) }}" class="img-circle elevation-2" alt="Product Image" style="width:100%">
                       </div>
                    </td>
                    <td>{{ ucwords($product->products_name) }}</td>
                    <td>{{ $product->products_description }}</td>
                    <td>{{ ucwords($product->products_price) }}</td>
                    <td>{{ ucwords($product->products_likes) }}</td>
                    <td>                     
                      <a href="{{  url('admin/product/'.$product->products_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="product" 
                      recordid="{{ $product->products_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Product" title="Delete Product">
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
                  <h4 class="text-center" style="text-transform:uppercase;">There must be at least one product category before you can proceed</h4>
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

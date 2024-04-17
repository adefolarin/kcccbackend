
@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">REGISTERED MEMBERS</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">REGISTERED MEMBERS</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
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
                <h3 class="card-title">REGISTERED MEMBERS</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tablepages" class="table table-bordered table-striped">
               
                  <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Marital Status</th>
                    <th>Date of Birth</th>
                    <th>How You Heard About US</th>
                    <th>Reason For Joining</th>
                    <th>Are You Born Again?</th>
                    <th>Can we offer you guidnace?</th>
                    <th>Payer Request</th>
                    <th>Would like to receive news update and newsletter via email?</th>
                    <th>Date Registered</th>
                    <th>Actions </th>
                  </tr>
                
                  <tbody> 
                    @foreach($membregs as $membreg)           
                  <tr>
                    <td>{{ ucwords($membreg['membregs_name']) }}</td>
                    <td>{{ ucwords($membreg['membregs_address']) }}</td>
                    <td>{{ ucwords($membreg['membregs_email']) }}</td>
                    <td>{{ ucwords($membreg['membregs_pnum']) }}</td>
                    <td>{{ ucwords($membreg['membregs_gender']) }}</td>
                    <td>{{ ucwords($membreg['membregs_maritalstatus']) }}</td>
                    <td>{{ ucwords($membreg['membregs_dob']) }}</td>
                    <td>{{ ucwords($membreg['membregs_how']) }}</td>
                    <td>{{ ucwords($membreg['membregs_reason']) }}</td>
                    <td>{{ ucwords($membreg['membregs_bornagain']) }}</td>
                    <td>{{ ucwords($membreg['membregs_guidance']) }}</td>
                    <td>{{ ucwords($membreg['membregs_request']) }}</td>
                    <td>{{ ucwords($membreg['membregs_updated']) }}</td>
                    <td>{{ ucwords($membreg['membregs_date']) }}</td>
                    <td>                     
                      <a href= "javascript:void(0)" record="membreg" 
                      recordid="{{ $membreg['membregs_id'] }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Registered Member" title="Delete The Registered Member">
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
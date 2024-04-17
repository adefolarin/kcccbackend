$(document).ready(function() {
   // Check if admin pass is correct or not
   $("#current_pwd").keyup(function() {
      var current_pwd = $("#current_pwd").val();
      //alert(current_pwd);
      $.ajax({
        headers: {
         'X-CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/check-current-password',
        data:{current_pwd:current_pwd},
        success:function(resp){
          if(resp == "false") {
            $('#verifyCurrentPwd').html("Current Password is Incorrect!");
          } else if(resp == "true") {
            $('#verifyCurrentPwd').html("Current Password is Correct");
          }
        },error:function() {
            alert("Error");
        }
      })
   });

   $(document).on("click",".updateCmsPageStatus", function() {
     var status = $(this).children("i").attr("status");
     var page_id = $(this).attr("page_id");
     //alert(page_id);
     $.ajax({
      headers: {
        'X-CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'post',
       url: '/admin/update-cms-page-status',
       data: { status:status, page_id:page_id },
       success: function(resp) {
        if(resp['status'] == 0) {
           $("#page-"+page_id).html('<i class="fas fa-toggle-off" status="InActive" style="color:grey;"></i>');
        } else if(resp['status'] == 1) {
           $("#page-"+page_id).html('<i class="fas fa-toggle-on" status="Active" style="color:#3f6ed3;"></i>');
        }
       }, error:function() {
         alert("Error");
       }
     })
   });


    // Comfirm the deletion of CMS Page

    /*$(document).on("click",".confirmDelete", function() {
        //alert("Test");
        //return false;
        /*let name = $(this).attr('name');
        if(confirm('Are you sure you want to delete this ' + name+'?')) {
           return true;
        } else {
           return false;
        }
    })*/


    // Comfirm the deletion of CMS Page with Sweet Alert

   /* $(document).on("click",".confirmDelete", function() {
      let record = $(this).attr('record');
      let recordid= $(this).attr('recordid');
      Swal.fire({
        headers: {
          'X-CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              headers: {
                'X-CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success"
            }); 
            window.location.href = "/admin/delete-" + record + '/' + recordid;
          }
        });
    });*/

    $(document).on("click",".confirmDelete", function() {
      let record = $(this).attr('record');
      let recordid= $(this).attr('recordid');
      Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: "Deleted!",
              text: "Deletion Successful.",
              icon: "success"
            }); 
            window.location.href = "/admin/delete-" + record + '/' + recordid;
          }
        });
    });


    $(document).on("click",".confirmEventDelete", function() {
      let record = $(this).attr('record');
      let recordid= $(this).attr('recordid');

      //let eventcategoriesid = $('#eventcategoriesid-' + recordid).val();

      //let eventcategoriesid = document.getElementById("eventcategoriesid").value();

      //let eventcategoriesid = $('#eventcategoriesid').val();

      let eventcategoriesid = $(this).attr('eventcategoriesid');

      if(recordid != eventcategoriesid) {
      Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: "Deleted!",
              text: "Deletion Successful.",
              icon: "success"
            }); 
            window.location.href = "/admin/delete-" + record + '/' + recordid;
          }
        });
      } else {
        Swal.fire({
          title: "!!!OOPS?",
          text: "This category is connected to some data. Therefore you cannot delete it!",
          icon: "warning",
          showCancelButton: true,
          showConfirmButton: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          //confirmButtonText: "Yes, delete it!"
        });
      }


    });

    $(document).on("click",".confirmDeptMembDelete", function() {
      let record = $(this).attr('record');
      let recordid = $(this).attr('recordid');
      let deptmembregs_dept = $(this).attr('deptmembregs_dept');

      Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: "Deleted!",
              text: "Deletion Successful.",
              icon: "success"
            }); 
            window.location.href = "/admin/delete-" + record + '/' + recordid + '/' + deptmembregs_dept;
          }
        });
      


    });

    $(document).on("click",".confirmEventRegDelete", function() {
      let record = $(this).attr('record');
      let recordid = $(this).attr('recordid');
      let eventregs_event = $(this).attr('eventregs_event');

      Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: "Deleted!",
              text: "Deletion Successful.",
              icon: "success"
            }); 
            window.location.href = "/admin/delete-" + record + '/' + recordid + '/' + eventregs_event;
          }
        });
      


    });
      
    
});
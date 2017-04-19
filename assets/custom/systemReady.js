var save_method; //for save method string
var _dataTable;
var departmentTable;

var BASE_URL;



$(document).ready(function() {


        var url=$(location).attr('href');
        var array = url.split('/');
        var course_id = array[array.length-1];
        var uri_last=array[array.length-1];
        var targetURL='';
        //alert(uri_last);
        
        var selector='';
        if (uri_last=='show_users_view'){
            selector='#userTable';
            targetURL=BASE_URL+"member/get_users_fn";
        }
        else if (uri_last=='show_courses_view'){
            selector='#courseTable';
            targetURL=BASE_URL+"course/get_courses_fn";  
        }
        
        else if (uri_last=='enroll_students_view'){
            selector='#studentEnrollTable';
            targetURL=BASE_URL+"student/get_enrolled_students_fn";  
        }
        
        else if (! isNaN(uri_last)){
            var id=uri_last;
            uri_last=array[array.length-2];
            if(uri_last=='show_subjects_view'){
                selector='#subjectTable';
            targetURL=BASE_URL+"course/get_subjects_fn/"+id; 
            }
        }
        

        
        
            //datatables for user table
    _dataTable = $(selector).DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        //"url": "<?php echo site_url('member/ajax_userList')?>",
        "ajax": {
            "url": targetURL,
            "type": "POST",
            //"data": {"detail":"user"}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": true, //set not orderable
        },
        ],
    });
    
//For getting selected subject and allocated user

$('select[name^="subject_"]').change(function() {
   
   var userID=$(this).val();
   var selectName=$(this).attr('name').split('_');
    var subjectID = selectName[selectName.length-2];
    var semester = selectName[selectName.length-1];
    
    var url=$(location).attr('href');
        var array = url.split('/');
        var course_id = array[array.length-1];
    //alert (userID);
    //var data =(subjectID,userID);
    if(userID !=0){
    $.post( BASE_URL+"course/allocate_subject_fn",{subject_id:subjectID,user_id:userID,course_id:course_id,semester:semester}, function( data) {
    if(data==1){
                //alert ('updated');
                 $( "#responseMessage" ).html( '<span class="glyphicon glyphicon-ok" style="color:green">updated</span>' );
                 $('#responseMessage').fadeIn("slow").delay(5000).fadeOut("slow");
            } else {
                alert ('Error'); 
            }
    });
    }

});



     /*
  * For delete modal
  */
   $('#confirmDelete').on('show.bs.modal', function (e) {
      $message = $(e.relatedTarget).attr('data-message');
      $(this).find('.modal-body p').text($message);
      $title = $(e.relatedTarget).attr('data-title');
      $(this).find('.modal-title').text($title);

      // Pass form reference to modal for submission on yes/ok
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #confirm').data('form', form);
  });

  /* <!-- Form confirm (yes/ok) handler, submits form -->*/
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
      $(this).data('form').submit();
  });
    

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    
    
    
    /*
* 
* 
 */

 
$('#menu-toggle').click(function(){

if($('#menu').hasClass('open')){
$('#menu').removeClass('open');
$('#menu-toggle').removeClass('open');
$('#content-right').removeClass('content-right-moved');
$('#content-right').addClass('content-right-normal');
}else{
$('#menu').addClass('open');
$('#menu-toggle').addClass('open');
$('#content-right').addClass('content-right-moved');
}

});




  

//Document ready closes




});










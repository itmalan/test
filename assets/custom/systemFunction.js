var save_method; //for save method string
var _dataTable;
var departmentTable;

var BASE_URL;


function reload_table()
{
    _dataTable.ajax.reload(null,false); //reload datatable ajax 
    departmentTable.ajax.reload(null,false); //reload datatable ajax
}

   
function save()
{
    
    var url=$(location).attr('href');
        var array = url.split('/');
        var course_id = array[array.length-1];
        //alert ( course_id);
        
    //$('#btnSave').text('saving...'); //change button text
    //$('#btnSave').attr('disabled',true); //set button disable 
    var url;
    var temp;
    if(save_method == 'add') {
        url = BASE_URL+"member/add_user_fn";
        temp=$('#form_addUser').serialize();
    } 
    else if (save_method=='add_subject'){
         temp=$('#form_addSubject').serialize();
        url = BASE_URL+"course/add_subject_fn/"+course_id;
    }
        else if (save_method=='update_subject'){
        url = BASE_URL+"course/update_subject_fn/";
        temp=$('#form_addSubject').serialize();
    }
    
    else if (save_method=='update'){
        url = BASE_URL+"member/update_user_fn";
        temp=$('#form_addUser').serialize();
    }
    else if (save_method=='add_student'){
        //url = BASE_URL+"student/add_student_fn/"+course_id;
        url = BASE_URL+"student/add_student_general_fn/";
        temp=$('#form_addStudent').serialize();
    }
    else if (save_method=='update_student'){
        //url = BASE_URL+"student/add_student_fn/"+course_id;
        url = BASE_URL+"student/update_student_general_fn/";
        temp=$('#form_addStudent').serialize();
    }
    else if (save_method=='add_remove_subjects'){
        //url = BASE_URL+"student/add_student_fn/"+course_id;
        url = BASE_URL+"student/allocate_softcore_fn/";
        temp=$('#form_add_remove_Subjects').serialize();
    }
    


    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: temp,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form_addUser').modal('hide');
                $('#modal_form_addCourse').modal('hide');
                $('#modal_form_addSubject').modal('hide');
                $('#modal_form_addStudent').modal('hide');
                $('#modal_add_remove_Subjects').modal('hide');
                
                
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}



/*
 * 
 * User related functions
 * 
 */

function add_user()
{
    save_method = 'add';
    $('#form_addUser')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_addUser').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
}


function edit_user(id)
{
    save_method = 'update';
    $('#form_addUser')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : BASE_URL+"member/edit_user_fn/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="first_name"]').val(data.first_name);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="role"]').val(data.role);
            $('[name="status"]').val(data.status);
            $('#modal_form_addUser').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


function edit_user_profile(id)
{
    save_method = 'update';
    $('#form_addUser')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : BASE_URL+"member/edit_user_fn/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="first_name"]').val(data.first_name);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="role"]').attr('disabled', 'disabled');
            $('[name="status"]').attr('disabled', 'disabled');
            $('#modal_form_addUser').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function delete_form(id)
{
    $('#confirmDelete').modal('show'); // show bootstrap modal
    $('#confirmDelete_confirmBtn').attr('onClick',"delete_user("+id+")");
}


function delete_user(id)
{
        // ajax delete data to database
        $.ajax({
            url : BASE_URL+"member/delete_user_fn/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#confirmDelete').modal('hide');
                //if success reload ajax table
                //$('#modal_deleteForm').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
}


/*
 * 
 * Subjects related functions
 * 
 * 
 */

function add_course() // not in use
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_addCourse').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Course'); // Set Title to Bootstrap modal title
}

function add_subject()
{
    
    save_method = 'add_subject';
    

    $('#form_addSubject')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    
    $('#modal_form_addSubject').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
}



function edit_subjectForm(id)
{
    save_method = 'update_subject';
    $('#form_addSubject')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : BASE_URL+"course/edit_subject_fn/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            var radio_core= data.core;
            $('[name="id"]').val(data.id);
            $('[name="subject_title"]').val(data.name);
            $('[name="course_code"]').val(data.course_code);
            $('[name="credits"]').val(data.credits);
            $('[name="semester"]').val(data.semester);
            if(radio_core){
            $(':radio[value='+data.core+']').prop('checked', true);
             }
            $('#subjectUploadForm').hide();
            $('#modal_form_addSubject').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Subject'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}



function delete_subjectForm(id)
{
    $('#confirmDelete').modal('show'); // show bootstrap modal
    $('#confirmDelete_confirmBtn').attr('onClick',"delete_subject("+id+")");
}


function delete_subject(id)
{
        // ajax delete data to database
        $.ajax({
            url : BASE_URL+"course/delete_subject_fn/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#confirmDelete').modal('hide');
                //if success reload ajax table
                //$('#modal_deleteForm').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
}
function finalize_subject_allocation(){
    var url=$(location).attr('href');
        var array = url.split('/');
        var course_id = array[array.length-1];
    $.ajax({
            url : BASE_URL+"course/finalize_subject_allocation_fn/"+course_id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $( "#responseUpdate" ).html( '<span class="glyphicon glyphicon-ok" style="color:green">updated</span>' );
                 $('#responseUpdate').fadeIn("slow").delay(5000).fadeOut("slow");
                //if success reload ajax table
                //$('#modal_deleteForm').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Finalizing Subjects');
            }
        });
}


function add_student()
{
    save_method = 'add_student';
    $('#form_addStudent')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_addStudent').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Student'); // Set Title to Bootstrap modal title
}
function edit_studentForm(id)
{
    save_method = 'update_student';
    $('#form_addStudent')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : BASE_URL+"student/edit_student_fn/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //var radio_core= data.core;
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
            $('[name="reg_number"]').val(data.reg_number);
            $('[name="year"]').val(data.year_joined);
            $('[name="course_id"]').val(data.course_id);

            $('#studentUploadForm').hide();
            $('#modal_form_addStudent').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Student Details'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function delete_Studentform(id)
{
    $('#confirmDelete').modal('show'); // show bootstrap modal
    $('#confirmDelete_confirmBtn').attr('onClick',"delete_student("+id+")");
}


function delete_student(id)
{
        // ajax delete data to database
        $.ajax({
            url : BASE_URL+"student/delete_student_fn/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#confirmDelete').modal('hide');
                //if success reload ajax table
                //$('#modal_deleteForm').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
}

function finalize_student_details()
{
     var url=$(location).attr('href');
        var array = url.split('/');
        var course_id = array[array.length-1];
    $.ajax({
            url : BASE_URL+"student/finalize_student_details_fn/"+course_id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $( "#responseUpdate" ).html( '<span class="glyphicon glyphicon-ok" style="color:green">updated</span>' );
                 $('#responseUpdate').fadeIn("slow").delay(5000).fadeOut("slow");
                //if success reload ajax table
                //$('#modal_deleteForm').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Finalizing Subjects');
            }
        });
    
}


function generate_grade()
{
     var url=$(location).attr('href');
        var array = url.split('/');
        var subject_id = array[array.length-1];
    $.ajax({
            url : BASE_URL+"mark/generate_grade_fn/"+subject_id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $( "#responseUpdate" ).html( '<span class="glyphicon glyphicon-ok" style="color:green">updated</span>' );
                 $('#responseUpdate').fadeIn("slow").delay(5000).fadeOut("slow");
                //if success reload ajax table
                //$('#modal_deleteForm').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Finalizing Subjects');
            }
        });
    
}



/*
 * 
 * upload preview
 * 
 */
 
 $(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");

    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
        }        
        reader.readAsDataURL(file);
    });  
});



/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */

/*
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
*/
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
/*
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
*/

function ajax_process_login(){

    $.post( BASE_URL+"member/user_login_fn",{username:$('#txt_username').val(),password:$('#txt_password').val()}, function( data) {
            if(data==1){
                //alert (data);
                window.location.replace(BASE_URL+"member/home");    
            } else {
                //alert (data);
                 shakeModal('Check your input'); 
            }
        });
    
/*   Simulate error message from the server   */
     //shakeModal();
     
}


function shakeModal(data){
    $('#loginModal .modal-dialog').addClass('shake');
             //$('.error').addClass('alert alert-danger').html("Invalid username/password combination");
             $('.error').addClass('alert alert-danger').html(data);
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

   
   //functions for  semester enrolment
   
   function enroll_semester(semester){

       var temp=$('#form_enroll_sem').serialize();
       
       $.ajax({
        url : BASE_URL+"student/enroll_semester/"+semester,
        type: "POST",
        data: temp,
        dataType: "JSON",
        success: function(data)
        {
               $('#form_enroll_sem')[0].reset(); // reset form on modals
                alert ('Semester Created');
                //window.location.replace(BASE_URL+"member/home");    
            },
        error: function(data) {
                //alert (data);
                $('#form_enroll_sem')[0].reset(); // reset form on modals
                alert(data.message);
                 alert ('Already Semester Created');
              
            }
        });
}

   //funtion for adding or removing softcore subjects for enrolled students.
function add_remove_subjects(student_id)
{
    save_method = 'add_remove_subjects';

    $('#form_add_remove_Subjects')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string 
   
    //$('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
    //Ajax Load data from ajax
    $.ajax({
        url : BASE_URL+"student/get_enrolled_subjects_fn/" + student_id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="semester"]').val(data.semester);
            $('[name="name"]').val(data.name);
            $('[name="reg_number"]').val(data.reg_number);
            //$('#alloted_add_remove_subjectsTable').append(data.temp);
            $('#subjectTable').html(data.table_data);
            
            var options = $("#softcore_options");
            options.empty();
            $.each(data.softcore, function() {
                options.append($("<option />").val(this.id).text(this.name));
            });
           
           /*
           //filling select options
             var optionsValues = '<select>';
              $.each(data.softcore, function(item) {
                    optionsValues += '<option value="' + item.id + '">' + item.name + '</option>';
                    });
                optionsValues += '</select>';
            
            var options = $('#softcore_options');
            options.replaceWith(optionsValues);
            //end option fill
           
           */
            $('#modal_add_remove_Subjects').modal('show'); // show bootstrap modal

            //$('#modal_form_addUser').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Add Softcore Subject'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


   
   
   /*
    * 
    * Drop down Menu
    */
/*   
var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  
  */
 




/*
function ajax_process_register(){

    $.post( "member/user_register_fn",{username:$('#reg_username').val(),password:$('#reg_password').val(),re_password:$('#re_password').val()}, function( data ) {
            if(data == '1'){
                window.location.replace("/mark-assessment/member/home");    
            } else {
                 shakeModal(data); 
            }
        });
    
/*   Simulate error message from the server   */
     //shakeModal();
     
//}
 
 
 




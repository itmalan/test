/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
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
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function loginAjax(){

    $.post( "member/user_login",{username:$('#txt_username').val(),password:$('#txt_password').val()}, function( data ) {
            if(data == '1'){
                window.location.replace("/mark-assessment/member/home");    
            } else {
                 shakeModal('Check your input'); 
            }
        });
    
/*   Simulate error message from the server   */
     //shakeModal();
     
}

function registerAjax(){

    $.post( "member/user_register",{username:$('#reg_username').val(),password:$('#reg_password').val(),re_password:$('#re_password').val()}, function( data ) {
            if(data == '1'){
                window.location.replace("/mark-assessment/member/home");    
            } else {
                 shakeModal(data); 
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

   
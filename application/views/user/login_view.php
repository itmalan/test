<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<style>body{padding-top: 60px;}</style>
	


        <link href="<?php echo base_url('assets/login/login-register.css')?>" rel="stylesheet" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">        
             <link href="<?php echo base_url('assets/custom.css')?>" rel="stylesheet">
	
        <script src="<?php echo base_url('assets/login/login-register.js')?>" type="text/javascript"></script>
           <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
           <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
           
<script>
    
   
    
</script>
        

</head>
<body>


    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                 <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Log in</a>
                 <a class="btn big-register" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></div>
            <div class="col-sm-4"></div>
        </div>
       
         
		 <div class="modal fade login" id="loginModal">
		      <div class="modal-dialog login animated">
    		      <div class="modal-content">
    		         <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login with</h4>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">
                                <div class="social">

                                    <a id="google_login" class="circle google" href="#2">
                                        <i class="fa fa-google-plus fa-fw"></i>
                                    </a>
                                    <a id="facebook_login" class="circle facebook" href="#">
                                        <i class="fa fa-facebook fa-fw"></i>
                                    </a>
                                </div>
                                <div class="division">
                                    <div class="line l"></div>
                                      <span>or</span>
                                    <div class="line r"></div>
                                </div>
                                <div class="error"></div>
                                <div class="form loginBox">
                                    <form method="post" action="" accept-charset="UTF-8">
                                    <input id="txt_username" class="form-control" type="text" placeholder="username" name="txt_username">
                                    <input id="txt_password" class="form-control" type="password" placeholder="Password" name="txt_password">
                                           
                                    <input class="btn btn-default btn-login" id="btn_login" type="button" name="btn_login" value="Login" onclick="loginAjax()">
                                    
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                                <form method="post" html="{:multipart=>true}" data-remote="true" action="/register" accept-charset="UTF-8">
                                <input id="reg_username" class="form-control" type="text" placeholder="Username" name="txt_username">
                                <input id="reg_password" class="form-control" type="password" placeholder="Password" name="txt_password">
                                <input id="re_password" class="form-control" type="password" placeholder="Repeat Password" name="re_password">
                                
                                <input class="btn btn-default btn-register" id="btn_registern" type="button" name="btn_lregister" value="Register" onclick="registerAjax()">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>Looking to 
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>Already have an account?</span>
                             <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>        
    		      </div>
		      </div>
		  </div>
    </div>
</body>
</html>

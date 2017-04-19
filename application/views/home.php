
    <script src="<?php echo base_url('assets/home/typewriter.js')?>"></script>
	<div class="preloader">
		<img src="<?php echo base_url('assets/home/loader.gif')?>" alt="Preloader image">
	</div>

             
     

	<header id="intro">
            

			<div class="table">
				<div class="header-text">
					<div class="row">
						<div class="col-md-12 text-center">
                                                    <img class="img-rounded uni-logo" src="<?php echo base_url('assets/images/pu-logo.png')?>" alt="pu-logo"/>
							<h3 class="light white">Hello, Welcome to</h3>
							<h1 class="white typed">Grade Processing System</h1>
							<span class="typed-cursor">|</span>
						</div>
					</div>
				</div>
			</div>

	</header>
    
    
    
     <div class="modal fade login" id="loginModal">
		      <div class="modal-dialog login animated">
    		      <div class="modal-content">
    		         <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login</h4>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">
          
                                <div class="error"></div>
                                <div class="form loginBox">
                                    <form method="post" action="" accept-charset="UTF-8">
                                    <input id="txt_username" class="form-control" type="text" placeholder="username" name="txt_username">
                                    <input id="txt_password" class="form-control" type="password" placeholder="Password" name="txt_password">
                                           
                                    <input class="btn btn-default btn-login" id="btn_login" name="btn_login" value="Login" onclick="ajax_process_login()" autofocus>
                                    
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
                                
                                <input class="btn btn-default btn-register" id="btn_registern" type="button" name="btn_lregister" value="Register" onclick="ajax_process_register()">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>        
    		      </div>
		      </div>
		  </div>
    

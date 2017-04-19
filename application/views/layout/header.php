
                
        <div id="header-right">
        <div id="header-item">
        
        <nav-log id="nav-3">  
                        
        
      
            
             <?php if(! $this->session->has_userdata('mms')): ?>

               <a class="link-3" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a> 
               
                <?php  else:               
                $username= $this->session->mms['name']; 
                $id=$this->session->mms['id']; 
                                                  
                ?>
               <div id="username_head">
                  <?php echo 'Hello, ';?>
                   <a href="javascript:void(0)" onclick="edit_user_profile(<?php echo $id; ?>)">
                      <?php echo $username; ?>
                   </a>
               </div>
            
              <?php endif;?>
                
            </nav-log>
        </div>
                                

        </div>
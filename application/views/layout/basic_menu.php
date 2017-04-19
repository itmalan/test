<div id="menu-toggle" class="open">
Menu
</div>  
        
       <nav id="menu" class="open">
           <div id="header-left">
          <div id="header-item">Bioinformatics Centre</div>
        </div>
              <div id="left-item">
        <div class="user-logo">
        <img class="img-rounded user-logo" src="<?php echo base_url('assets/images/pu-logo.png')?>" alt="aayi"/>
        </div>
                  
        </div>
           <div class="blur-bg">
        <img src="<?php echo base_url('assets/images/aayi.png')?>" alt="aayi"/>
        </div>
           
            <div id="viewport">
		<div id="card" >
          <!--back content start-->
				<ul class="mainmenu">
                                    <!-- Menu for HOD Login  -->
                                    <?php  
                                    $user_role= $this->session->mms['role']; 
                                    if ($user_role==2):
                                    
                                    ?>
                                    
                                        <li><span><a href="<?php echo base_url('/member/home"')?>" class="white">Home</a></span></li>
                                        <li><span><a href="<?php echo base_url('/member/show_users_view"')?>" id="users" class="white">Users</a></span></li>
                                        <li><span>Programs</span></li>
						<ul class="submenu">
							<div class="expand-triangle"></div>
                                                        <li class="chosen"><span><a href="<?php echo base_url('/course/show_subjects_view/1')?>" class="white">M. Sc. - Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/show_subjects_view/2')?>" class="white" >M. Tech - Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/show_subjects_view/3')?>" class="white" >Ph. D - Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/show_subjects_view/4')?>" class="white" >Softcore - Bioinformatics</a></span></li>
						</ul>						
					<li><span>Course Allocation</span></li>
						<ul class="submenu">
							<div class="expand-triangle"></div>
							<li ><span><a href="<?php echo base_url('/course/subjects_allocation_view/1')?>" class="white">M. Sc Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/subjects_allocation_view/2')?>" class="white">M. Tech Bioinformatics</a></span></li>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>
					<li><span>Results / Marks</span></li>
						<ul class="submenu">
							<div class="expand-triangle"></div>
							<li><span>Internals Marks</span></li>
							<li><span>End Semester Marks</span></li>
							
						</ul>
					<li><span>Reports</span></li>
						<ul class="submenu">
							<div class="expand-triangle"></div>
							<li><span>Internal Marks</span></li>
							<li><span>End Semester Marks</span></li>
							<li><span>Grade Result</span></li>
				
						</ul>
                                        
                                        <!-- Menu for HOD Login Ends here  -->
                                    
                                        
                                        
                                        <!-- Menu for Teacher Login  -->
                                        <?php  
                                    
                                    elseif ($user_role==3):
                                    
                                    ?>
                                        <li><span><a href="<?php echo base_url('/member/home"')?>" class="white">Home</a></span></li>
                                        <li><span>Programs</span></li>
						<ul class="submenu">
							<div class="expand-triangle"></div>
                                                        <li class="chosen"><span>M. Sc Bioinformatics</span></li>
                                                                <ul class="submenu">
                                                                <div class="expand-triangle"></div>
                                                                <li><span><a href="<?php echo base_url('/subject/list_subjects_internal_mark_view/1')?>" class="white">Internal Marks</a></span></li>
                                                                <li><span><a href="<?php echo base_url('/subject/list_subjects_endsemester_mark_view/1')?>" class="white">End Semester Marks</a></span></li>
                                                                <li><span><a href="<?php echo base_url('/subject/list_subjects_overall_mark_view/1')?>" class="white">Generate Grade</a></span></li>
                                                               
				
                                                            </ul>
                                                        
                                                        <li ><span>M. Tech Bioinformatics</span></li>
                                                        <ul class="submenu">
                                                                <div class="expand-triangle"></div>
                                                                 <li><span><a href="<?php echo base_url('/subject/list_subjects_internal_mark_view/2')?>" class="white">Internal Marks</a></span></li>
                                                                <li><span><a href="<?php echo base_url('/subject/list_subjects_endsemester_mark_view/2')?>" class="white">End Semester Marks</a></span></li>
                                                                <li><span><a href="<?php echo base_url('/subject/list_subjects_overall_mark_view/2')?>" class="white">Generate Grade</a></span></li>
                                                                
				
                                                            </ul>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>
                                        
                                        <li><span>Report</span></li>
						<ul class="submenu active">
							<div class="expand-triangle"></div>
                                                        <li class="chosen"><span>M. Sc Bioinformatics</span></li>
                                                                <ul class="submenu1">
                                                                <div class="expand-triangle"></div>
                                                                <li><span><a href="<?php echo base_url('/report/list_subjects_internal_mark_report/1')?>" class="white">Internal Marks</a></span></li>
                                                                <li><span><a href="<?php echo base_url('/report/list_subjects_endsemester_mark_report/1')?>" class="white">End Semester Marks</a></span></li>
                                                                <li><span><a href="<?php echo base_url('/report/list_subjects_overall_mark_report/1')?>" class="white">Overall Marks</a></span></li>
                                                                
				
                                                            </ul>
                                                        
                                                        <li ><span>M. Tech Bioinformatics</span></li>
                                                        <ul class="submenu">
                                                                <div class="expand-triangle"></div>
                                                                 <li><span><a href="<?php echo base_url('/report/list_subjects_internal_mark_report/2')?>" class="white">Internal Marks</a></span></li>
                                                                <li><span><a href="<?php echo base_url('/report/list_subjects_endsemester_mark_report/2')?>" class="white">End Semester Marks</a></span></li>
                                                                <li><span><a href="<?php echo base_url('/report/list_subjects_overall_mark_report/2')?>" class="white">Overall Marks</a></span></li>
                                                                
				
                                                            </ul>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>
                                        
                              
                                        <!-- Menu End for Teacher Login  -->
                                        
                                        
                                        
                                        
                                        <!-- Menu for DEO Login  -->
                                        <?php  
                                    
                                    elseif ($user_role==4):
                                    
                                    ?>
                                        <li><span><a href="<?php echo base_url('/member/home"')?>" class="white">Home</a></span></li>
                                        <li><span><a href="<?php echo base_url('/student/enroll_students_view/')?>" class="white">Enroll Students</a></span></li>
                                        <li><span>Programs</span></li>
						<ul class="submenu">
							<div class="expand-triangle"></div>
                                                        <li class="chosen"><span><a href="<?php echo base_url('/course/show_subjects_view/1')?>" class="white">M. Sc. - Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/show_subjects_view/2')?>" class="white" >M. Tech - Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/show_subjects_view/3')?>" class="white" >Ph. D - Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/show_subjects_view/4')?>" class="white" >Softcore - Bioinformatics</a></span></li>
						</ul>						
					<li><span>Course Allocation</span></li>
						<ul class="submenu">
							<div class="expand-triangle"></div>
							<li ><span><a href="<?php echo base_url('/course/subjects_allocation_view/1')?>" class="white">M. Sc Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/subjects_allocation_view/2')?>" class="white">M. Tech Bioinformatics</a></span></li>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>
                                       
                                        <li><span>Enroll Semester</span></li>
						<ul class="submenu">
							<div class="expand-triangle"></div>
                                                        <li class="chosen"><span><a href="<?php echo base_url('/student/enroll_semester_view/1')?>" class="white">M. Sc Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/student/enroll_semester_view/2')?>" class="white">M. Tech Bioinformatics</a></span></li>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
                                                        <li ><span>Softcore</span></li>
						</ul>
                                         <li><span>Report</span></li>
						<ul class="submenu active">
							<div class="expand-triangle"></div>
                                                        <li class="chosen"><span><a href="<?php echo base_url('/report/consolidated_reports/1')?>" class="white">M. Sc Bioinformatics</a></span></li>
            
                                                        <li ><span>M. Tech Bioinformatics</span></li>
                                                        
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>
                                        
                                        <!-- Menu End for DEO Login  -->
                                        <?php  
                                    endif;
                                    
                                    ?>
                                        
                                        <li><span><a href="<?php echo base_url('member/user_logout_fn')?>" class="white">Logout</a></span></li>
				</ul>
				<!--back content end-->
           
        </div>
            </div>
           
           
           
          
          

           
        </nav>





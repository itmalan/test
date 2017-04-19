 <div id="viewport">
		<div id="card" >
			<div id="front">
				<!--front content start-->
                                
                                <div class="power"></div>
				<div class="powerdown"></div>
				<!--front content end-->
			</div>
			<div id="back" >

				<!--back content start-->
				<ul class="mainmenu">
                                    <!-- Menu for HOD Login  -->
                                    <?php  
                                    $user_role= $this->session->mms['role']; 
                                    if ($user_role==2):
                                    
                                    ?>
                                    
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/palette.png" alt="Palette icon" class="icon"><span><a href="<?php echo base_url('/member/home"')?>" >Home</a></span></li>
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/palette.png" alt="Palette icon" class="icon"><span><a href="<?php echo base_url('/member/show_users_view"')?>" id="users">Users</a></span></li>
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/palette.png" alt="Palette icon" class="icon"><span>Courses</span></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="<?php echo base_url('assets/retina_menu')?>/images/expand.png"></div>
                                                        <li class="chosen"><span><a href="<?php echo base_url('/course/show_subjects_view/1')?>" >M. Sc Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/show_subjects_view/2')?>" >M. Tech Bioinformatics</a></span></li>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>						
					<li><img src="<?php echo base_url('assets/retina_menu')?>/images/user.png" alt="User icon" class="icon"><span>Course Allocation</span></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="<?php echo base_url('assets/retina_menu')?>/images/expand.png"></div>
							<li ><span><a href="<?php echo base_url('/course/subjects_allocation_view/1')?>" >M. Sc Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/course/subjects_allocation_view/2')?>" >M. Tech Bioinformatics</a></span></li>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>
					<li><img src="<?php echo base_url('assets/retina_menu')?>/images/envelope.png" alt="Envelope icon" class="icon"><span>Results / Marks</span><div class="messages">23</div></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="<?php echo base_url('assets/retina_menu')?>/images/expand.png"></div>
							<li><span>Internals Marks</span></li>
							<li><span>End Semester Marks</span></li>
							<li><span>Sent</span></li>
							<li><span>Trash</span></li>
						</ul>
					<li><img src="<?php echo base_url('assets/retina_menu')?>/images/cog.png" alt="Cog icon" class="icon"><span>Reports</span></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="<?php echo base_url('assets/retina_menu')?>/images/expand.png"></div>
							<li><span>Internal Marks</span></li>
							<li><span>End Semester Marks</span></li>
							<li><span>Grade Result</span></li>
				
						</ul>
                                        
                                        <!-- Menu for HOD Login Ends here  -->
                                    
                                        
                                        
                                        <!-- Menu for Teacher Login  -->
                                        <?php  
                                    
                                    elseif ($user_role==3):
                                    
                                    ?>
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/palette.png" alt="Palette icon" class="icon"><span><a href="<?php echo base_url('/member/home"')?>" >Home</a></span></li>
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/palette.png" alt="Palette icon" class="icon"><span>Courses</span></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="<?php echo base_url('assets/retina_menu')?>/images/expand.png"></div>
                                                        <li class="chosen"><span><a href="<?php echo base_url('/subject/show_subjects_view/1')?>" >M. Sc Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/subject/show_subjects_view/2')?>" >M. Tech Bioinformatics</a></span></li>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/palette.png" alt="Palette icon" class="icon"><span><a href="<?php echo base_url('mark/generate_grade_fn/1"')?>" >Generate Grade</a></span></li>
                                        
                                        <!-- Menu End for Teacher Login  -->
                                        
                                        
                                        
                                        
                                        <!-- Menu for DEO Login  -->
                                        <?php  
                                    
                                    elseif ($user_role==4):
                                    
                                    ?>
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/palette.png" alt="Palette icon" class="icon"><span><a href="<?php echo base_url('/member/home"')?>" >Home</a></span></li>
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/palette.png" alt="Palette icon" class="icon"><span>Students</span></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="<?php echo base_url('assets/retina_menu')?>/images/expand.png"></div>
                                                        <li class="chosen"><span><a href="<?php echo base_url('/student/show_students_view/1')?>" >M. Sc Bioinformatics</a></span></li>
                                                        <li ><span><a href="<?php echo base_url('/student/show_students_view/2')?>" >M. Tech Bioinformatics</a></span></li>
                                                        <li ><span>Ph. D Bioinformatics</span></li>
						</ul>
                                        
                                        <!-- Menu End for DEO Login  -->
                                        <?php  
                                    endif;
                                    
                                    ?>
                                        
                                        <li><img src="<?php echo base_url('assets/retina_menu')?>/images/key.png" alt="Key icon" class="icon"><span><a href="<?php echo base_url('member/user_logout_fn')?>">Logout</a></span></li>
                                        <li class="close-retina"><img src="<?php echo base_url('assets/retina_menu')?>/images/key.png" alt="Key icon" class="icon"><span>Close</span></li>
				</ul>
				<!--back content end-->
			</div>
		</div>
	</div>
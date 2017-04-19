
    
<!-- Bootstrap modal form for adding user -->
<div class="modal fade" id="modal_form_addUser" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_addUser" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Full Name</label>
                            <div class="col-md-9">
                                <input name="first_name" placeholder="Full Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">User / Login Name</label>
                            <div class="col-md-9">
                                <input name="username" placeholder="User Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input name="password" placeholder="" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Role</label>
                            <div class="col-md-9">
                                <select name="role" class="form-control">
                                    <option value="">--Select Role--</option>
                                    <option value="4">DEO</option>
                                    <option value="3">Teacher</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="status" class="form-control">
                                    <option value="">--Select Status--</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactice</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
    
    


    
<!-- Bootstrap modal form for adding Courses -->
<div class="modal fade" id="modal_form_addCourse" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Course Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_addCourse" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Course Title</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Course Title" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Course Code</label>
                            <div class="col-md-9">
                                <input name="course_code" placeholder="Course Code" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
  
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->




    
<!-- Bootstrap modal form for adding Subjects -->
<div class="modal fade" id="modal_form_addSubject" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Subject Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_addSubject" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Subject Title</label>
                            <div class="col-md-9">
                                <input name="subject_title" placeholder="Subject Title" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Course Code</label>
                            <div class="col-md-9">
                                <input name="course_code" placeholder="Course Code" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="control-label col-md-3">Course Credit</label>
                            <div class="col-md-9">
                                <input name="credits" placeholder="Course Credit" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Semester</label>
                            <div class="col-md-9">
                                <input name="semester" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Hardcore / Softcore</label>
                            <div class="col-md-9">
                                <input type="radio" name="core" value="H" checked> Hard Core<br>
                                <input type="radio" name="core" value="S"> Softcore<br>
                                
                            </div>
                        </div>
                        
                        
  
                    </div>
                </form>
                <div id="subjectUploadForm">
                     <?php 
                     $last = $this->uri->total_segments();
                    $course_id = $this->uri->segment($last);
                     echo form_open_multipart('excel_data/excelUpload_addSubjects/'.$course_id);
                     ?>
   
        <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">  
            <!-- image-preview-filename input [CUT FROM HERE]-->
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        Browse
                        <input type="file" accept="" name="userfile"/> <!-- rename it -->
                    </div>
       
                </span>
            </div><!-- /input-group image-preview [TO HERE]--> 
            
        </div>
        <button class="btn btn-primary" type="submit" >Upload</button>

 <?php echo "</form>"?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->










    
<!-- Bootstrap modal form for adding Student -->
<div class="modal fade" id="modal_form_addStudent" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Student Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_addStudent" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Student Name</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Student Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Register Number</label>
                            <div class="col-md-9">
                                <input name="reg_number" placeholder="Register Number" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Year of Joining</label>
                            <div class="col-md-9">
                                <select name="year" class="form-control">
                                    <option value="Select">Select</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Course</label>
                            <div class="col-md-9">
                                <select name="course_id" class="form-control">
                                    <option value="Select">Select</option>
                                    <?php
                                    foreach ($courses as $course){
                                        echo '<option value="'.$course->id.'">'.$course->name.'</option>';
                                    }
                                        
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                       
                        
  
                    </div>
                </form>
                <div id="studentUploadForm">
                     <?php 
                     $last = $this->uri->total_segments();
                $course_id = $this->uri->segment($last);
                     echo form_open_multipart('excel_data/excelUpload_addStudnet_general/');
                     ?>
   
        <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">  
            <!-- image-preview-filename input [CUT FROM HERE]-->
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        Browse
                        <input type="file" accept="" name="userfile"/> <!-- rename it -->
                    </div>
       
                </span>
            </div><!-- /input-group image-preview [TO HERE]--> 
            
        </div>
        <button class="btn btn-primary" type="submit" >Upload</button>

 <?php echo "</form>"?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->






    
<!-- Bootstrap modal form for import marks Student -->
<div class="modal fade" id="modal_form_import_mark" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Student Form</h3>
            </div>
            <div class="modal-body form">
                
                <div id="markstUploadForm">
                     <?php 
                     $last = $this->uri->total_segments();
                $subject_id = $this->uri->segment($last);
                     echo form_open_multipart('excel_data/excelUpload_importMarks/'.$subject_id);
                     ?>
   
        <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">  
            <!-- image-preview-filename input [CUT FROM HERE]-->
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        Browse
                        <input type="file" accept="" name="userfile"/> <!-- rename it -->
                    </div>
       
                </span>
            </div><!-- /input-group image-preview [TO HERE]--> 
            
        </div>
        <button class="btn btn-primary" type="submit" >Upload</button>

 <?php echo "</form>"?>
                    </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->





<!-- Bootstrap modal form for adding softcore subjects Student -->
<div class="modal fade" id="modal_add_remove_Subjects" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add / Remove Softcore Subjects Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_add_remove_Subjects" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <input type="hidden" value="" name="semester"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Student Name</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Student Name" class="form-control" type="text" disabled="true">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Register Number</label>
                            <div class="col-md-9">
                                <input name="reg_number" placeholder="Register Number" class="form-control" type="text" disabled="true">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div id="subjectTable" style="padding:10px;">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Softcore Courses</label>
                            <div class="col-md-9">
                                <select id="softcore_options" name="softcore_subject_id" class="form-control">
                                    <option value="Select">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                       
  
                    </div>
                </form>
      
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->





<!-- Bootstrap modal form for delete -->

<!-- Modal Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Parmanently</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure about this ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDelete_confirmBtn" >Delete</button>
      </div>
    </div>
  </div>
</div>



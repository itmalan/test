

            
            <div id="content-wrapper"> 
            
            <div id="main-content">


                <h3 style="text-align: center">Enroll Students for Semester</h3>
        <br />
        
        <h4 style="text-align: center;"> <?php echo $course_title.' - Semester '. $semester_title1; ?></h4>
       
        <form action="#" id="form_enroll_sem" class="form-horizontal">
                    <input id="course_id" type="hidden" value="<?php echo $course_id; ?>" name="course_id"/> 
                    <input id="semester" type="hidden" value="<?php echo $semester_title1; ?>" name="semester"/> 
               <a class="btn btn-info btn-primary" href="javascript:void(0)" title="Create Semester" onclick='enroll_semester("<?php echo $semester_title1; ?>")'><i class="glyphicon glyphicon glyphicon-list-alt"></i> Create Semester</a>
        </form>
    
        <br/>

        <?php
$template = array(
        'table_open'            => '<table id="studentTable" class="table table-striped table-bordered ui" cellspacing="0" width="100%">',

        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',

        'heading_row_start'     => '<tr>',
        'heading_row_end'       => '</tr>',
        'heading_cell_start'    => '<th>',
        'heading_cell_end'      => '</th>',

        'tbody_open'            => '<tbody>',
        'tbody_close'           => '</tbody>',

        'row_start'             => '<tr>',
        'row_end'               => '</tr>',
        'cell_start'            => '<td>',
        'cell_end'              => '</td>',

        'row_alt_start'         => '<tr>',
        'row_alt_end'           => '</tr>',
        'cell_alt_start'        => '<td>',
        'cell_alt_end'          => '</td>',

        'table_close'           => '</table>'
);

$this->table->set_template($template);
$this->table->set_heading(array('Sl. No','Student Name','Register Number', 'Subjects Allocation'));
echo $this->table->generate($dataset1);

//echo print_r($temp);
        
        ?>
        
        
         <br />
        <br />

        <h4 style="text-align: center;"> <?php echo $course_title.' - Semester '. $semester_title2; ?></h4>
        <form action="#" id="form_enroll_sem" class="form-horizontal">
                    <input id="course_id" type="hidden" value="<?php echo $course_id; ?>" name="course_id"/> 
                    <input id="semester" type="hidden" value="<?php echo $semester_title2; ?>" name="semester"/> 
        <a class="btn btn-info btn-primary" href="javascript:void(0)" title="Create Semester" onclick='enroll_semester("<?php echo $semester_title2; ?>")'><i class="glyphicon glyphicon glyphicon-list-alt"></i> Create Semester</a>
        </form>

        <?php
    $this->table->set_template($template);
$this->table->set_heading(array('Sl. No','Student Name','Register Number', 'Subjects'));
echo $this->table->generate($dataset2);
        ?>

            </div>
            </div>
            


        <?php
$template = array(
        'table_open'            => '<table id="subjectAllocationTable" class="table table-striped table-bordered ui table" cellspacing="0" width="100%">',

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
$this->table->set_heading(array('Subject Title', 'Course Code', 'Credit','Hardcore / Softcore','Faculty<div id="responseMessage" style="float:right;"></div>'));


   


//echo print_r($subjects);
?>


<div id="content-wrapper"> 
            
            <div id="main-content">
                


        <h3 style="text-align: center;">Subject Allocation </h3>
        <h4 style="text-align: center;"> <?php echo $course_title.' - Semester '. $data_set1_sem; ?></h4>
        <br /> 
        <?php echo $this->table->generate($data_set1); 
        
        echo ' <br /><br />';
         echo '<h4 style="text-align: center;">';
         echo $course_title.' - Semester '. $data_set2_sem;
         echo '</h4>   ';
            $this->table->set_template($template);
            $this->table->set_heading(array('Subject Title', 'Course Code', 'Credit','Faculty<div id="responseMessage" style="float:right;"></div>'));
        
            echo $this->table->generate($data_set2); 
   
   ?>
        <?php  //print_r($data_set1); ?>
        <br />
        <br />
        <?php  //echo 'data2: '.print_r($data_set2); ?>
        
        <button class="btn btn-success" onclick="finalize_subject_allocation()"> Finalize</button>
        <div id="responseUpdate" style="float:right;"></div>
            </div>
            </div>
 <?php
 
 ?>









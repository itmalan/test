
<div id="content-wrapper"> 
            
            <div id="main-content">



        <h3>Student Details </h3>
        <br />
        <button class="btn btn-success" onclick="add_student()"><i class="glyphicon glyphicon-plus"></i> Add / Import Students</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
   
        
        <?php
$template = array(
        'table_open'            => '<table id="studentTable" class="table table-striped table-bordered ui table" cellspacing="0" width="100%">',

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
$this->table->set_heading(array('ID','Register Number', 'Student Name'));
echo $this->table->generate($students);

//echo 'result: '.$finalized;

//echo print_r($students);
?>
       
        <button class="btn btn-success" onclick="finalize_student_details()"> Finalized</button>
        <div id="responseUpdate" style="float:right;"></div>
            </div>
            </div>
 <?php  
//echo $this->session->mms['username']; 
 ?>


<script src="<?php echo base_url('assets/custom/jquery.tabledit.js')?>"></script>

<script>
$(document).ready(function() {
    
    var finalized="<?=$finalized ?>";
   if(finalized==0){ 
$('#studentTable').Tabledit({
             "url": "<?php echo site_url('student/update_student_fn')?>",
            
    editButton: false,
    hideIdentifier: true,
    columns: {
        identifier: [0, 'id'],
        editable: [[1, 'reg_number'], [2, 'name']]
        }
});
}

else{
$('#studentTable').Tabledit({
             "url": "<?php echo site_url('student/update_student_fn')?>",
            
    editButton: false,
    hideIdentifier: true,
    columns: {
        identifier: [0, 'id'],
        //editable: [[1, 'reg_number'], [2, 'name']]
        }
});

}



});
  </script>
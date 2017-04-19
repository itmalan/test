
<div id="content-wrapper"> 
            
            <div id="main-content">

<?php
$last = $this->uri->total_segments();
                $subject_id = $this->uri->segment($last);

?>

        <h3>End Semester Marks </h3>
        <div style="float:right">
        Subject: <strong><?php echo $subjects; ?></strong> <br />
        Course Code: <strong><?php echo $course_code; ?></strong>
        <input type="hidden" value="" id="subject_id" name="subject_id"/> 
        </div>
        <br />
        <button class="btn btn-success" onclick="import_mark()"><i class="glyphicon glyphicon-save-file"></i>Import Marks</button>
        
        <ul class="nav navbar-nav pull-right">
                                <li class="active"><a href="<?php echo base_url().'mark/export_excel/'.$subject_id?>"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Export excel</a></li>
                            </ul>  
        
        <br />
        <br />
   
        
        <?php
$template = array(
        'table_open'            => '<table id="externalMarksTable" class="table table-striped table-bordered ui table" cellspacing="0" width="100%">',

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


$this->table->set_heading(array('ID','Sl. No','Register Number','Name of the Student','End Semester Evaluation 1 <br/>/60','End Semester Evaluation 2 <br/>/60','Difference in Evaluations <br/>/15%','End Semester Final Mark <br/>/60'));
echo $this->table->generate($students);

//echo 'result: '.$finalized;

//echo print_r($subjects);
//echo print_r($students);
 
?>
   <button class="btn btn-success" onclick="window.location.reload();"><i class="glyphicon glyphicon glyphicon-saved"></i>Save Changes</button>
            </div>
 <?php  
//echo $this->session->mms['username']; 
  
 ?>

        <br />
        <br />
   
        
  
<script src="<?php echo base_url('assets/edittable/jquery.edittable.min.js')?>"></script>

<script>
    
                
$(document).ready(function() {
       
        
$('#externalMarksTable').Tabledit({
    "url": "<?php echo site_url('mark/inline_update_mark_fn/')?>",
            
    editButton: false,
    deleteButton:false,
    hideIdentifier: true,
    columns: {
        identifier: [0, 'identifier'],
        editable: [ [4,'external1'],[5,'external2']]
        },    
});
    
});

function import_mark()
{
    save_method = 'import_marks';
    $('#form_addStudent')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_import_mark').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add marks'); // Set Title to Bootstrap modal title
}


  </script>

<div id="content-wrapper"> 
            
            <div id="main-content">

<?php
$last = $this->uri->total_segments();
                $subject_id = $this->uri->segment($last);

?>

        <h3>Overall Marks </h3>
        <div style="float:right">
        Subject: <strong><?php echo $subjects; ?></strong> <br />
        Course Code: <strong><?php echo $course_code; ?></strong>
        <input type="hidden" value="" id="subject_id" name="subject_id"/> 
        </div>
        <br />
        
        <ul class="nav navbar-nav pull-right">
                                <li class="active"><a href="<?php echo base_url().'mark/export_excel/'.$subject_id?>"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Export excel</a></li>
                            </ul>  
        
        <br />
        <br />
   
        
        <?php
$template = array(
        'table_open'            => '<table id="overallMarksTable" class="table table-striped table-bordered ui table" cellspacing="0" width="100%">',

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


$mark_title1='Internal Mark1 (Outof / Weightage)</br><input name="internal1_outoff" placeholder="0" type="number" width="50px"/>/<input name="internal1_weightage" placeholder="0" type="number" width="50px">';
$mark_title2='Internal Mark2 (Outof / Weightage)</br><input name="internal2_outoff" placeholder="0" type="number" width="50px"/>/<input name="internal2_weightage" placeholder="0" type="number" width="50px">';
$mark_title3='Internal Mark3 (Outof / Weightage)</br><input name="internal3_outoff" placeholder="0" type="number" width="50px"/>/<input name="internal3_weightage" placeholder="0" type="number" width="50px">';

$this->table->set_heading(array('ID','Sl. No','Register Number','Name of the Student','Internal Mark 1 </br>/15','Internal Mark 2 </br>/15','Other Mark </br>/10','Total Internal Mark</br>/40','End Semester Evaluation 1 <br/>/60','End Semester Evaluation 2 <br/>/60','Difference in Evaluations <br/>/15%','End Semester Final Mark <br/>/60','Total Mark </br> /100','Grade','Result'));
echo $this->table->generate($students);

//echo 'result: '.$finalized;

//echo print_r($subjects);
//echo print_r($students);
 
?>
  <ul class="nav navbar-nav pull-right">
      <button class="btn btn-success" onclick="window.location.reload();"><i class="glyphicon glyphicon glyphicon-saved"></i>Save Changes</button>
      <button class="btn btn-info" onclick="window.location.reload();"><i class="glyphicon glyphicon glyphicon glyphicon-stats"></i>Generate Grade</button>
  </ul>  
        
        <?php
        /*
         * 
         * Grade results
         * 
         * 
         * 
         */
        ?>
         <br /> <br /> <br />
         
            <div class="draw-line"></div>
         
         <div class="grade-area">
      
         <h3>Grades </h3>
        
        <br />
        
        <?php if( isset($max)):echo 'Maximum: '.$max; endif;?>
   <div style="float:right">
       <?php if(isset($K_val)):echo 'K Value: '.$K_val; endif; ?>
</div>
         
        <?php
if(!empty($grades)):
?>
        
        
        <table id="internalMarksTable" class="table grade-table table-striped table-bordered ui" cellspacing="0" width="50%">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Mark Range</th>
                    <th>Grade</th>
                    <th>No. of Students</th>

                </tr>
            </thead>
            <?php
            $no=1;
            foreach($grades as $item){
                echo '<tr>';
                 echo '<td>'.$no++.'</td>';
                echo '<td>'.$item['max'].' - '.$item['min'].'</td>';
                echo '<td>'.$item['grade'].'</td>';
                echo '<td>'.$item['count'].'</td>';
                echo '</tr>';
            }
            ?>
            <tbody>
                
            </tbody>
            
        </table>
        <?php if(isset($message)):echo '<strong>Rule:</strong> '.$message; endif; ?>
    <?php
    endif;
    ?>
        
            </div>
            </div>
</div>

   
   
        
  
<script src="<?php echo base_url('assets/edittable/jquery.edittable.min.js')?>"></script>

<script>
    
                
$(document).ready(function() {
   
$('#overallMarksTable').Tabledit({
    "url": "<?php echo site_url('mark/inline_update_mark_fn/')?>",
            
    editButton: false,
    deleteButton:false,
    hideIdentifier: true,
    columns: {
        identifier: [0, 'identifier'],
        editable: [ [4, 'internal1'],[5,'internal2'],[6,'other'],[8,'external1'],[9,'external2']]
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
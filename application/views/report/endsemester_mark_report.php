
<div id="content-wrapper"> 
            
            <div id="main-content">

<?php
$last = $this->uri->total_segments();
                $subject_id = $this->uri->segment($last);

?>

       
                
            <h3 style="text-align: center;">PONDICHERRY UNIVERSITY</h3>
                 <h4 style="text-align: center;">SCHOOL OF LIFE SCIENCES</h4>
                 <h4 style="text-align: center;">CENTRE FOR BIOINFORMATICS</h4>
                 <br />
                 <h4 style="text-align: center;">End Semester Mark Statement</h4>
                 <h4 style="text-align: center;"><?php echo $program_title .' ['.$period.']'; ?></h4>

        <div style="float:left">
        Subject title: <strong><?php echo $subject_title; ?></strong> <br />
        Subject Code: <strong><?php echo $subject_code; ?></strong>   
                
        <input type="hidden" value="" id="subject_id" name="subject_id"/> 
        </div>
        <br />
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


$this->table->set_heading(array('Sl. No','Register Number','Name of the Student','End Semester Mark 1 <br/>/60','End Semester Mark 2 <br/>/60','End Semester Final Mark <br/>/60'));
echo $this->table->generate($students);

//echo 'result: '.$finalized;

//echo print_r($subjects);
//echo print_r($students);
 
?>
        
                 <br /><br />
                 
                 <table  class="table table-striped table-bordered ui table" cellspacing="0" width="100%" style="text-align: center">
                     <tr>
                         <td><?php echo $hod_name ?> <br />(Centre Head)</td>
                         <td><?php echo $faculty_name; ?> <br />(Faculty In-charge)</td>
                         <td><br />(External Examiner)</td>
                     </tr>
                 </table>

            </div>
 </div>
   
        
 
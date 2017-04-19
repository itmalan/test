
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
                 <h4 style="text-align: center;">Internal Mark Statement</h4>
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
        'table_open'            => '<table id="internalMarksTable" class="table table-striped table-bordered ui table" cellspacing="0" width="100%">',

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


$this->table->set_heading(array('Sl. No','Register Number','Name of the Student','Internal Mark 1 </br>/15','Internal Mark 2 </br>/15','Other Mark </br>/10','Total</br>/40'));
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
                         
                     </tr>
                 </table>
 <?php  
//echo $this->session->mms['username']; 
  
 ?>

        <br />
        <br />
        
        </div>

<div style="float:right;">
  <ul class="nav navbar-nav pull-right">
                                <li class="active"><a href="<?php echo base_url().'report/printpdf/'.$subject_id?>"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Print PDF</a></li>
                            </ul>
    
    
    
        
 
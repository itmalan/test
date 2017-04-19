
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


$this->table->set_heading(array('Sl. No','Register Number','Name of the Student','Internal</br>/40','End Semester</br>/60','Total </br> /100','Grade','Result'));
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
                         <td><br />(VC's Nominee)</td>
                     </tr>
                 </table>
        
        
        <?php
        /*
         * 
         * 
         * 
         * 
         */
        
        
        ?>
        
        
        
        <br/>
        <br/>
        
        <br/>
        <div class="draw-line"></div>
        <br/>
        
        
          <h3 style="text-align: center;">PONDICHERRY UNIVERSITY</h3>
                 <h4 style="text-align: center;">SCHOOL OF LIFE SCIENCES</h4>
                 <h4 style="text-align: center;">CENTRE FOR BIOINFORMATICS</h4>
                 <br />
                 <h4 style="text-align: center;">Grade Range Statement</h4>
                 <h4 style="text-align: center;"><?php echo $program_title .' ['.$period.']'; ?></h4>

        <div style="float:right">
        Subject title: <strong><?php echo $subject_title; ?></strong> <br />
        Subject Code: <strong><?php echo $subject_code; ?></strong>   
        </div>
        <br />
        <div style="float:left">
        <?php if( isset($max)):echo 'Maximum: '.$max; endif;?>
   <?php if(isset($K_val)):echo ' | K Value: '.$K_val; endif; ?>
        </div>

        <?php
if(!empty($grades)):
?>
        
        
        <table id="internalMarksTable" class="table table-striped table-bordered ui" cellspacing="0" width="100%">
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
    <?php
    endif;
    ?>

         <br /><br />
         <table  class="table table-striped table-bordered ui table" cellspacing="0" width="100%" style="text-align: center">
                     <tr>
                         <td><?php echo $hod_name ?> <br />(Centre Head)</td>
                         <td><?php echo $faculty_name; ?> <br />(Faculty In-charge)</td>
                         <td><br />(VC's Nominee)</td>
                     </tr>
                 </table>
        
        
        
        
        
            </div>

         </div>
        
 
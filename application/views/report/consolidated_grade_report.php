
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
                 <h4 style="text-align: center;">Overall Mark Statement</h4>
                  <h4 style="text-align: center;"><?php echo $program_title .' ['.$period.']'; ?></h4>

      
        <table  class="table table-striped table-bordered ui table" cellspacing="0" width="100%">
            <thead>
                <tr>
            <th rowspan="2">Sl.No</th><th rowspan="2">Name</th><th rowspan="2">Register Number</th>
            <?php 
            foreach($subjects as $subject){
                echo '<th colspan=2>'.$subject->course_code.'</th>';
            }
            ?>
            </tr>
            <tr>
                <?php 
            foreach($subjects as $subject){
                echo '<th>Mark </th><th> Grade</th>';
            }
            ?>
            </tr>
            </thead>
            <tbody>
               <?php 
               
               foreach($consolidated_data as $item){
                   echo '<tr>';
                   
                       echo '<td>'.$item[0].'</td>';
                       echo '<td>'.$item[1].'</td>';
                       echo '<td>'.$item[2].'</td>';
                       
                       for($i=3;$i<count($item)-3;$i++){
                       //foreach($item[3] as $val){
                       echo '<td>'.$item[$i]['total'].'</td>';
                       echo '<td>'.$item[$i]['grade'].'</td>';
                       //echo '<td>'.$mark[1].'</td>';
                        }
                   echo '</tr>';
               }
               
            
            ?> 
                
            </tbody>
        </table>
        
        <input type="hidden" value="" id="subject_id" name="subject_id"/> 
      
        <br />
       
        
       
        
        <br />
        <br />
        
         <br /><br />
        
         <div style="float:left">
            <?php echo $hod_name ?>
            <br />
            (Centre Head)
        </div>   
   

         <div style="float:right;">
  <ul class="nav navbar-nav pull-right">
                                <li class="active"><a href="<?php echo base_url().'report/printpdf/'.$subject_id?>"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Print PDF</a></li>
                            </ul>
</div>
    
         
   
            </div>
      </div>
 <?php  
//echo $this->session->mms['username']; 
  
 ?>

        


    
    
        
 
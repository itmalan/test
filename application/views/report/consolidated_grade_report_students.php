
<div id="content-wrapper"> 
            
            <div id="main-content">

<?php
$last = $this->uri->total_segments();
                $subject_id = $this->uri->segment($last);

                
                
             foreach($consolidated_data as $item){
                  
                      
                
?>
                
                  <br />
        <br />
  

                 <h3 style="text-align: center;">PONDICHERRY UNIVERSITY</h3>
                 <h5 style="text-align: center;">Kalapet, Pondicherry -605014</h5>
                 
                 <br />
                 
                  <h4 style="text-align: center;"><?php echo $program_title .' ['.$period.']'; ?></h4>
                  <h4 style="text-align: center;">Student Grade Report</h4>

                  <table  class="table table-striped table-bordered ui table" cellspacing="0" width="100%">
                      <tr>
                          <td>Name of the Candidate <?php echo 'Name: <strong>'.$item[2].'</strong>'; ?></td>
                          <td>Register No.</td>
                      </tr>
                      <tr>
                          <td>School/Dept./ Centre: <strong>CENTRE FOR BIOINFORMATICS</strong></td>
                          <td><?php echo '<strong>'.$item[1].'</strong>'; ?></td>
                      </tr>
                  </table>
                  

      
        <table  class="table table-striped table-bordered ui table" cellspacing="0" width="100%">
            <thead>
                <tr>
            <th>Semester</th><th >Subject / Title</th><th >Credit</th><th >Grade</th><th >Points</th>
            </tr>
            </thead>
            <tbody>
               <?php 
               
               
                       //echo '<td>'.$item[0].'</td>';
                       //echo '<td>'.$item[1].'</td>';
                       //echo '<td>'.$item[2].'</td>';
                       
                       for($i=3;$i<count($item)-3;$i++){
                            echo '<tr>';
                       //foreach($item[3] as $val){
                        echo '<td>'.$item[$i]['semester'].'</td>';
                        echo '<td>'.$item[$i]['course_title'].'</td>';
                       echo '<td>'.$item[$i]['credits'].'</td>';
                       echo '<td>'.$item[$i]['grade'].'</td>';
                        echo '<td>'.$item[$i]['points'].'</td>';
                       //echo '<td>'.$mark[1].'</td>';
                        }
                        echo '</tr>';
            
            ?> 
                
            </tbody>
        </table>
        
        <input type="hidden" value="" id="subject_id" name="subject_id"/> 
      
        <br />
       
        
       <div style="float:left">
            <?php echo $hod_name ?>
            <br />
            (Centre Head)
        </div> 
        
        <br />
        <br />
        
         <br /><br />
        
        <div class="draw-line"></div>
         <?php
          //echo '</tr>';
               }
         ?>
   

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

        


    
    
        
 
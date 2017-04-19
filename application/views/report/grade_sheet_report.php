
<div id="content-wrapper"> 
            
            <div id="main-content">



       <h3 style="text-align: center;">PONDICHERRY UNIVERSITY</h3>
                 <h4 style="text-align: center;">SCHOOL OF LIFE SCIENCES</h4>
                 <h4 style="text-align: center;">CENTRE FOR BIOINFORMATICS</h4>
                 <br />
                 <h4 style="text-align: center;">Grade Range Statement</h4>

        <div style="float:right">
        Subject title: <strong><?php echo $subject_title; ?></strong> <br />
        Subject Code: <strong><?php echo $subject_code; ?></strong>   
        </div>
        <br />
        <div style="float:left">
        <?php echo 'Maximum: '.$max; ?>
   
       <?php echo ' | K Value: '.$K_val; ?>
        </div>
        
        


        <?php
if(!empty($grades)):
?>
        
        
        <table id="internalMarksTable" class="table table-striped table-bordered ui table" cellspacing="0" width="100%">
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
        
         <div style="float:left">
            <?php echo $hod_name ?>
            <br />
            (Centre Head)
        </div>   
        <div style="float:right">
            <?php echo $faculty_name; ?>
            <br />
            (Faculty In-charge)
        </div>  
         
            </div>
</div>

   



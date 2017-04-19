
<div id="content-wrapper"> 
            
            <div id="main-content">



        <h3>Grades </h3>
        
        <br />
        
        <?php echo 'Maximum: '.$max; ?>
   <div style="float:right">
       <?php echo 'K Value: '.$K_val; ?>
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


<script src="<?php echo base_url('assets/edittable/jquery.edittable.min.js')?>"></script>

<script>
   


  </script>
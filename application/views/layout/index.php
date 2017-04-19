<!DOCTYPE html>
<html>
<head>
<!-- my script and syles goes here -->
<?php if($head) echo $head ;?>
<?php if($scripts) echo $scripts ;?>
</head>

<body>
   
     <?php 
          if($this->session->has_userdata('mms'))
          //if($retina_menu) echo $retina_menu ;
          if($basic_menu) echo $basic_menu ;

          ?>     
     <div id="container">
     
          <?php 
          //if(isset($user))
          if($left) echo $left ;

          ?>

         <?php 
          if($this->session->has_userdata('mms'))
         echo '<div id="content-right" class="content-right-moved">';
          else
              echo '<div id="content-right" class="content-right-normal">';
         ?>

 <?php if($header) echo $header ;?>
             
 <?php if($middle) echo $middle; ?>
               
         </div>
        </div>
         

 <?php if($footer) echo $footer ;?>
         
    
     <?php if($modal_forms) echo $modal_forms ;?>
    
    
    <script type="text/javascript">
    BASE_URL = "<?php echo base_url();?>";
</script>

</body>
</html>
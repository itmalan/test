<!DOCTYPE html>
<html>
<head>
<!-- my script and syles goes here -->
<?php if($head) echo $head ;?>

<style>

.table-bordered {
    border: 1px solid #ddd;
}
   
tr:nth-child(even) {background: #CCC}
tr:nth-child(odd) {background: #FFF}
    
</style>

<style type="text/css">
	.table-striped{
		width:100%; 
		border-collapse:collapse; 
	}
	.table-striped td{ 
		border: 1px solid #ddd;
	}
        .table-striped th{ 
		border: 1px solid #ddd;
	}
</style>


</head>

<body>
        
     <div id="container">
     
        <div id="content-right" class="content-right-normal">


 <?php if($middle) echo $middle; ?>
               
         </div>
        </div>
         

</body>
</html>
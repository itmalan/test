

            
            <div id="content-wrapper"> 
            
            <div id="main-content">
<?php 
//echo print_r($this->session->userdata('mms'));
//echo print_r($this->data);

if (isset($dataset1))
{
    
//echo print_r($dataset1);
    foreach ($dataset1 as $subject)
    {
        echo $subject->name.'<br/>';
    }

}

?>

            </div>
            </div>

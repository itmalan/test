
<div id="content-wrapper"> 
            
            <div id="main-content">



        <h3>Allocated Subjects Details </h3>
        <br />
        <br />
   
        
        <?php
$template = array(
        'table_open'            => '<table id="studentTable" class="table table-striped table-bordered ui table" cellspacing="0" width="100%">',

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
$this->table->set_heading(array('Subject Title', 'Course Code','Credits'));
echo $this->table->generate($subjects);

//echo 'result: '.$finalized;

//echo print_r($subjects);
?>
            </div>
            </div>
 <?php  
//echo $this->session->mms['username']; 
 ?>



 


            
            <div id="content-wrapper"> 
            
            <div id="main-content">



        <h3>Subject Details </h3>
        <br />
        <button class="btn btn-success" onclick="add_subject()"><i class="glyphicon glyphicon-plus"></i> Add / Import Subject</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <h4 style="text-align: center;"> <?php echo $course_title; ?></h4>
        <table id="subjectTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Subject Title</th>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Semester</th>
                    <th>Hard core /Soft Core</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                 <th>Subject Title</th>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Semester</th>
                    <th>Hard core /Soft Core</th>

                <th>Action</th>
            </tr>
            </tfoot>
        </table>
<?php
//echo print_r($this->data->course_id);

?>
            </div>
            </div>







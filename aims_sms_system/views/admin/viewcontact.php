<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>dashboard">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Add Contact</a>
            </li>
        </ul>
    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i> Contact Form</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <h3 style="color:green">
                    <?php
                    $msg = $this->session->userdata('message');
                    if (isset($msg)) {
                        echo $msg;
                        $this->session->unset_userdata('message');
                    }
                    ?>
                </h3>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Contact Address</th>

                            <th>Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        foreach ($listdata as $aproduct) {
                            ?>
                            <tr >

                                <td><?php echo $aproduct['contactInfo']; ?></td>

                                <td class="center">

                                    <a class="btn btn-info" href="<?php echo base_url(); ?>dashboard/editcontactlist/<?php echo $aproduct['co_id']; ?>" title="Edit">
                                        <i class="icon-edit icon-white"></i>  

                                    </a>
                                    <a class="btn btn-danger" href="<?php echo base_url(); ?>dashboard/deletecontact/<?php echo $aproduct['co_id']; ?>" title="Delete" onclick="return check_delete();">
                                        <i class="icon-trash icon-white"></i> 

                                    </a>
                                </td>

                            </tr>
    <?php
}
?>

                    </tbody>
                </table>            
            </div>


        </div><!--/span-->

    </div>
</div>
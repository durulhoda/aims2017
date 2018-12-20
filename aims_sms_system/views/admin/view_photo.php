<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>dashboard">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Add Images</a>
        </li>
    </ul>
</div>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i>  Upload Form</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php
                                            $msg=$this->session->userdata('message');
                                            if(isset($msg)){
                                                echo $msg;
                                                $this->session->unset_userdata('message');
                                            }
                                            
                                            ?>
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No</th>
                        <th>Image Category</th> 
                        <th>Image Title</th>  
                        <th>Date</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    $s = 1;
                    foreach ($allphoto as $aproduct) {
                        ?>
                        <tr>
                            <td class="center"><?php echo $s++; ?></td>

                            <td class="center">
                                    <?php echo ($aproduct['category'] == 1) ? "Insert Slider Image" : ""; ?>
                                    <?php echo ($aproduct['category'] == 2) ? "National Events Image" : ""; ?>
                                    <?php echo ($aproduct['category'] == 3) ? "Academic Gallery Image" : ""; ?>
                                    <?php echo ($aproduct['category'] == 4) ? "Others" : ""; ?>
                            </td>
                           
                            <td class="center">
                                <?php echo $aproduct['title']; ?>
                            </td>
                            <td class="center">
                                <?php echo $aproduct['date']; ?>
                            </td>
                            <td class="center"> <img src="<?php echo base_url()."/".$aproduct['image']; ?>" width="130" height="100" class="img-responsive" alt="portfolio"></td>

                            <td class="center">
                                    
                                <a class="btn btn-info" href="<?php echo base_url();?>dashboard/editphoto/<?php echo $aproduct['id']; ?>" title="Edit">
                                    <i class="icon-edit icon-white"></i>  

                                </a>

                                <a class="btn btn-danger" href="<?php echo base_url();?>dashboard/deletephoto/<?php echo $aproduct['id']; ?>" title="Delete" onclick="return check_delete();">
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

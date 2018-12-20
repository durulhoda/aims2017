<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                  
    <div class="page-header">
        <h1>
            Transport
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Add Transport Root
            </small>
        </h1>
    </div><!-- /.page-header -->

<div class="row">
    <?php
    $message = $this->session->userdata('message');
    if (isset($message)) {
        ?>
        <div class="alert alert-block alert-success">
            <i class="ace-icon fa fa-check green"></i>
            <?php
            echo $message;
            $this->session->unset_userdata('message');
            ?>
        </div>
        <?php
    }
    $errormessage = $this->session->userdata('errormessage');
    if (isset($errormessage)) {
        ?>
        <div class="alert alert-block alert-danger">
            <i class="ace-icon fa fa-times red"></i>
            <?php
            echo $errormessage;
            $this->session->unset_userdata('errormessage');
            ?>
        </div>
        <?php
    }
    ?>

    <!-- div.table-responsive -->


        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form  action="<?php echo acc_Url(); ?>/transportroot/inserttransportroot" method="post" class="form-horizontal" role="form">

       
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transport Category : &nbsp; <?php echo form_error('data[categoryId]'); ?></label>

                    <select name="data[categoryId]" class="col-xs-9 col-sm-3" class="form-control">
                          <option value="">Select</option>
                        <?php foreach (getTransportcategoryList() as $values) { ?>
                            <option value="<?php echo $values['categoryId']; ?>" 
                                    <?php echo set_select('data[categoryId]', $values['categoryId'], FALSE) ?>>
                                        <?php echo $values['categoryName']; ?>
                            </option>
                        <?php } ?>
                    </select>  

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transport Name :&nbsp; <?php echo form_error('data[transportId]'); ?></label>

                    <select name="data[transportId]" class="col-xs-9 col-sm-3" class="form-control">
                          <option value="">Select</option>
                                        <?php foreach (getTransportNameList() as $values) { ?>
                                            <option value="<?php echo $values['transportId']; ?>" 
                                                    <?php echo set_select('data[transportId]', $values['transportId'], FALSE) ?>>
                                                        <?php echo $values['transportName']; ?>
                                            </option>
                                        <?php } ?>
                    </select>  

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Transport Root: &nbsp; </label>


                    <input type="text" name="data[transportRoot]"  id="form-field-1" placeholder="Enter Root" class="col-xs-8 col-sm-3" />

                </div>
                
              
 
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" name="submit" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>


                    </div>
                </div>
            </form>

          

      
        <div class="col-xs-12">
          
             <?php
                if(!empty($transportrootlist))
                {
              ?>
            <div class="row">
                <div class="col-xs-12">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <th>Sl No.</th>
                                <th>Transport Category</th>
                                <th>Transport Name</th>  
                                <th>Root Name</th>  
                             
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $sl=1;
                                foreach($transportrootlist as $val)
                                {
                            ?>
                            <tr>
                                <td> <?php echo $sl++; ?></td>
                                <td> <?php if(!empty($val['categoryId'])){ echo gettransportcategoryName($val['categoryId']);}?></td>
                               
                                
                               
                                
                                <td> <?php if(!empty($val['transportId'])){ echo getTransportName($val['transportId']);}?></td>
                                
                                <td> <?php echo $val['transportRoot']; ?></td>

                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                            
                                         <a href="<?php echo acc_Url();?>/transportroot/editTransportRoot/<?php echo $val['rootId']; ?>" class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a>

                                        <a href="<?php echo acc_Url();?>/transportroot/deleteTransportRoot/<?php echo $val['rootId']; ?>" class="btn btn-xs btn-danger">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </a>

                                        
                                    </div>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="<?php echo acc_Url();?>/transportroot/editTransportRoot/<?php echo $val['rootId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo acc_Url();?>/transportroot/deleteTransportRoot/<?php echo $val['rootId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                        <span class="red">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                             <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.span -->
            </div><!-- /.row -->
             <?php
               }
           ?>
        </div><!-- /.col-x12 -->
          </div><!-- /.col-x12 -->
    </div> <!-- /.row --> 








    

    
    
    
    
    

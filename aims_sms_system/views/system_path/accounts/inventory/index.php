<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                   
    <div class="page-header">
        <h1>
            Inventory
            <small class="red">
                <i class="ace-icon fa fa-angle-double-right"></i>
               Add Category
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
                                                                <form  action="<?php echo acc_Url(); ?>/inventory/insertcategory" method="post" class="form-horizontal" role="form">
                                                                <div class="col-xs-10 col-sm-2"></div>
									<div class="col-xs-8 col-sm-5">
                                                                            <label class="control-label" for="form-field-1"> Add Category : &nbsp; </label>

										
											<input class="form-control" type="text" name="data[categoryName]"  id="form-field-1" placeholder="Enter Category"  />
										
									</div>
                                                                    
                                                           
                                                                    <div class="col-xs-12">
									<div class="clearfix form-actions">
										<div class="col-md-12">
											<button class="btn btn-info" name="submit" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											
										</div>
									</div>
                                                                        </div>
                                                        </form>
                                                                
                                                    <?php
        // if(!empty($bookselflist))
         {
       ?>
            <div class="row">
                <div class="col-xs-11">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                                <th>Sl No.</th>
                                <th>Book Self Name</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>

                        <tbody>
                            
                            <?php
                                $sl=1;
                                foreach($itemcategorylist as $val)
                                {
                            ?>
                            <tr>
                                <td> <?php echo $sl++; ?></td>
                                <td> <?php echo $val['categoryName'] ?></td>
                                
                             

                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                        
                                        <a href="<?php echo acc_Url();?>/inventory/edititemcategory/<?php echo $val['categoryId']; ?>"  class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a>

                                        <a href="<?php echo acc_Url();?>/inventory/deleteitemcategory/<?php echo $val['categoryId']; ?>" class="btn btn-xs btn-danger">
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
                                                    <a href="<?php echo acc_Url();?>/inventory/edititemcategory/<?php echo $val['categoryId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo acc_Url();?>/inventory/deleteitemcategory/<?php echo $val['categoryId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
    </div> <!-- /.row --> 
    

    
    
    
    
    
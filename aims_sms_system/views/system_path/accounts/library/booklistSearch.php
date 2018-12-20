<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                     
<div class="page-header">
    <h1> 
      Book List Search 
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

          
           			<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                                                <form  action="<?php echo acc_Url(); ?>/book/allbooklist" method="post" class="form-horizontal" role="form">
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Category : &nbsp; </label>
                                                                                                                                                <?php echo form_error('data[bookCategory]', '<div style="color: rgb(255, 0, 0);" class="successMessage">', '</div>'); ?>
                                                                        <select name="data[bookCategory]" class="col-xs-6 col-sm-2">
                                                                            <option value="" selected>Select</option>
                                                                            <?php foreach (getBookCategoryArray() as $value) { ?>
                                                                                <option value="<?php echo $value['bookCategoryName'] ?>"><?php echo $value['bookCategoryName'] ?></option>
                                                                            <?php } ?>
                                                                        </select> 

                                                                    </div>
                                   
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Name : &nbsp; </label>
                                                                         <?php echo form_error('data[bookName]', '<div style="color: rgb(255, 0, 0);" class="successMessage">', '</div>'); ?>

                                                                        <select name="data[bookName]" class="col-xs-6 col-sm-2">
                                                                            <option value="" >Select</option>
                                                                            <?php foreach (getBookArray() as $value) { ?>
                                                                                <option value="<?php echo $value['bookName'] ?>">
                                                                                    <?php echo $value['bookName'] ?></option>
                                                                            <?php } ?>
                                                                        </select>  

                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Writer : &nbsp; </label>
                                                                        <?php echo form_error('data[bookauthor]', '<div style="color: rgb(255, 0, 0);" class="successMessage">', '</div>'); ?>
                                                                        <select name="data[bookauthor]" class="col-xs-6 col-sm-2">
                                                                            <option value="" selected>Select</option>
                                                                            <?php foreach (getBookwriterArray() as $value) { ?>
                                                                                <option value="<?php echo $value['bookauthor'] ?>"><?php echo $value['bookauthor'] ?></option>
                                                                            <?php } ?>
                                                                        </select>  
                                                                    </div>
									                                                  
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" name="submit" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Search
											</button>

											
										</div>
									</div>
                                                        </form>
                                                               
                                                                             
                                                    <?php
         if(!empty($booklist))
         {
       ?>
            <div class="row">
                <div class="col-xs-11">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                                
                            <th >Sl No.</th>
                            <th>Book Name</th>
                            <th>Book Writer</th>
                            <th>Book Category</th>
                            <th>Self Location</th>
                            <th>Book Price</th>
                            <th>Date of Buy</th>
                            <th>Book Piece</th>
                            <th>Book Status</th>
                            <th>Actions</th>
                                
                                                             
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            <?php
                                $sl=1;
                                foreach($booklist as $val)
                                {
                            ?>
                            <tr>
                                <td> <?php echo $sl++; ?></td>
                                <td> <?php echo $val['bookName'] ?></td>
                                <td>  <?php echo $val['bookauthor'] ?></td>
                                <td>  <?php echo $val['bookCategory'] ?></td>
                                
                                 <td>
                                        <?php
                                                foreach (getSelfStatus($value['bookCategory']) as $aspppps) {
                                                     echo getSelfNames($aspppps['selfId']). ", ";
                                                }
                                                ?>
                                       
                           </td>
                                <td>  <?php echo $val['bookprice']; ?></td>
                                <td>  <?php echo $val['bookbuydate']; ?></td>
                                <td>  <?php echo $val['bookPiece']; ?></td>
                                
                                <td> 
                                
                                  <?php
                                            $a = (int) $val['bookPiece'];
                                            $b = (int) $val['bookId'];
                                            $count = $a - $b;
                                            echo ($val['bookavailable'] == 1) ? "Available" : "Unavailable";
                                            echo " (" . $count . " piece)"
                                            ?>
                                </td>
                             

                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                        
                                        <a href="<?php echo acc_Url();?>/book/editbook/<?php echo $val['bookId']; ?>"  class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </a>

                                        <a href="<?php echo acc_Url();?>/book/deletebook/<?php echo $val['bookId']; ?>" class="btn btn-xs btn-danger">
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
                                                    <a href="<?php echo acc_Url();?>/book/editbook/<?php echo $val['bookId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo acc_Url();?>/book/deletebook/<?php echo $val['bookId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
    

    
    
    
    
    

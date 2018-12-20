<div class="page-content"> 
    <div style="margin-top: 20px; padding: 3.5px;"> 
    <!-- /Content Section  -->                    
<div class="page-header">
    <h1> 
      
Borrowed Book's Information
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
                                                                <form  action="<?php echo acc_Url(); ?>/bookborrow/allbookborrowlist" method="post" class="form-horizontal" role="form">
                                                                
									<div class="form-group">
                                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Name : &nbsp; </label>
                                                                            <select name="data[bookId]" class="col-xs-9 col-sm-3">
                                                                                <option value="" >Select</option>
                                                                                <?php foreach (getBookArray() as $value) { ?>
                                                                                    <option value="<?php echo $value['bookId'] ?>">
                                                                                        <?php echo $value['bookName'] ?></option>
                                                                                <?php } ?>
                                                                            </select> 					
									</div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="form-field-1"> Student Id : &nbsp; </label>

                                                                        <input type="text" name="data[studentId]"  id="form-field-1" placeholder="Student Id" class="col-xs-8 col-sm-5" />

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
                                                                
                                                                
                                                                 <?php
            if (!empty($bookborrowlist)) {
                ?>
                <div class="row">
                    <div class="col-xs-11">
                        <table id="simple-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                
                                    <th>Sl No.</th>
                                    <th>Book Name</th>
                                    <th>Student Id</th>
                                    <th>Date of Borrow</th>
                                    <th>Date of Return</th>
                                    <th>Action</th>
                                    


                                    
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sl = 1;
                                foreach ($bookborrowlist as $val) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl++; ?></td>
                                        <td><?php echo getBookNames($val['bookId'])?></td>
                                        <td><?php echo $val['studentId']?> </td>
                                        <td> <?php echo $val['borrowedDate']?></td>
                                        <td><?php echo $val['returnDate'];?></td>
                                        



                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="<?php echo acc_Url(); ?>/bookborrow/editborrowedbook/<?php echo $val['borrowbookId']; ?>"  class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                <a href="<?php echo acc_Url(); ?>/bookborrow/deleteborrowedbook/<?php echo $val['borrowbookId']; ?>" class="btn btn-xs btn-danger">
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
                                                            <a href="<?php echo acc_Url(); ?>/bookborrow/editborrowedbook/<?php echo $val['borrowbookId']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo acc_Url(); ?>/bookborrow/deleteborrowedbook/<?php echo $val['borrowbookId']; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
    

    
    
    
    
    

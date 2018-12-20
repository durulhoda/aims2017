<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Mark Distribution
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
            Distribution Marks
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
        <div class="col-sm-5">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title smaller">
                        <i class="menu-icon fa fa-list-alt"></i>&nbsp;
                        Distribute Subject Information
                    </h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">




                        <div class="row">
                            <div class="col-xs-14">

                                <blockquote class="pull-left">


                                    <span class="green">

                                        Subject:
                                        <?php
                                        if (!empty($courseofferlist['courseName'])) {
                                            echo $courseofferlist['courseName'];
                                        }
                                        ?>

                                    </span>

                                    <small>  
                                        Category Name:
                                        <cite class="lighter red"> 

                                            <?php
                                                if (!empty($courseofferlist['categoryName'])) {
                                                    echo element($courseofferlist['categoryName'],getSubjectcategory(),Null);
                                                }
                                          
                                            ?> 

                                        </cite>                                    
                                    </small>


                                    <small>  
                                        Full Marks:
                                        <cite class="lighter red full_mark"> 

                                            <?php
                                            if (!empty($courseofferlist['marks'])) {
                                                echo $courseofferlist['marks'];
                                            }
                                            ?>

                                        </cite>                                    
                                    </small>


                                </blockquote>





                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-7">       

            <div class="row">
                <div class="col-xs-12">


                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="ace-icon fa fa-external-link"></i>
                                Distribute Marks
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main row ">



                                <form class="form-horizontal distribute_table" role="form" action="<?php echo admin_Url(); ?>/courseoffer/insertdvdmark" enctype="multipart/form-data" method="post" autocomplete="off">
                                <input type="hidden" name="full_mark" value="<?php echo isset($courseofferlist['marks']) ? $courseofferlist['marks'] : 0; ?>">
                                <div class="col-xs-12" style="overflow: hidden;">
                                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                                    <?php
                                                    foreach ($markcategorylist as $val) {
                                                        ?>
                                                <tr> 
                                                    <th> <?php
                                                    if (!empty($val['category_title'])) {
                                                        echo $val['category_title'];
                                                    }
                                                    ?>
                                                        <input type="hidden" name="dvd_mark_id[]" value="<?php echo $val['mark_cat_id']?>" >
                                                    </th>

                                                    <th><input type="text" id="<?php echo $val['category_title']."_w";  ?>" class="mark" name="dvd_mark[]" placeholder="Write Marks"></th>
                                                    <th><input type="text" name="mark_percent[]" class="percent" id="<?php echo $val['category_title']."_p";  ?>" placeholder="Enter Percentage Mark"  /> </th>
                                                    <th><input type="text" name="orginal_mark[]" class="orginal_mark" readonly="" style="width: 100px;"></th>

                                                </tr>
                                            </thead>
    <?php
}
?>
                                            <tbody>
                                                <td>&nbsp;</td>
                                                <td>
                                                   
                                                        <input type="hidden" name="offerId" value="<?php echo $courseofferlist['offerId']?>" >
                                                       <button class="btn btn-success" type="submit" name="btnSubmit"> Divide Marks </button>
                                                 
                                                </td>
                                                <td>
                                                    Full Marks: <input type="text" readonly="" name="full_obmarks" id="total"/>
                                                </td>
                                                <td>&nbsp;</td>
                                            </tbody>    
                                    </table>
                                </div><!-- /.span -->
                                </form>

                            </div>

                        </div>

                    </div>



                </div>
            </div>
        </div>

        
    <script type="text/javascript">
    function getCalMark(mark = 0, percent = 0)
    {
        if (isNaN(mark)) {
            var mark = 0;
        }
        if (isNaN(percent)) {
            var percent = 0;
        }

        var cal = ((mark * percent) / 100);
        return cal;
    }

    function total()
    {
        var full_mark = parseFloat($('.full_mark').text());
        if (isNaN(full_mark)) {
            var full_mark = 0;
        }
        var sum_mark = 0;
        $('tr').find('.orginal_mark').each(function () {
           var or = parseFloat($(this).val());
            if (!isNaN(or) && or.length !== 0) {
             sum_mark += parseFloat(or);
         }
        });
        if (full_mark < sum_mark) {
            alert("Full Mark Overload!!");
           // return false;
        }
        $('#total').val(sum_mark);
    }
    $(document).on('keyup','.mark, .percent', function(){
        $this = $(this).closest('tr');
        cr_id = $this.find('.mark').attr('id');
        pr_id = $this.find('.percent').attr('id');

        var cr_mark = parseFloat($this.find('#'+cr_id).val());
        var cr_percent = parseFloat($this.find('#'+pr_id).val());

        var cal = parseFloat(getCalMark(cr_mark, cr_percent)).toFixed(2);
        if (!cal || cal == 0) {
            var cal = '';
        }
        $this.find('.orginal_mark').val(cal);
        total();
    });

    </script>
</div>

</div><!-- PAGE CONTENT ENDS -->




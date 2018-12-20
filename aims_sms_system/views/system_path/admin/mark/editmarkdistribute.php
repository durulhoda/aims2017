<!-- /Content Section  -->                    
<div class="page-header">
    <h1>
        Mark Distribution
        <small class="red">
            <i class="ace-icon fa fa-angle-double-right"></i>
          Edit Distribution Marks
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
                                        Obtain Marks:
                                        <cite class="lighter red full_mark"> 

                                            <?php
                                            if (!empty($courseofferlist['marks'])) {
                                                echo $courseofferlist['marks'];
                                            }
                                            ?>

                                        </cite>                                    
                                    </small>
                                    <p style="color:red; font-size: 14px; border: 1px solid #eee; padding: 5px;">
                                    Current Divide Marks <br>

                                    <?php
                                    if (!empty($editData)) {
                                        $ex_pld = explode(",", trim($editData['mark_cat_id']));
                                        $ex_pld_dvd = explode(",", trim($editData['divide_mark']));
                                        for ($ck_val = 1; $ck_val < count($ex_pld) - 1; $ck_val++) {
                                            $mrk_string = getMarkTitle($ex_pld[$ck_val]);
                                            echo $category_mark = substr($mrk_string, 0, 13) . " - " . $ex_pld_dvd[$ck_val] . " ";
                                        }
                                    }
                                    ?>
                                    </p>
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



                                <form class="form-horizontal" role="form" action="<?php echo admin_Url(); ?>/courseoffer/insertdvdmark" enctype="multipart/form-data" method="post" autocomplete="off">
                                <div class="col-xs-12">
                                <input type="hidden" name="full_mark" value="<?php echo isset($courseofferlist['marks']) ? $courseofferlist['marks'] : 0; ?>">
                                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                                    <?php
                                                    $total_mark = 0;                                                     foreach ($markcategorylist as $key =>$val) {
                                                        $mark = isset($distribute_mark[$val['mark_cat_id']]['mark']) ? $distribute_mark[$val['mark_cat_id']]['mark'] : '';
                                                        $percent = isset($distribute_mark[$val['mark_cat_id']]['percent']) ? $distribute_mark[$val['mark_cat_id']]['percent'] : '';
                                                        $orginal_mark = (($mark * $percent) / 100);
                                                        $total_mark += $orginal_mark;
                                                        $orginal_mark = isset($distribute_mark[$val['mark_cat_id']]['percent']) ? $orginal_mark : '';
                                                        ?>
                                                <tr> 
                                                    <th> <?php
                                                    if (!empty($val['category_title'])) {
                                                        echo $val['category_title'];
                                                    }
                                                    ?>
                                     
                                     
                                                        
                                                        <input type="hidden" name="dvd_mark_id[]" value="<?php echo $val['mark_cat_id']?>" >
                                                    </th>
                                                    <th>
                                                    <input type="text" value="<?php echo $mark; ?>" id="<?php echo $val['category_title']."_w";  ?>" class="mark" name="dvd_mark[]" placeholder="Write Marks"></th>
                                                
                                                    <th><input type="text" id="<?php echo $val['category_title']."_p";  ?>" value="<?php echo $percent; ?>" class="percent" name="mark_percent[]" placeholder="Enter Percentage Mark"  />
                                                    </th>
                                                    <th><input type="text" name="orginal_mark[]" class="orginal_mark" value="<?php echo $orginal_mark; ?> " readonly="" style="width: 100px;"></th>

                                                </tr>
                                            </thead>
    <?php
                                                       // }
}
?>
                                            <tbody>
                                                <td>&nbsp;</td>
                                                <td>
                                                        <input type="hidden" name="offerId" value="<?php echo $courseofferlist['offerId']?>" >
                                                       <button class="btn btn-success" type="submit" name="btnSubmit"> Divide Marks </button>
                                                 
                                                </td>
                                                <td>
                                                    Divide Mark: <input type="text" readonly="" value="<?php echo $total_mark; ?>" name="full_obmarks" id="total"/>
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
            //return false;
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




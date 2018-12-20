<!-- /Content Section  -->
<div class="page-header">
    <h1>
        Summary Result Percentage List
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


    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th rowspan="3" style="width: 45%;">Class Information</th>
                <th colspan="2">Exam & Percentage</th>
                <th rowspan="3">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach($exam as $key=>$item)
            {
                $count = count($item['semester']);
            ?>
                <tr>
                    <td style="text-align: center;vertical-align: middle;" rowspan="<?php echo $count;?>"><?php echo get_class_info($key);?></td>
                    <?php
                    foreach($item['semester'] as $index=>$value)
                    {
                        if($index==0)
                        {
                        ?>
                            <td><?php echo $value;?></td>
                            <td><?php echo $item['percentage_value'][$index];?></td>
                        <?php
                        }
                    }
                    ?>
                    <td rowspan="<?php echo $count;?>" style="text-align: center;vertical-align: middle;">
                        <a href="<?php echo admin_Url();?>/setsummarypercentage/editpercentage/<?php echo $key;?>"><span style="cursor: pointer; padding: 5px;"><i style="color: green;" class="fa fa-edit fa-lg"></i></span></a>
                        <a href="<?php echo admin_Url();?>/setsummarypercentage/deletepercentage/<?php echo $key;?>"><span style="cursor: pointer; padding: 5px;"><i style="color: #a7030e;" class="fa fa-trash fa-lg"></i></span></a>
                    </td>
                </tr>
                <?php
                foreach($item['semester'] as $index=>$value)
                {
                    if($index>0)
                    {
                ?>
                        <tr>
                            <td><?php echo $value;?></td>
                            <td><?php echo $item['percentage_value'][$index];?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            <?php
            }
            ?>
        </tbody>
    </table>





</div> <!-- /.row -->


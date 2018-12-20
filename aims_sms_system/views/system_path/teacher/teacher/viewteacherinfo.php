<!-- Right Side/Main Content Start -->

<div id="rightside">       

    <!-- Alternative Content Box End -->

    <div class="contentcontainer lar left">
        <div class="headings altheading">
            <h2>Teacher Information</h2>
            <?php
            $message = $this->session->userdata('message');
            if (isset($message)) {
                echo "<span id='messagefail'>" . $message . "</span>";
                $this->session->unset_userdata('message');
            }
            ?>
        </div>

        <div class="contentbox">           

            <div id="tabs">

                <?php
                $username = $this->session->userdata('userName');
                ?>

                <span style="float: left; width: 100%; margin:0px 0 20px;">
                    <button onclick="window.location.href = '<?php echo teacher_Url(); ?>/teacher/profile'" style="margin-left: 5px;width: 33%; float: left; padding: 3px;" type="button">View Profile</button>
                    <button onclick="window.location.href = '<?php echo teacher_Url(); ?>/teacher/editteacher/<?php echo $username; ?>'" style="width: 33%; float: left; padding: 3px;" type="button">Edit Profile</button>
                    <button onclick="window.location.href = '<?php echo teacher_Url() ?>/teacher/changepassword'" style="width: 33%; float: left; padding: 3px;" type="button" >Change Password</button>
                </span>

                <div id="tabs-1">
                    <?php // print_r($editData); ?>
                    <fieldset>

                        <legend>Personal Information</legend>
                        <div class="profilehead">
                            <img src="<?php echo base_url() . "uploads/Employee/" . $editData['photo'] ?>" width="150" height="160">

                            <div class="profileusername">
                                <h2> <?php echo $editData["firstName"] . " " . $editData["lastName"]; ?> </h2>
                                Id : <?php echo $editData["employeeId"]; ?>
                            </div>

                        </div>
                        <div class="profiletable">

                            <table>  
                                <tr>        

                                    <td class="lefttd"> Father Name :</td>
                                    <td class="righttd">
                                        <?php echo $editData["fatherName"]; ?>
                                    </td>
                                </tr>
                                <tr>        

                                    <td class="lefttd"> Mother Name :</td>
                                    <td class="righttd">
                                        <?php echo $editData["motherName"]; ?>
                                    </td>
                                </tr>
                                <tr>        

                                    <td class="lefttd"> Marital Status :</td>
                                    <td class="righttd">
                                        <?php echo ($editData["maritialStatus"] == '1') ? "Unmarried" : ""; ?>
                                        <?php echo ($editData["maritialStatus"] == '2') ? "Married" : ""; ?>
                                        <?php echo ($editData["maritialStatus"] == '3') ? "Widow" : ""; ?>
                                        <?php echo ($editData["maritialStatus"] == '4') ? "Divorced" : ""; ?>

                                    </td>
                                </tr>
                                <tr>        

                                    <td class="lefttd"> Nationality :</td>
                                    <td class="righttd">
                                        <?php echo $editData["nationality"]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lefttd"> Blood Group :</td>

                                    <td class="righttd">
                                        <?php echo form_error('data[bloodGroup]', '<div class="successMessage">', '</div>'); ?>

                                        <?php
                                        foreach (getBloodGroup() as $key => $value) {
                                            if ($editData["bloodGroup"] == $key) {
                                                echo $value;
                                            }
                                        }
                                        ?>  

                                    </td>
                                </tr>
                                <tr>
                                    <td class="lefttd"> National ID :</td>
                                    <td class="righttd">
<?php echo $editData["nationalIdentity"]; ?>

                                    </td>
                                </tr>
                                <tr>   
                                    <td class="lefttd"> Birth Registration :</td>
                                    <td class="righttd">
<?php echo $editData["embreg"]; ?>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </fieldset>

<?php // print_r($editData); ?>
                    <fieldset>
                        <legend>Previous Education Details</legend>

                        <div class="profiletable">         
                            <table>
                                <th>Program </th>
                                <th>Discipline </th>
                                <th> Grade </th>
                                <th>Passing Year</th>
                                <th>Board/Institution</th>
                                
                                <?php
                                     
                                        if(!empty($editData['degree1'])){
                                    ?>
                                <tr > 
                                    <td>
<?php
//            print_r($editData["programone"]); exit; 
$editDatas = explode(",", trim($editData["degree1"]));
?>
                                        <?php echo $editDatas[1]; ?>                               
                                    </td>
                                    <td> 
                                        <?php echo $editDatas[2]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[3]; ?>
                                    </td> 
                                    <td>
                                        <?php echo $editDatas[4]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[5]; ?>
                                    </td>
                                </tr>

                                <?php
                                        }
                                        if(!empty($editData['degree2'])){
                                    ?>
                                <tr > 
                                    <td>
<?php
//            print_r($editData["programone"]); exit; 
$editDatas = explode(",", trim($editData["degree2"]));
?>
                                        <?php echo $editDatas[1]; ?>                               
                                    </td>
                                    <td> 
                                        <?php echo $editDatas[2]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[3]; ?>
                                    </td> 
                                    <td>
                                        <?php echo $editDatas[4]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[5]; ?>
                                    </td>
                                </tr>
                                
                                <?php
                                        }
                                        if(!empty($editData['degree3'])){
                                    ?>
                                <tr > 
                                    <td>
<?php
//            print_r($editData["programone"]); exit; 
$editDatas = explode(",", trim($editData["degree3"]));
?>
                                        <?php echo $editDatas[1]; ?>                               
                                    </td>
                                    <td> 
                                        <?php echo $editDatas[2]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[3]; ?>
                                    </td> 
                                    <td>
                                        <?php echo $editDatas[4]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[5]; ?>
                                    </td>
                                </tr>
                                
                                <?php
                                        }
                                        if(!empty($editData['degree4'])){
                                    ?>
                                
                                <tr > 
                                    <td>
<?php
//            print_r($editData["programone"]); exit; 
$editDatas = explode(",", trim($editData["degree4"]));
?>
                                        <?php echo $editDatas[1]; ?>                               
                                    </td>
                                    <td> 
                                        <?php echo $editDatas[2]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[3]; ?>
                                    </td> 
                                    <td>
                                        <?php echo $editDatas[4]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[5]; ?>
                                    </td>
                                </tr>
                                
                            <?php
                                        }
                                        if(!empty($editData['degree5'])){
                                    ?>    
                                 <tr > 
                                    <td>
<?php
//            print_r($editData["programone"]); exit; 
$editDatas = explode(",", trim($editData["degree5"]));
?>
                                        <?php echo $editDatas[1]; ?>                               
                                    </td>
                                    <td> 
                                        <?php echo $editDatas[2]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[3]; ?>
                                    </td> 
                                    <td>
                                        <?php echo $editDatas[4]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[5]; ?>
                                    </td>
                                </tr>
                             
                                <?php
                                        }
                                        if(!empty($editData['degree6'])){
                                    ?>
                                 <tr > 
                                    <td>
<?php
//            print_r($editData["programone"]); exit; 
$editDatas = explode(",", trim($editData["degree6"]));
?>
                                        <?php echo $editDatas[1]; ?>                               
                                    </td>
                                    <td> 
                                        <?php echo $editDatas[2]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[3]; ?>
                                    </td> 
                                    <td>
                                        <?php echo $editDatas[4]; ?>
                                    </td>
                                    <td>
                                        <?php echo $editDatas[5]; ?>
                                    </td>
                                </tr>
                                <?php
                                        }
                                     ?>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Contact Information</legend>
                        <div class="profiletable">
                            <table>
                                <tr>
                                    <td class="lefttd"> Phone :</td>
                                    <td>
<?php echo $editData["phone"]; ?>
                                    </td>
                                </tr>
                                <tr>     
                                    <td class="lefttd"> Email :</td>
                                    <td>
<?php echo $editData["email"]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lefttd"> Address :</td>

                                    <td>
<?php echo $editData["address"]; ?>
                                    </td>        
                                </tr>

                            </table>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Employment Information</legend>
                        <div class="profiletable">
                            <table>
                                <tr>
                                    <td class="lefttd">  Department : </td>
                                    <td class="righttd">

                                            <?php if (!empty($editData['departmentId'])) {
                                                echo getDepartmentName($editData['departmentId']);
                                            } ?>

                                    </td>
                                </tr>
                                <tr>     
                                    <td class="lefttd">  Designation :</td>
                                    <td class="righttd">

                                        <?php echo form_error('data[designation]', '<div class="successMessage">', '</div>'); ?>

                                        <?php
                                        
                                            if(!empty($editData["designation"])) {
                                                echo $editData["designation"];
                                            }
                                        
                                        ?>  


                                    </td>
                                </tr>
                                <tr>
                                    <td class="lefttd">  Employee Type : </td>
                                    <td class="righttd">
<?php echo form_error('data[employeeType]', '<div class="successMessage">', '</div>'); ?>
<?php
foreach (getemployeetypeList() as $key => $value) {
    if ($editData["employeeType"] == $key) {
        echo $value;
    }
}
?>  
                                    </td>
                                </tr>
                                <tr>    
                                    <td class="lefttd">  Employment Status : </td>
                                    <td class="righttd">
<?php echo form_error('data[employmentStatus]', '<div class="successMessage">', '</div>'); ?>
<?php
foreach (getemployeestatusList() as $key => $value) {
    if ($editData["employmentStatus"] == $key) {
        echo $value;
    }
}
?>  
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lefttd">  Index No : </td>
                                    <td class="righttd">

                                            <?php if (!empty($editData['indexno'])) {
                                                echo ($editData['indexno']);
                                            } ?>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </fieldset>


                    <br>
                    <fieldset>
                        <legend>Login & User Information</legend>

                        <div class="profiletable">     
                            <table>

                                <tr>
                                    <td class="lefttd"> HR (Admin) : </td>
                                    <td class="righttd">
<?php echo form_error('data[hrAdmin]', '<div class="successMessage">', '</div>'); ?>
<?php
foreach (gethrList() as $key => $value) {
    if ($editData["hrAdmin"] == $key) {
        echo $value;
    }
}
?>  



                                    </td>
                                </tr>
                                <tr>    
                                    <td class="lefttd"> Academic : </td>
                                    <td class="righttd">
                                        <?php echo form_error('data[academic]', '<div class="successMessage">', '</div>'); ?>
<?php
foreach (gethrList() as $key => $value) {
    if ($editData["academic"] == $key) {
        echo $value;
    }
}
?>  


                                    </td>
                                </tr>
                                <tr>     
                                    <td class="lefttd"> Academic(Admin) : </td>
                                    <td class="righttd">
                                        <?php echo form_error('data[academicAdmin]', '<div class="successMessage">', '</div>'); ?>
                                        <?php
                                        foreach (gethrList() as $key => $value) {
                                            if ($editData["academicAdmin"] == $key) {
                                                echo $value;
                                            }
                                        }
                                        ?>  



                                    </td>
                                </tr>
                                <tr>
                                    <td class="lefttd"> Finance : </td>
                                    <td class="righttd">
                                        <?php echo form_error('data[finance]', '<div class="successMessage">', '</div>'); ?>
                                        <?php
                                        foreach (gethrList() as $key => $value) {
                                            if ($editData["finance"] == $key) {
                                                echo $value;
                                            }
                                        }
                                        ?>  


                                    </td>
                                </tr>
                                <tr>     
                                    <td class="lefttd"> Finance(Admin) : </td>
                                    <td class="righttd">
                                        <?php echo form_error('data[financeAdmin]', '<div class="successMessage">', '</div>'); ?>
                                        <?php
                                        foreach (gethrList() as $key => $value) {
                                            if ($editData["financeAdmin"] == $key) {
                                                echo $value;
                                            }
                                        }
                                        ?>  



                                    </td>
                                </tr>
                                <tr>    
                                    <td class="lefttd"> Admission & Result : </td>
                                    <td class="righttd">
                                        <?php echo form_error('data[admissionAndResult]', '<div class="successMessage">', '</div>'); ?>
                                        <?php
                                        foreach (gethrList() as $key => $value) {
                                            if ($editData["admissionAndResult"] == $key) {
                                                echo $value;
                                            }
                                        }
                                        ?>  

                                    </td>
                                </tr>
                                <tr>
                                    <td class="lefttd"> Admission & Result(Admin) :</td>
                                    <td class="righttd">
<?php echo form_error('data[admissionAndResultAdmin]', '<div class="successMessage">', '</div>'); ?>
<?php
foreach (gethrList() as $key => $value) {
    if ($editData["admissionAndResultAdmin"] == $key) {
        echo $value;
    }
}
?>  


                                    </td>
                                </tr>
                                <tr>     
                                    <td class="lefttd"> HR : </td>
                                    <td class="righttd">
<?php echo form_error('data[hr]', '<div class="successMessage">', '</div>'); ?>
<?php
foreach (gethrList() as $key => $value) {
    if ($editData["hr"] == $key) {
        echo $value;
    }
}
?>  


                                    </td>

                                </tr>
                            </table> 
                        </div>

                    </fieldset>

                </div>
            </div>
        </div>
    </div>                  


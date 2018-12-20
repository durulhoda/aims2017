<style>
.center_border{
  border: 2px solid #D8D8D8; 
  padding: 4px; 
  text-align: center;
			   vertical-align: middle;
}
.red{color: red;font-weight: bold;}
.green{color:green;font-weight: bold;}
.gradeView tr td{
  padding: 0px; border: 1px solid #cccccc; text-align: center
}
.detailsTable tr th{
  border: 2px solid #cccccc; padding: 4px; text-align: center
}

</style>

<!--<?php// echo "<pre>"; print_r($records['record']) ;?>-->
<div class="page-header">
	<button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
		<span class="btn btn-purple no-border">
		  <i class="ace-icon fa fa-print bigger-130"></i>
		  <span class="bigger-110">Prints Transcript</span>
		</span>
	</button>
</div><!--page-header-->


<div id="printableArea"> 
<style tyle="text/css">
        @media print
       {
          .center_border{
			  border: 2px solid #D8D8D8; 
			  padding: 4px; 
			  text-align: center;
			   vertical-align: middle;
			}
			.red{color: red;font-weight: bold;}
			.green{color:green;font-weight: bold;}
			.gradeView tr td{
			  padding: 0px; border: 1px solid #cccccc; text-align: center
			}
			.detailsTable tr th{
			  border: 2px solid #cccccc; padding: 4px; text-align: center
			}
       }
    </style>
	<div style="margin: 10px auto;width: 850px;border: 0px solid #cccccc;border:1px solid #d9d9d9; ">
		<table style="width:100%; border-bottom: 2px solid #ddd; margin-bottom: 3px">
			<tbody>
				<tr style=" font-family: cambria;"> 
					<td style="text-align: center;">
					<?php $logo = base_url().$institute_info->logo;?>
						<p style="margin-left:5px;">
						<img src="<?php echo $logo; ?>" style="margin-top:3px;" height="80" />  
						<div style="font-size: 20px; font-size: 35px; color: royalblue;">    
							<?php echo ($institute_info->institute_name) ? $institute_info->institute_name : "";?>          
						</div>                                           
						<div style="line-height: 3px; font-size: 18px; color: #444;"> 
							<?php echo ($institute_info->address) ? $institute_info->address : ""; ?>                
						</div>
						</p>
					</td>
				</tr>
				<tr>
					<td style="text-align: center; ">
						<h3 style="font-family: Algerian;color:red;">ACADEMIC TRANSCRIPT</h3> 
					</td> 
				</tr>
			</tbody>
		</table>         
		<div style="margin-top: 10px;float:left; border:0px solid red; width:160px; margin-left: 9px;">
			<img src="<?php echo ($student_info->photo) ? base_url().$student_info->photo :  base_url().'/uploads/logo13.png' ?>" width="152" height="auto" align="middle">
		</div>
		<div style="margin: 10px 10px 20px; font-family: cambria; height: 170px; width:98%; border:0px solid red;">
			<table style="width:50%; float: left;border:0px solid red; line-height: 13px;">
				<tbody>
					<tr>
						<td style="text-align: left; ">
							<span style="font-size: 14px;">
								<strong>Student ID <strong>
							</span>
						</td>
						<td>   
							<span style="font-size: 14px;">
								<strong> : </strong>
								<strong>
									<?php echo ($student_info->studentId) ? $student_info->studentId : ""; ?>
								</strong>
							</span>
						</td>
					</tr>
					<tr style="line-height: 30px;">
						<td style="text-align: left; margin-top: 2px; ">
							<span style="font-size: 14px;"><strong> Name </strong> </span>
						</td>
						<td>   
							<span style="font-size: 14px;  margin-top: 2px;">
								<strong>  : </strong> 
								<strong>
									<?php echo ($student_info->firstName) ? $student_info->firstName : ""; ?>
								</strong>
							</span>
						</td>
					</tr>  
					<tr>
						<td style="text-align: left; ">
							<span style="font-size: 14px;">Class </span>
						</td>
						<td> 
							<p>
								<strong>  : </strong>  <?php echo ($program_info->program_name) ? $program_info->program_name : ""; ?>          
							</p>
						</td> 
					</tr> 
					<tr>
						<td style="text-align: left; ">
							<span style="font-size: 14px;"> Group </span>
						</td>
						<td> 
							<p>
								<strong>  : </strong>  <?php echo ($program_info->group_name) ? $program_info->group_name : ""; ?>          
							</p>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; "><span style="font-size: 14px;"> Shift </span>                                       
						</td>
						<td>  
							<p>
								<strong>  : </strong> <?php echo ($program_info->shift_name) ? $program_info->shift_name : ""; ?>             
							</p>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; ">
							<span style="font-size: 14px;">Section </span>                                        
						</td>
						<td>    
							<p>
								<strong>  : </strong> <?php echo ($program_info->section_name) ? $program_info->section_name : ""; ?>            
							</p>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; ">
							<span style="font-size: 14px;">Exam Name </span>                                       
						</td>
						<td>   
							<p>
								<strong>  : </strong>   <?php echo getSemesterName($semester_id); ?>             
							</p>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; ">
							<span style="font-size: 14px;"> Session </span>
						</td>
						<td>  
							<p>
								<strong>  : </strong> <?php echo ($program_info->session_name) ? $program_info->session_name : ""; ?>            
							</p>
						</td>
					</tr>
				</tbody>
			</table>
			<table style="width:28%; float: right; border: 2px solid #cccccc; margin-right: 8px; border-collapse: collapse; " class="gradeView">
				<tbody>
					<tr>
						<td style=" border: 1px solid #cccccc; text-align: center">Grade Letter</td>
						<td style=" border: 1px solid #cccccc; text-align: center">Exam Marks</td>
						<td style=" border: 1px solid #cccccc; text-align: center">Grade Point</td>
					</tr>
					<tr><td>A+</td><td>80-100</td><td>5</td></tr>
					<tr><td>A</td><td>70-79</td><td>4</td></tr>
					<tr><td>A-</td><td>60-69</td><td>3.50</td></tr>
					<tr><td>B</td><td>50-59</td><td>3</td></tr> 
					<tr><td>C</td><td>40-49</td><td>2</td></tr>
					<tr><td>D</td><td>33-39 </td><td>1</td></tr>
					<tr><td>F</td><td>0-32</td><td>0</td></tr>
				</tbody>
			</table>
		</div>
		<hr>
		<table class="detailsTable" style=" font-family: cambria; margin: 10px 10px; width: 97%; border-collapse: collapse;" id="tblprint">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Subject Name</th>
					<th>Code</th>
					<th>Full Mark</th>
					<th>Ob Marks</th>
					<th>Total Mark</th>
					<th>GP</th>
					<th>L.G.</th>
				</tr>
			</thead>
			<?php if ($records['record']) : ?>
			<tbody>
					<?php 
					$merge = [];
					$m_count = [];
					$i = 1;
					foreach ($records['record'] as $key => $val) :
						if ($val['course_status'] == 1 || $val['course_status'] == 3) :
							$color = ($val['gpa_point'] == 0) ? "red" : "green";
						if ($val['merge_id']) {
							$merge[$val['merge_id']] = isset($merge[$val['merge_id']]) ? 1 : 2;
						}
						// if ($key == 3) {
						// 	print_r($merge[$val['merge_id']]);
						// }
				?>
				<tr style="border: 1px solid #D8D8D8; ">
					<td style="text-align: left" class="center_border"><?php echo $i++; ?></td>
					<?php if ($val['merge_id']) : ?>
						<?php if ($merge[$val['merge_id']] == 2): ?>
						<td style="text-align: left" rowspan="<?php echo $val['merge_count']; ?>" class="center_border"><?php echo $val['merge_course_name']; ?></td>
						<?php endif; ?>
					<?php else : ?>
						<td style="text-align: left" rowspan="1" class="center_border"><?php echo $val['course_name'] ; ?></td>
					<?php endif; ?>
					<td class="center_border"><?php echo $val['course_code']; ?></td>
					<td class="center_border"><?php echo $val['full_mark']; ?></td>  
					<td style="text-align: left" class="center_border"><?php echo $val['cal_mark']; ?></td>
					<td class="center_border <?php echo $color; ?>"><?php echo $val['total_mark']; ?></td>
					<?php if ($val['merge_id']) : ?>
						<?php if ($merge[$val['merge_id']] == 2): ?>
						<td rowspan="<?php echo $val['merge_count']; ?>" class="center_border"><?php echo $val['gpa_point'];?></td>
						<td rowspan="<?php echo $val['merge_count']; ?>" class="center_border"><?php echo $val['gpa_letter'];?></td>
						<?php endif; ?>
				<?php else : ?>	
						<td rowspan="1" class="center_border"><?php echo $val['gpa_point'];?></td>
						<td rowspan="1" class="center_border"><?php echo $val['gpa_letter'];?></td>
				</tr>
				<?php endif; ?>	
				<?php endif; endforeach; ?>		

				<?php 
					foreach ($records['record'] as $key => $val) :
						if ($val['course_status'] == 2) :
							$color = ($val['gpa_point'] == 0) ? "red" : "green";
				?>
				<tr>
      				<td colspan="8" style="border: 1px solid #D8D8D8; padding: 4px; text-align: left; font-weight:bolder;">Optional Subject (GP above 2)</td>
    			</tr>
				<tr style="border: 1px solid #D8D8D8; ">
					<td style="text-align: left" class="center_border"><?php echo $i; ?></td>
					<td style="text-align: left" rowspan="1" class="center_border"><?php echo $val['course_name'] ; ?></td>
					<td class="center_border"><?php echo $val['course_code']; ?></td>
					<td class="center_border"><?php echo $val['full_mark']; ?></td>  
					<td style="text-align: left" class="center_border"><?php echo $val['cal_mark']; ?></td>
					<td class="center_border <?php echo $color; ?>"><?php echo $val['total_mark']; ?></td>
					<td rowspan="1" class="center_border"><?php echo $val['gpa_point'];?></td>
					<td rowspan="1" class="center_border"><?php echo $val['gpa_letter'];?></td>
				</tr>
				<?php endif; endforeach; ?>	

				<?php 
					$ex_sub = [];
					$i;
					foreach ($records['record'] as $key => $val) :
						if ($val['course_status'] == 4) :
							$color = ($val['gpa_point'] == 0) ? "red" : "green";
						$ex_sub[0] = isset($ex_sub[0]) ? 1 : 2;
						$i++;
				?>
				<?php if ($ex_sub[0] == 2) : ?>
				<tr>
      				<td colspan="8" style="border: 1px solid #D8D8D8; padding: 4px; text-align: left; font-weight:bolder;">Extra Subject (No GP)</td>
    			</tr>
    			<?php endif; ?>
				<tr style="border: 1px solid #D8D8D8; ">
					<td style="text-align: left" class="center_border"><?php echo $i; ?></td>
					<td style="text-align: left" rowspan="1" class="center_border"><?php echo $val['course_name'] ; ?></td>
					<td class="center_border"><?php echo $val['course_code']; ?></td>
					<td class="center_border"><?php echo $val['full_mark']; ?></td>  
					<td style="text-align: left" class="center_border"><?php echo $val['cal_mark']; ?></td>
					<td class="center_border <?php echo $color; ?>"><?php echo $val['total_mark']; ?></td>
					<td rowspan="1" class="center_border"><?php echo $val['gpa_point'];?></td>
					<td rowspan="1" class="center_border"><?php echo $val['gpa_letter'];?></td>
				</tr>
				<?php endif; endforeach; ?>	

			</tbody>
			<?php if ($records['total']) : ?>
			<tbody>
				<tr>
				    <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">Total Marks : <?php echo $records['total']['total_marks']; ?></td>
				    <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;"> Obtain Marks :  <?php echo $records['total']['total_obtain_marks']; ?> </td>
				    <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">  GPA : <?php echo $records['total']['gpa_point']; ?></td>
				   <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;"> Letter Grade : <?php echo $records['total']['gpa_letter']; ?>
				  </td>
				</tr>
				<tr>
				    <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;">Position : <?php echo $student_position['position']; ?></td>
				    <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;"> Total Subject Fail :  <?php echo $records['total']['tot_fail_subj']; ?> </td>
				   <td colspan="2" style="padding:10px 0px 5px;text-align: center; font-size: 14px; font-weight: bold;"> Percentage Marks : <?php echo round(($records['total']['total_obtain_marks'] * 100)/$records['total']['total_marks'])."%"; ?>
				  </td>
				</tr>
				<tr>
  					<td colspan="8" style="padding:10px 0px 5px;text-align: center; font-size: 20px; font-weight: bold;"> 
  					<hr>
    					Result Comments : <?php echo $records['total']['result_comment']; ?>  
    				</td>
				</tr>
				<tr>
				  <td colspan="4" style="padding:10px 0px 10px 10px;text-align: left; font-size: 12px; font-weight: bold;"><img style="width: 140px;height: 45px;" src="<?php echo base_url()."images/ct.png"; ?>"> <br>.............................................<br>Class Teacher </td>
				  <td colspan="4" style="padding:10px 10px 10px 0px;text-align: right; font-size: 12px; font-weight: bold;"><img style="width: 140px;height: 45px;" src="<?php echo base_url()."images/ec.png"; ?>"> <br>.............................................<br> Exam Controller </td>
				</tr>
			</tbody>
		<?php endif; endif; ?>
		</table>
	</div>
</div>
<!--<script>
function print(){
	 var divToPrint = document.getElementById('tblprint');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid green;' +
        'padding;0.5em;' +
        '}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}
</script>-->
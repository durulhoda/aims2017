<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Salary extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
      $this->load->model('admin/salary/SalaryModleAdmin', 'SalaryModleAdmin');
    }
    
    public function carryEmployeeInfo($id) {
        $this->load->view('templates/admin/common/header');
        $data['id'] = (int) $id;
        $this->load->view('templates/admin/salary/index', $data);
        $this->load->view('templates/admin/common/footer');
    }
    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/salary/index');
        $this->load->view('templates/admin/common/footer');
    }
    
    public function insertsalary() {
//      echo $_POST; exit;
        print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[employeeId]',
                'label' => 'employee',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[basic]',
                'label' => 'basic',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[houseRent]',
                'label' => 'houseRent',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[transport]',
                'label' => 'transport',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[medical]',
                'label' => 'medical',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gross]',
                'label' => 'gross',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[other]',
                'label' => 'other',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[employmentStatus]',
                'label' => 'employeeType',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[year]',
                'label' => 'year',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[month]',
                'label' => 'month',
                'rules' => 'required'
            )
            
            );
        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/salary/index');        
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->SalaryModleAdmin->addSalaryInfo($data);
                  $this->index('refresh');
		}
    }
    
    public function Salarylist(){
        
       $salarylist = $this->SalaryModleAdmin->getSalaryInfo();  
       
       echo "<table width='100%'>"
        . "<tr> <th><input type=\"checkbox\" id=\"checkboxall\" value=\"\" name=\"checkall\"></th>"
        .  "<th>Employee Name </th>"
        . " <th>Basic </th>"
        . " <th>House Rent </th>"
        . " <th>Transport </th>"
        . " <th>Medical </th>"
        . " <th>Employee Type </th>"
        .  "<th width='7%'>Actions</th>"  
        . "</tr>";
        foreach ($salarylist as $value) {?>
<tr>
        <td><input type="checkbox" name="checkall"></td>
        <td><?php echo $value['employeeId'];?></td>
        <td><?php echo $value['basic'];?></td>
        <td><?php echo $value['houseRent'];?></td>
        <td><?php echo $value['transport'];?></td>
        <td><?php echo $value['medical'];?></td>
        <td><?php echo $value['employmentStatus'];?></td>
        
        
        </td>
        
        <td>     
            <a title="Edit" href="<?php echo admin_Url() ."/salary/editsalary/" .$value['salaryconfigId'];?>"><img alt="Edit" src="<?php echo admin_templateUrl();?>img/icons/icon_edit.png"></a>
            <a id="delete" title="Delete" href="<?php echo admin_Url() ."/salary/deletesalary/" .$value['salaryconfigId'];?>"><img alt="Delete" src="<?php echo admin_templateUrl();?>img/icons/icon_delete.png"></a>
        </td>
   </tr>
         <?php }?>
</table>
<?php       
 
    }
    
    public function updatesalary($id){
        
        //         print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[employeeId]',
                'label' => 'employee',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[basic]',
                'label' => 'basic',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[houseRent]',
                'label' => 'houseRent',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[transport]',
                'label' => 'transport',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[medical]',
                'label' => 'medical',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gross]',
                'label' => 'gross',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[other]',
                'label' => 'other',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[employeeType]',
                'label' => 'employeeType',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[year]',
                'label' => 'year',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[month]',
                'label' => 'month',
                'rules' => 'required'
            )
            
            );
         $this->form_validation->set_rules($config);
        
       $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/salary/index');        
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                     $data['employeeId'] = (int) $id;
                    $this->SalaryModleAdmin->addSalaryInfo($data);
                  $this->index('refresh');
		}
    }
    
     public function editsalary($id){        

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->SalaryModleAdmin->editSalaryInfo($id);
        $this->load->view('templates/admin/salary/editsalary', $data); 
        $this->load->view('templates/admin/common/footer');

    }
    
    public function deletesalary($id){
        $id = (int)$id;
        
        $this->SalaryModleAdmin->deleteSalaryInfo($id);
        $this->index();
    }
        
        }
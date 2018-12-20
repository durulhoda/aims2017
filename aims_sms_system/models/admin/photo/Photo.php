
//        IMAGE VALIDADION
        
//        $config['upload_path'] = './uploads/';
//        $config['allowed_types'] = '*';
//        $config['encrypt_name'] = TRUE;
//        $config['max_size'] = '100';
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';

//        $this->load->library('upload', $config);


//        if (!$this->form_validation->run() || !$this->upload->do_upload("photo") || !$this->upload->do_upload("mphoto")) {
//
//            $this->load->view('templates/admin/shift/index');
//            
//        } else {
//
////            POST DATA
//            $data = $this->input->post('data', TRUE);
//
//            
////            IMAGE DATA
//            $datas = $this->upload->multi_data();
////            $data = $datas['file_name'];
////            print_r($datas); exit;
//            for($i=0; $i<5; $i++){
//                echo $datas['file_name']."<br>";
//            }
//            
////              PASSING DATA TO MODEL
//         
//        }
//    
    
         if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/shift/index');
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->ShiftModleAdmin->addShiftInfo($data);
//			$this->load->view('formsuccess');
		}

        
}
 

}

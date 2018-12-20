<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Test extends MY_Controller {

	public function index()
	{
		exit;
		// echo 'hi';exit;
		// $students = $this->db->get('student')->result();
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		$students = $this->db
						->select('s.*,trim(p.classId) as classId')
						->from('student as s')
						->join('programoffer as po','s.programOfferId = po.programOfferId')
						->join('program as p','po.programId = p.programId')
						//->order_by('p.classId','asc')
						->order_by('s.stu_id','asc')
						->get()
						->result();
		$set = [];
		$vset = [];
		foreach ($students as $key => $val) {
			if (isset($vset[$val->classId])) {
				$vset[$val->classId] = $vset[$val->classId]+1;
			} else {
				$vset[$val->classId]= 1;
			}
			if (isset($set[$val->classId])) {
				$set[$val->classId] = date('Y').trim($val->classId).sprintf('%03d', $vset[$val->classId]);
			} else {
				$set[$val->classId] = date('Y').trim($val->classId).sprintf('%03d', $vset[$val->classId]);
			}
			$data[] = [
				'stu_id' => $val->stu_id,
				'pv_studentId' => trim($val->studentId),
				'ne_studentId' =>trim($set[$val->classId])
			];
		}
		 //echo '<pre>';
		// print_r($data);
		//exit;

		foreach ($data as $key => $row) {
			$this->db
			->where('stu_id', $row['stu_id'])
			->where('studentId', $row['pv_studentId'])
			->update('student',['new_studentId' => $row['ne_studentId']]);
		}
		// echo '<pre>';
		// print_r($students);
		// print_r($data);
		 exit;
	}

	public function othersTest()
	{
		exit;
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		$records = $this->db->get('student')->result();
		// borrowbook
		//$this->update($records,$table='borrowbook');
		 // studentfine
		// $this->update($records,$table='studentfine');
		//promotedstudent
		// $this->update($records,$table='promotedstudent');
		// // publishedresult
		// $this->update($records,$table='publishedresult');
		// studentassigncourse
		// $this->update($records,$table='studentassigncourse');
		 // studentattendance
		//$this->update($records,$table='studentattendance');
		
		// // studentmarks
		// $this->update($records,$table='studentmarks');
		// // student_access
		 //$this->update($records,$table='student_access');
		 echo '<pre>';
		print_r($records);exit;
	}

	private function update($records, $table){
		
		foreach ($records as $val) {
			$this->db
				->where('studentId', trim($val->studentId))
				->update($table,['studentId' => $val->new_studentId]);
		}
	}

	public function district()
	{exit;
		$districts = [
		'Bagerhat',
        'Bandarban ',
        'Barguna',
        'Barisal',
        'Bhola',
        'Bogra',
        'Brahmanbaria',
        'Chandpur',
        'Chapainababganj',
        'Chittagong',
        'Chuadanga',
        'Comilla',
        'Cox\'s Bazar',
        'Dhaka',
        'Dinajpur',
        'Faridpur',
        'Feni',
        'Gaibandha',
        'Gazipur',
        'Gopalganj',
        'Habiganj',
        'Jaipurhat',
        'Jamalpur',
        'Jessore',
        'Jhalakati',
        'Jhenaidah',
        'Khagrachari',
        'Khulna',
        'Kishoreganj',
        'Kurigram',
        'Kushtia',
        'Lakshmipur',
        'Lalmonirhat',
        'Madaripur',
        'Magura',
        'Manikganj',
        'Meherpur',
        'Moulvibazar',
        'Munshiganj',
        'Mymensingh',
        'Naogaon',
        'Narail',
        'Narayanganj',
        'Narsingdi',
        'Natore',
        'Nawabganj',
        'Netrakona',
        'Nilphamari',
        'Noakhali',
        'Pabna',
        'Panchagarh',
        'Patuakhali',
        'Pirojpur',
        'Rajbari',
        'Rajshahi',
        'Rangamati',
        'Rangpur',
        'Satkhira',
        'Shariatpur',
        'Sherpur',
        'Sirajganj',
        'Sunamganj',
        'Sylhet',
        'Tangail',
        'Thakurgaon'
		];
		foreach ($districts as $key => $val) {
			$data[] = [
				'name_en' => $val,
				'created_by' => 1
			];

		}
		$this->db->insert_batch('districts', $data); 
		echo '<pre>';print_r($data);exit;
	}
	}
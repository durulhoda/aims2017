<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Device extends MY_Controller {

	public function index()
	{
		//echo 'hi';exit;
		$start_date_time = "2018-03-05 14:30:58";
		$end_date_time = "2018-03-05 17:20:58";
		$api_token = "13c0-d4ad-a86f-3fe4-1096-4d1b-dcea-5cfb-bfba-ac2b-2ac2-decb-dec3-da24-5881-5764";
		$url ="http://api-inovace360.com/api/v1/logs?start=$start_date_time&end=$end_date_time&api_token=13c0-d4ad-a86f-3fe4-1096-4d1b-dcea-5cfb-bfba-ac2b-2ac2-decb-dec3-da24-5881-5764";
		$url = str_replace("","%20",$url);
		$response = file_get_contents($url);
		$json = json_decode($response,true);
		if ($json['data']) {
			foreach ($json['data'] as $key => $val) {
				$data = [
					'logged_time' => $val['logged_time'],
					'type' => $val['type'],
					'uid' => $val['uid'],
					'device_identifier' => $val['device_identifier'],
					'location' => $val['location'],
					'person_identifier' => $val['person_identifier'],
					'rfid' => $val['rfid'],
					'primary_display_text' => $val['primary_display_text'],
					'secondary_display_text' => $val['secondary_display_text']
				];
				$this->db->insert('device_info', $data);
			}
		}
		echo '<pre>';print_r($json);exit;
	}
}
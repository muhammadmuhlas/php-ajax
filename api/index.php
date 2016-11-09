<?php
$a = file_get_contents('data.json');
$decoded = json_decode($a);
if (isset($_GET['api_key']) && $_GET['api_key'] != ""){

	$api_list = array(
		'ASDFGHJKL', 
		'QWERTYUIOP',
		'ZXCVBNM'
		);
	$get_api_key = $_GET['api_key'];

	if (in_array($get_api_key, $api_list)){

		if (isset($_GET['id'])){

			$q = $_GET['id'];

			if (preg_match("/[a-z]/i", $q)){

				$output = array(
					'status' => '400', 
					'message' => 'Bad Request', 
				);
				echo json_encode($output);
				exit;
			}

			foreach ($decoded as $data) {

				if ($data->id == $q){

					$id = $data->id;
					$first_name = $data->first_name;
					$last_name = $data->last_name;
					$email = $data->email;
					$gender = $data->gender;
					$ip_address = $data->ip_address;
				}
			}
			if (!isset($id)){

				$output = array(
					'status' => '200', 
					'message' => 'Data Not Found', 
				);

				echo json_encode($output);
			} else {

				$output = array(
					'status' => '200',
					'message' => 'Success',
					
					'data' => array(
						'first_name' => $first_name,
						'last_name' =>$last_name,
						'email' => $email,
						'gender' => $gender,
						'ip_address' => $ip_address )
				);

				echo json_encode($output);
			}
		} else {

			$output = array(
				'status' => '400', 
				'message' => 'Bad Request', 
			);
			echo json_encode($output);

		}
	} else {

		$output = array(
			'status' => '500', 
			'message' => 'Not Authorized', 
		);

		echo json_encode($output);
	}

} else {

		$output = array(
			'status' => '403', 
			'message' => 'Not Authorized', 
		);

		echo json_encode($output);
}
?>
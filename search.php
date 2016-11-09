<?php
$a = file_get_contents('data.json');
$decoded = json_decode($a);

if (isset($_GET['api_key']) && $_GET['api_key'] != ""){

	$api_list = array(
		'ASDFGHJKL', 
		'QWERTYU'
		);
	$get_api_key = $_GET['api_key'];

	if (in_array($, $api_list)){

		if (isset($_GET['id'])){

			$q = $_GET['id'];

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
					'code' => '200', 
					'status' => 'not found', 
				);

				echo json_encode($output);
			} else {

				$output = array(
					'code' => '200',
					'status' => 'success', 
					
					'data' => array(
						'first_name' => $first_name,
						'last_name' =>$last_name,
						'email' => $email,
						'gender' => $gender,
						'ip_address' => $ip_address )
				);

				echo json_encode($output);
			}
		}
	}

	

	if ()

} else {

	break;
}


		
?>
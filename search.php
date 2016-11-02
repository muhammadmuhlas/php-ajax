<?php
$a = file_get_contents('data.json');
$decoded = json_decode($a);


if (isset($_GET['q'])){

	$q = $_GET['q'];

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
		
		echo "not found";
	} else {

		echo "
			<b>ID</b> : $id <br />
			<b>First Name</b> : $first_name <br />
			<b>Last Name</b> : $last_name <br />
			<b>Email</b> :$email <br />
			<b>Gender</b> : $gender <br />
			<b>IP Address</b> : $ip_address <br />
			";
	}
}
?>
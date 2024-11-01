<?php
include('../../../wp-config.php');

	$username = get_option('bloggy_username');
	$password = get_option('bloggy_password');

$a = str_replace(' ', '+', $_POST['message']);

$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, "http://bloggy.se/api?login=".$username."&p=".$password."&content=".$a."&type=post");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec ($curl);
curl_close ($curl);


?>
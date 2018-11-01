<!DOCTYPE html>
<html>
<head>
	<title>Paylane</title>
</head>
<body>
	<?php 
		include '../paylane/Card.php';
		try {
			$paylane = new Card();
			$paylane->setCredentials(array(
					'username'=> 'b806b156050700c83f01338fa3d8ec1e',
					'password' => 'cho2%CI4!GU9#'
				)
			);
			$paylane->setUrl('https://direct.paylane.com/rest/');
			$paylane->setApiKey('4ebc52bd16bdbf200aac44c5313c5fe2cde38ad2');
			$paylane->setCardDetails(
				array(
					'card_number' => "4111111111111111",
					'expiration_month' => 03,
					'expiration_year' => 2020,
					'card_code' => 123,
					'name_on_card' => "John Doe"
				)
			);
			$result = $paylane->generateCardToken();
			print_r($result); die();	
		} catch (Exception $e) {
			print_r($e);
		}
		
	?>

</body>
</html>
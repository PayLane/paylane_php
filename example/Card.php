<!DOCTYPE html>
<html>
<head>
	<title>Paylane</title>
</head>
<body>
	<?php 
		include '../paylane/Card.php';
		try {
			$paylane = new Card('support@photobash.co', 'Photobash2018!');
			$paylane->setUrl('https://direct.paylane.com/rest.js/');
			$paylane->setApiKey('05c785c203071ccd4a0ffcfd3598dc008af0d4ff');
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
			print_r($e->getMessage());
		}
		
	?>

</body>
</html>
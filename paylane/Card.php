<?php
	include 'PayLaneRestClient.php'; 
	/**
	 * 
	 */
	class Card extends PayLaneRestClient
	{
		/**
     * @var string
     */
    private $card_data;
		/**
     * Set Card Details
     *
     * @param array $card_data Card details
     * @return void
     */
		public function setCardDetails($card_data)
		{
			$this->validateCardData($card_data);
			$this->card_data = $card_data;
		}

		/**
     * Set Card Details
     *
     * @param 
     * @return token for card value
     */
		public function generateCardToken()
		{
			$this->validateCardData($this->card_data);
			$reqObject = $this->card_data;
			$reqObject['public_api_key'] = $this->public_api_key;
			$response = $this->call(
				'/cards/generateToken',
				'post',
				json_encode($reqObject)
			);

			return $response;
		}
		/**
     * validate card details
     *
     * @param array $card_data Card details
     * @return true if all set else throw card exception
     */
		private function validateCardData($card_data) {
			$exceptions = array();
			
			if (trim($this->public_api_key) == "") {
				$exceptions['public_api_key'] = "public_api_key must be provided";
			}

			if (!isset($card_data['card_number'])) {
				$exceptions['card_number'] = "card_number must be provided";
			} else if (strlen($card_data['card_number']) != 16) {
				$exceptions['card_number'] = "card_number must be of 16 character";
			}

			if (!isset($card_data['name_on_card'])) {
				$exceptions['name_on_card'] = "name_on_card must be provided";
			}

			if (!isset($card_data['expiration_month'])) {
				$exceptions['expiration_month'] = "expiration_month must be provided";	
			} else if (!is_numeric($card_data['expiration_month'])) {
				$exceptions['expiration_month'] = "expiration_month must be number";
			} else if (strlen($card_data['expiration_month']) > 2) {
				$exceptions['expiration_month'] = "expiration_month must be of 2 character";
			}
			
			if (!isset($card_data['expiration_year'])) {
				$exceptions['expiration_year'] = "expiration_year must be of 2 character";
			} else if (!is_numeric($card_data['expiration_year'])) {
				$exceptions['expiration_year'] = "expiration_year must be number";
			} else if (strlen($card_data['expiration_year']) != 4) {
				$exceptions['expiration_year'] = "expiration_year must be of 4 character";
			}

			if (!isset($card_data['card_code'])) {
				
			} else if (!is_numeric($card_data['card_code'])) {
				$exceptions['card_code'] = "card_code must be number";

			} else if (strlen($card_data['card_code']) > 4 || strlen($card_data['card_code']) < 3) {
				$exceptions['card_code'] = "card_code must be of 3 or 4 character";
			}

			if (!empty($exceptions)) {
				throw new Exception(json_encode($exceptions), 400);
			}
		}
	}
 ?>
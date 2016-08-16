<?php
require(dirname(__FILE__) . '/lib/Stripe.php');
//require 'lib/Stripe.php';
Stripe::setApiKey("sk_test_l8FVfiAVF7kbHq3oGOD2hCkL");

error_reporting(E_ALL);			 
 
  try{
		
		$customer = Stripe_Customer::create(array(
			'email'    => "kumar@gmail.com",
			'description' => "bank"
		 ));
		
	
		$customerId = $customer->id; 
	       			
	
		echo '1';
		
		}
		catch (Exception $e) {
		
		echo '0';
		}

 ?>
 

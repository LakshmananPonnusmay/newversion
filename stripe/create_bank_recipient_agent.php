<?php
require(dirname(__FILE__) . '/lib/Stripe.php');
//require 'lib/Stripe.php';
Stripe::setApiKey("sk_test_l8FVfiAVF7kbHq3oGOD2hCkL");

error_reporting(E_ALL);			 
 
  try{
			 
	
		echo '1';
		
		}
		catch (Exception $e) {
		$error = "false,".$e->getMessage();
		echo $e->getMessage();
		echo '0';
		}

 ?>
 

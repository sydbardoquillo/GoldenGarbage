<?php
	/**
	* GGO_service.php
	*
	* File to handle all API requests.
	* Accepts POST requests.
	* Each request will be identified by a tag.
	* Response will be JSON data.
	*
	* @category   GoldenGarbageServer
	* @package    com.spectrum.ecoapp.goldengarbage
	* @author     Arreglo, Charlie Ahl F. <arreglo.charlieahl@live.com>
	* @copyright  Team Spectrum
	* @version    2.1.0.0
	*
	* .:: Error Directory ::.
	* G-4RE-G04 | [requestRegister] Registration failed from Query
	* G-4JK-IFA | [requestJunkshopInfo] Failed in getting junkshop information from Query
	* G-4JK-IE4 | [requestJunkshopInfoForEdit] Failed in getting junkshop information from Query
	* G-4JK-L04 | [requestJunkshopList] Failed in getting junkshop list from Query
	* G-4JK-ID4 | [requestOtherJunkshopInfo] Failed in getting junkshop id from junkshop name parameter from Query
	* G-4JK-IFB | [requestOtherJunkshopInfo] Failed in getting junkshop information from Query
	* G-4JK-IU4 | [requestJunkshopInfoUpdate] Failed in updating the junkshop information from Query
	* G-4JI-DL4 | [requestJunkshopItemDelete] Failed in removing junkshop item entry from Query
	* G-4JI-CIA | [requestJunkshopItemDelete] Failed in finding junkshop item entry from Query
	* G-4JI-MD4 | [requestJunkshopItemEdit] Failed in updating the junkshop item entry from Query
	* G-4JI-CIB | [requestJunkshopItemEdit] Failed in finding junkshop item entry from Query
	* G-4JI-AD4 | [requestJunkshopItemAdd] Failed in adding junkshop item entry from Query
	*/

	if (isset($_POST['tag']) && $_POST['tag'] != '') {
	    $tag = $_POST['tag'];
		require_once __DIR__ . '/GGO_functions.php';
	    $DBFunction = new DB_Functions();
	    $response = array("ErrorStatus" => FALSE);

	    if ($tag == 'requestLogin') {
	   		$username = $_POST['username'];
	   		$password = $_POST['password'];
	   		$reply = $DBFunction->RequestLogin($username, $password);
	   		if ($reply == FALSE) {
	            $response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = "Incorrect username or password.";
	        } else {
	        	$response["JunkshopID"] = $reply;
	        }
	        echo json_encode($response);
	    }

	    else if ($tag == 'requestRegister') {
	    	$activationCode = $_POST['activationCode'];
	   		$username = $_POST['username'];
	   		$password = $_POST['password'];
	   		$reply = $DBFunction->VerifyCode($activationCode);
	   		if ($reply['status']) {
	   			if ($DBFunction->IsUsernameExisted($username)) {
	   				$response["ErrorStatus"] = TRUE;
	            	$response["ErrorMessage"] = "Sorry, username has already been taken.";
		    	}
		    	else
		    	{
		    		$reply = $DBFunction->RequestRegister($reply['junkshopID'], $username, $password);
		   			if ($reply == FALSE) {
			            $response["ErrorStatus"] = TRUE;
			            $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4RE-G04)";
			        }
			        else {
			        	$response["JunkshopID"] = $reply;
			        }
		    	}
	        }
	        else {
	        	$response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = $reply['message'];
	        }
	        echo json_encode($response);	        	
	    }

	    else if ($tag == 'requestJunkshopInfo') {
	     	$junkshopID = $_POST['junkshopID'];
	    	$junkshopInfo = $DBFunction->RequestJunkshopInfo($junkshopID);
	    	if($junkshopID == FALSE)
		    {
		    	$response["ErrorStatus"] = TRUE;
		        $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JK-IFA)";
		    }
		    else
		    {
		    	$response["JunkshopName"] = $junkshopInfo["js_name"];
		    	$response["JunkshopAddress"] = $junkshopInfo["js_address"];
		    	$response["JunkshopOwner"] = $junkshopInfo["js_owner"];
		    	$response["JunkshopContact"] = $junkshopInfo["js_contact_number"];
		    	$response["JunkshopPickUp"] = $junkshopInfo["js_pickup_flag"];

		    	$junkshopItems = $DBFunction->RequestJunkshopItems($junkshopID);
		    	if($junkshopItems == FALSE)
		    	{
		    		$response["JunkshopItems"] = array();
		    	}
		    	else 
		    	{
				   	for($i = 0; $i < count($junkshopItems); $i++) {
				   		$junkshopItemData[] = array('JunkshopItemName' => $junkshopItems[$i]->js_item_name, 
				   			'JunkshopItemPrice' => $junkshopItems[$i]->js_item_price);
				   	}
				   	$response["JunkshopItems"] = $junkshopItemData;
			    }
			    	
		    	$junkshopComments = $DBFunction->RequestJunkshopComments($junkshopID);
		    	if($junkshopComments == FALSE)
		    	{
		    		$response["JunkshopComments"] = array();
		    	}
		    	else 
		    	{
				    for($i = 0; $i < count($junkshopComments); $i++) {
				    	$junkshopCommentData[] = array('CommentFullName' => $junkshopComments[$i]->js_fullname, 
				    		'CommentStarRating' => $junkshopComments[$i]->js_star,
				    		'CommentContent' => $junkshopComments[$i]->js_comment);
				    }
				    $response["JunkshopComments"] = $junkshopCommentData;
			    }
		    }
		    echo json_encode($response);	
	    }

	    else if ($tag == 'requestJunkshopInfoForEdit') {
	     	$junkshopID = $_POST['junkshopID'];
	    	$junkshopInfo = $DBFunction->RequestJunkshopInfo($junkshopID);
	    	if($junkshopID == FALSE)
		    {
		    	$response["ErrorStatus"] = TRUE;
		        $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JK-IE4)";
		    }
		    else
		    {
		    	$response["JunkshopName"] = $junkshopInfo["js_name"];
		    	$response["JunkshopAddress"] = $junkshopInfo["js_address"];
		    	$response["JunkshopOwner"] = $junkshopInfo["js_owner"];
		    	$response["JunkshopContact"] = $junkshopInfo["js_contact_number"];
		    	$response["JunkshopPickUp"] = $junkshopInfo["js_pickup_flag"];

		    	$junkshopItems = $DBFunction->RequestJunkshopItems($junkshopID);
		    	if($junkshopItems == FALSE)
		    	{
		    		$response["JunkshopItems"] = array();
		    	}
		    	else 
		    	{
				   	for($i = 0; $i < count($junkshopItems); $i++) {
				   		$junkshopItemData[] = array(
				   			'JunkshopItemID' => $junkshopItems[$i]->item_ID, 
				   			'JunkshopItemName' => $junkshopItems[$i]->js_item_name, 
				   			'JunkshopItemPrice' => $junkshopItems[$i]->js_item_price);
				   	}
				   	$response["JunkshopItems"] = $junkshopItemData;
			    }
		    }
		    echo json_encode($response);	
	     }

	     else if ($tag == 'requestJunkshopList') {

	    	$junkshopList = $DBFunction->RequestJunkshopList();
	    	if ($junkshopList == FALSE) 
	    	{
	    		$response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JK-L04)";
	    	}
	    	else
	    	{
				for($i = 0; $i < count($junkshopList); $i++) {
				    $junkshopListData[] = array(
				    	'JunkshopID' => $junkshopList[$i]->js_ID,
				    	'JunkshopName' => $junkshopList[$i]->js_name, 
		    			'Location' => $junkshopList[$i]->js_address, 
		    			'Latitude' => $junkshopList[$i]->js_lat, 
		    			'Longitude' => $junkshopList[$i]->js_log);
				}
			    $response["JunkshopList"] = $junkshopListData;
	    	}
	    	echo json_encode($response);
	    }

	    else if ($tag == 'requestOtherJunkshopInfo') {
			$junkshopName = $_POST['junkshopName'];
	    	$junkshopID = $DBFunction->RequestJunkshopID($junkshopName);
	    	if($junkshopID == FALSE)
	    	{
	    		$response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JK-ID4)";
	    	}
	    	else
	    	{
	    		$junkshopInfo = $DBFunction->RequestJunkshopInfo($junkshopID);
	    		if($junkshopID == FALSE)
		    	{
		    		$response["ErrorStatus"] = TRUE;
		            $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JK-IFB)";
		    	}
		    	else
		    	{
		    		$response["JunkshopOwner"] = $junkshopInfo["js_owner"];
		    		$response["JunkshopContact"] = $junkshopInfo["js_contact_number"];
		    		$response["JunkshopPickUp"] = $junkshopInfo["js_pickup_flag"];

		    		$junkshopItems = $DBFunction->RequestJunkshopItems($junkshopID);
		    		if($junkshopItems == FALSE)
		    		{
		    			$response["JunkshopItems"] = array();
		    		}
		    		else 
		    		{
				    	for($i = 0; $i < count($junkshopItems); $i++) {
				    		$junkshopItemData[] = array('JunkshopItemName' => $junkshopItems[$i]->js_item_name, 
				    			'JunkshopItemPrice' => $junkshopItems[$i]->js_item_price);
				    	}
				    	$response["JunkshopItems"] = $junkshopItemData;
			    	}
			    	

		    		$junkshopComments = $DBFunction->RequestJunkshopComments($junkshopID);
		    		if($junkshopComments == FALSE)
		    		{
		    			$response["JunkshopComments"] = array();
		    		}
		    		else 
		    		{
				    	for($i = 0; $i < count($junkshopComments); $i++) {
				    		$junkshopCommentData[] = array('CommentFullName' => $junkshopComments[$i]->js_fullname, 
				    			'CommentStarRating' => $junkshopComments[$i]->js_star,
				    			'CommentContent' => $junkshopComments[$i]->js_comment);
				    	}
				    	$response["JunkshopComments"] = $junkshopCommentData;
			    	}
		    	}
	    	}
	    	echo json_encode($response);
		}

		else if ($tag == 'requestJunkshopInfoUpdate') {
		 	$junkshopID = $_POST['junkshopID'];
		 	$junkshopOwnerName = $_POST['junkshopOwnerName'];
		 	$junkshopContact = $_POST['junkshopContact'];
		 	$junkshopPickUpStatus = $_POST['junkshopPickUpStatus'];
	    	$status = $DBFunction->RequestJunkshopInfoUpdate($junkshopID, $junkshopOwnerName, $junkshopContact, $junkshopPickUpStatus);
	    	if ($status) 
	    	{
	            $response["ResponseMessage"] = "Your changes have been saved.";
	    	}
	    	else
	    	{
				$response["ErrorStatus"] = TRUE;
		        $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JK-IU4)";
	    	}
	    	echo json_encode($response);
	    }

	    else if ($tag == 'requestJunkshopItemDelete') {
		 	$itemID = $_POST['itemID'];
		 	$junkshopID = $_POST['junkshopID'];
		 	$status = $DBFunction->CheckItemExist($itemID, $junkshopID);
	    	if ($status) 
	    	{
	            $status = $DBFunction->RequestJunkshopItemDelete($itemID, $junkshopID);
		    	if ($status) 
		    	{
		            $response["ResponseMessage"] = "Item has been removed.";
		    	}
		    	else
		    	{
					$response["ErrorStatus"] = TRUE;
			        $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JI-DL4)";
		    	}
	    	}
	    	else
	    	{
				$response["ErrorStatus"] = TRUE;
		        $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JI-CIA)";
	    	}
	    	echo json_encode($response);
	    }

	    else if ($tag == 'requestJunkshopItemEdit') {
		 	$itemID = $_POST['itemID'];
		 	$junkshopID = $_POST['junkshopID'];
		 	$itemName = $_POST['itemName'];
		 	$itemPrice = $_POST['itemPrice'];
		 	$status = $DBFunction->CheckItemExist($itemID, $junkshopID);
	    	if ($status) 
	    	{
	    		$status = $DBFunction->CheckItemNameExistWithoutDuplicate($itemName, $junkshopID, $itemID);
		    	if ($status) 
		    	{
		            $response["ErrorStatus"] = TRUE;
					$response["ErrorMessage"] = "Sorry, item name is already been used.";
		    	}
		    	else
		    	{
					$status = $DBFunction->RequestJunkshopItemEdit($itemID, $junkshopID, $itemName, $itemPrice);
				    if ($status) 
				    {
				        $response["ResponseMessage"] = "Item has been modified.";
				    }
				    else
				    {
						$response["ErrorStatus"] = TRUE;
					    $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JI-MD4)";
				    }
		    	}
	    	}
	    	else
	    	{
				$response["ErrorStatus"] = TRUE;
		        $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JI-CIB)";
	    	}
	    	echo json_encode($response);
	    }

	    else if ($tag == 'requestJunkshopItemAdd') {
		 	$junkshopID = $_POST['junkshopID'];
		 	$itemName = $_POST['itemName'];
		 	$itemPrice = $_POST['itemPrice'];
	    		$status = $DBFunction->CheckItemNameExist($itemName, $junkshopID);
		    	if ($status) 
		    	{
		            $response["ErrorStatus"] = TRUE;
					$response["ErrorMessage"] = "Sorry, item name has already been used.";
		    	}
		    	else
		    	{
					$status = $DBFunction->RequestJunkshopItemAdd($junkshopID, $itemName, $itemPrice);
				    if ($status) 
				    {
				        $response["ResponseMessage"] = "Item has been added.";
				    }
				    else
				    {
						$response["ErrorStatus"] = TRUE;
					    $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: G-4JI-AD4)";
				    }
		    	}
	    	echo json_encode($response);
	    }

	    else {
	    	$error_msg = "FATAL WARNING: Unknown request.";
	   		echo $error_msg;
	    }

	} else {
	   $error_msg = "FATAL WARNING: Requirements not found.";
	   echo $error_msg;
	}
?>
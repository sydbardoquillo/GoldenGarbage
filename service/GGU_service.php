<?php
	/**
	* GGU_service.php
	*
	* File to handle all API requests.
	* Accepts POST requests.
	* Each request will be identified by a tag.
	* Response will be JSON data.
	*
	* @category   GoldenGarbageServer
	* @package    com.spectrum.ecoapp.goldengabage
	* @author     Arreglo, Charlie Ahl F. <arreglo.charlieahl@live.com>
	* @copyright  Team Spectrum
	* @version    2.2.0.1
	*/

	if (isset($_POST['tag']) && $_POST['tag'] != '') {
	    $tag = $_POST['tag'];
		require_once __DIR__ . '/GGU_functions.php';
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
	        	$response["AccountID"] = $reply["us_ID"];
	        	$response["AccountName"] = $reply["us_firstname"];
	        }
	        echo json_encode($response);
	    }

	    else if ($tag == 'requestRegister') {
	    	$firstname = $_POST['firstname'];
	   		$lastname = $_POST['lastname'];
	   		$username = $_POST['username'];
	   		$password = $_POST['password'];
	   		if ($DBFunction->IsUserExisted($firstname, $lastname)) {
				$response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = "Sorry, but we might think that you have already an account.";
	   		} else if ($DBFunction->IsUsernameExisted($username)) {
				$response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = "Sorry, username has already been taken.";
	   		} else {
	   			$reply = $DBFunction->RequestRegister($firstname, $lastname, $username, $password);
	   			if ($reply == FALSE) {
	            $response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: 4RE-G04)";
		        } else {
		        	$response["AccountID"] = $reply["us_ID"];
		        	$response["AccountName"] = $reply["us_firstname"];
	        	}
	        }
	        echo json_encode($response);	        	
	    }

	    else if ($tag == 'requestJunkshopList') {
	    	$junkshopList = $DBFunction->RequestJunkshopList();
	    	if ($junkshopList == FALSE) 
	    	{
	    		$response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: 4JK-L04)";
	    	}
	    	else
	    	{
				for($i = 0; $i < count($junkshopList); $i++) {
				    $junkshopListData[] = array('JunkshopName' => $junkshopList[$i]->js_name, 
		    			'Location' => $junkshopList[$i]->js_address, 
		    			'Latitude' => $junkshopList[$i]->js_lat, 
		    			'Longitude' => $junkshopList[$i]->js_log);
				}
			    $response["JunkshopList"] = $junkshopListData;
	    	}
	    	echo json_encode($response);
	    }

	    else if ($tag == 'requestJunkshopInfo') {
			$junkshopName = $_POST['junkshopName'];
	    	$junkshopID = $DBFunction->RequestJunkshopID($junkshopName);
	    	if($junkshopID == FALSE)
	    	{
	    		$response["ErrorStatus"] = TRUE;
	            $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: 4JK-ID4)";
	    	}
	    	else
	    	{
	    		$junkshopInfo = $DBFunction->RequestJunkshopInfo($junkshopID);
	    		if($junkshopID == FALSE)
		    	{
		    		$response["ErrorStatus"] = TRUE;
		            $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: 4JK-IF4)";
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

		else if ($tag == 'requestPostReview') {
	    	$userID = $_POST['userID'];
	    	$junkshopName = $_POST['junkshopName'];
	    	$userComment = $_POST['userComment'];
	    	$userRating = $_POST['userRating'];
			if ($DBFunction->requestPostReview($userID, $junkshopName, $userComment, $userRating))
			{
				$response["ErrorStatus"] = FALSE;
				$response["RespondMessage"] = "Comment has been added sucessfully.";
			}
			else
			{
				$response["ErrorStatus"] = TRUE;
		        $response["ErrorMessage"] = "Sorry, there's a problem within our service. Please, try again later.\n(Error: 4JK-PR4)";
			}
			echo json_encode($response);
		}

		else if ($tag == 'requestSearchItem') {
	    	$itemName = $_POST['itemName'];
	    	$junkshopSearchItems = $DBFunction->requestSearchItem($itemName);
	    	if($junkshopSearchItems == FALSE)
		    {
		    	$response["ErrorStatus"] = TRUE;
		        $response["ErrorMessage"] = "No Items Found";
		    }
		    else
		    {
		    	for($i = 0; $i < count($junkshopSearchItems); $i++) {
				    $junkshopSearchListData[] = array('ItemName' => $junkshopSearchItems[$i]->js_item_name,
				    	'ItemPrice' => $junkshopSearchItems[$i]->js_item_price,
				    	'JunkshopName' => $junkshopSearchItems[$i]->js_name,
				    	'JunkshopAddress' => $junkshopSearchItems[$i]->js_address,
				    	'JunkshopPickUp' => $junkshopSearchItems[$i]->js_pickup_flag);
				}
			    $response["SearchResult"] = $junkshopSearchListData;
		    }
			echo json_encode($response);
		}

	    else {
	    	$error_msg = "FATAL WARNING: Unknown request";
	   		echo $error_msg;
	    }

	} else {
	   $error_msg = "FATAL WARNING: Requirements not found.";
	   echo $error_msg;
	}
?>
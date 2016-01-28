<?php
	/**
     * GGU_functions.php
     *
     * File to handle all connections to the database.
     *
     * @category   GoldenGarbageServer
     * @package    com.spectrum.ecoapp.goldengarbage
     * @author     Arreglo, Charlie Ahl F. <arreglo.charlieahl@live.com>
     * @author     Sotto, Antonio Jr. O. <antoniosottojr@gmail.com> 	
     * @copyright  Team Spectrum
     * @version    2.2.0.1
     */

	class DB_Functions {
	 
	    private $db;

	    function __construct() {
	        require_once __DIR__ . '/GG_connect.php';
	        $this->db = new DB_Connect();
	        $this->db->connect();
	    }
	 
	    function __destruct() {}

	    public function RequestLogin($username, $password) {
	        $result = mysql_query("SELECT * FROM tb_us_account, tb_us_info WHERE tb_us_account.us_ID = tb_us_info.us_ID AND tb_us_account.js_username = '$username'") or die(mysql_error());
	        if (mysql_num_rows($result) != 0) {
	            $result = mysql_fetch_array($result);
	            $ecokey = $result['js_key'];
	            $encrypted_password = $result['js_password'];
	            $hash = $this->checkhashSSHA($ecokey,  $password);
	            if ($encrypted_password == $hash) {
	                return $result;
	            }
	        } else {
	            return false;
	        }
	    }

	    public function RequestRegister($firstname, $lastname, $username, $address, $password) {
	    	$counter = mysql_query("SELECT * FROM tb_us_account");
			$accountNumber = mysql_num_rows($counter) + 1;
			$accountID = "GGU" . $accountNumber;

			$hash = $this->hashSSHA($password);
	        $encrypted_password = $hash["encrypted"];
	        $ecokey = $hash["ecokey"];

	    	$result = mysql_query("INSERT INTO tb_us_info VALUES ('$accountID','$firstname','$lastname', '$address')");
	    	$result = mysql_query("INSERT INTO tb_us_account VALUES ('$accountID','$username','$encrypted_password','$ecokey')");

	        if ($result) {
	            $result = mysql_query("SELECT * FROM tb_us_account, tb_us_info WHERE tb_us_account.us_ID = tb_us_info.us_ID AND tb_us_account.js_username = '$username'");
	            return mysql_fetch_array($result);
	        } else {
	            return false;
	        }
	    }

	    public function IsUsernameExisted($username) {
	    	$result = mysql_query("SELECT * FROM tb_us_account WHERE tb_us_account.js_username = '$username'");
	        if(mysql_num_rows($result) != 0)
	        	return true;
	        else
	        	return false;
	    }

	    public function IsUserExisted($firstname, $lastname) {
	    	$result = mysql_query("SELECT * FROM tb_us_info WHERE tb_us_info.us_firstname = '$firstname' AND tb_us_info.us_lastname = '$lastname'");
	    	if(mysql_num_rows($result) != 0)
	        	return true;
	        else
	        	return false;
	    }	   

	     public function RequestJunkshopList() {
	    	$result = mysql_query("SELECT tb_js_info.js_name, tb_js_info.js_address, tb_js_info.js_lat , tb_js_info.js_log FROM tb_js_info");
        	if(mysql_num_rows($result) != 0)
        	{
        		while($junkshopEntity = mysql_fetch_object($result))
	        	{
	        		$junkshopList[] = $junkshopEntity;
	        	}
	        	return $junkshopList;
        	}
        	else
        		return false;
	    }

	    public function RequestJunkshopID($junkshopName) {
	    	$result = mysql_query("SELECT tb_js_info.js_ID FROM tb_js_info WHERE tb_js_info.js_name = '$junkshopName'");
	    	if(mysql_num_rows($result) != 0)
	    	{
	    		$junkshopEntity = mysql_fetch_object($result);
	    		return $junkshopEntity->js_ID;
	    	}
	    	else
	    		return false;
	    }

	    public function RequestJunkshopInfo($junkshopID) {
	    	$result = mysql_query("SELECT tb_js_info.js_owner, tb_js_info.js_contact_number, tb_js_info.js_pickup_flag FROM tb_js_info WHERE tb_js_info.js_ID = '$junkshopID'");
	    	if(mysql_num_rows($result) != 0)
	    	{
	    		$junkshopEntity = mysql_fetch_array($result);
	    		return $junkshopEntity;
	    	}
	    	else
	    		return false;
	    }

	    public function RequestJunkshopItems($junkshopID) {
	    	$result = mysql_query("SELECT tb_js_items.js_item_name, tb_js_items.js_item_price FROM tb_js_items WHERE tb_js_items.js_ID = '$junkshopID'");
	    	if(mysql_num_rows($result) != 0)
	    	{
	    		while($junkshopItemEntity = mysql_fetch_object($result))
	        	{
	        		$junkshopItemsList[] = $junkshopItemEntity;
	        	}
	        	return $junkshopItemsList;
	    	}
	    	else
	    		return false;
	    }

	    public function RequestJunkshopComments($junkshopID) {
	    	$result = mysql_query("SELECT (SELECT CONCAT(tb_us_info.us_firstname,' ',tb_us_info.us_lastname) FROM tb_us_info WHERE tb_us_info.us_ID=tb_js_reviews.us_ID) AS js_fullname, tb_js_reviews.js_star, tb_js_reviews.js_comment FROM tb_js_reviews WHERE tb_js_reviews.js_ID='$junkshopID' ORDER BY tb_js_reviews.comment_date DESC");
	    	if(mysql_num_rows($result) != 0)
	    	{
	    		while($junkshopCommentEntity = mysql_fetch_object($result))
	        	{
	        		$junkshopCommentsList[] = $junkshopCommentEntity;
	        	}
	        	return $junkshopCommentsList;
	    	}
	    	else
	    		return false;
	    }

	    /*function added by AOSJr, 01.29.16*/
	    public function hasUserReviewed($userID, $junkshopID){
	    	
	    	if($junkshopID != false)
	    	{
	    		$result = mysql_query("SELECT tb_js_reviews.us_ID FROM tb_js_reviews WHERE tb_js_reviews.js_ID = '$junkshopID' AND tb_js_reviews.us_ID = '$userID'");
	    		if(mysql_num_rows($result) != 0)
    			{
    				return true;
    			}
	    		else
	    		{
	    			return false;
	    		}

	    	}
	    }
	    
	    public function RequestPostReview($userID, $junkshopName, $userComment, $userRating) {
	    	$junkshopID = $this->RequestJunkshopID($junkshopName);
	    	$hasUserReviewed = $this->hasUserReviewed($userID, $junkshopID);
	    	if ($junkshopID != false) 
	    	{
	    		$numberOfComments = $this->RequestReviewCount();
				$commentID = $numberOfComments + 1;
	    		$dateToday = date("Y-m-d");	 

	    		if($numberOfComments != false)
	    		{
	    			if($hasUserReviewed == true) 
	    			{
	    				mysql_query("UPDATE tb_js_reviews SET tb_js_reviews.js_star = '$userRating', tb_js_reviews.js_comment = '$userComment', tb_js_reviews.comment_date = '$dateToday' WHERE tb_js_reviews.js_ID = '$junkshopID' AND tb_js_reviews.us_ID = '$userID'");	    			
	    				return true;
	    			}
	    			else
	    			{
	    				mysql_query("INSERT INTO tb_js_reviews VALUES ('$commentID','$junkshopID','$userID', '$userRating','$userComment','$dateToday')");
	    				return true;
	    			}
	    		}
	    		else
	    		{
	    			return false;
	    		}
	    	}
	    	else
	    	{
	    		return false;
	    	}
	    }


	    public function RequestReviewCount() {
	    	$result = mysql_query("SELECT * FROM tb_js_reviews");
			if(mysql_num_rows($result) != 0)
			{
				return mysql_num_rows($result);
			}
			else
			{
				return false;
			}
	    }

 		public function requestSearchItem($itemName) {
	    	$result = mysql_query("SELECT tb_js_items.js_item_name, tb_js_items.js_item_price, tb_js_info.js_name, tb_js_info.js_address, tb_js_info.js_pickup_flag FROM tb_js_info INNER JOIN tb_js_items ON tb_js_info.js_ID = tb_js_items.js_ID WHERE tb_js_items.js_item_name LIKE '%$itemName%' ORDER BY tb_js_info.js_pickup_flag DESC, tb_js_items.js_item_price DESC");
			if(mysql_num_rows($result) != 0)
			{
				while($junkshopSearchItemEntity = mysql_fetch_object($result))
	        	{
	        		$junkshopSearchItemList[] = $junkshopSearchItemEntity;
	        	}
	        	return $junkshopSearchItemList;
			}
			else
			{
				return false;
			}
	    }

	    public function hashSSHA($password) {
	        $ecokey = sha1(rand());
	        $ecokey = substr($ecokey, 0, 10);
	        $encrypted = base64_encode(sha1($password . $ecokey, true) . $ecokey);
	        $hash = array("ecokey" => $ecokey, "encrypted" => $encrypted);
	        return $hash;
	    }
	 
	    public function checkhashSSHA($ecokey, $password) {
	        $hash = base64_encode(sha1($password . $ecokey, true) . $ecokey);
	        return $hash;
	    }

	    /*function added by AOSJR, 01.28.16*/
	    public function RequestUserInfo($userID){
	    	$result = mysql_query("SELECT * FROM tb_us_info WHERE tb_us_info.us_ID = '$userID'");
	    	if(mysql_num_rows($result) != 0)
	    	{
	    		$userEntity = mysql_fetch_array($result);
	    		return $userEntity;
	    	}
	    	else
	    		return false;
	    }

	     public function IsUserIDExist($userID){
	    	$result = mysql_query("SELECT * FROM tb_us_info WHERE tb_us_info.us_ID = '$userID'");
	    	if(mysql_num_rows($result) != 0)
	        	return true;
	        else
	        	return false;
	    }

	    public function RequestUserUpdate($userID, $firstname, $lastname, $address){
	    	if($this->IsUserIDExist($userID) == false)
	    	{
	    		return false;
	    	}
	    	else
	    	{
	    		$result = mysql_query("UPDATE tb_us_info SET tb_us_info.us_firstname = '$firstname', tb_us_info.us_lastname = '$lastname', tb_us_info.us_address = '$address' WHERE tb_us_info.us_ID = '$userID'");
	    		return true;
	    	}
	    }

	    public function RequestPasswordUpdate($userID, $password, $newPassword){
	    	$result = mysql_query("SELECT * FROM tb_us_account WHERE tb_us_account.us_ID = '$userID'") or die(mysql_error());
	        if (mysql_num_rows($result) != 0) {
	        	$result = mysql_fetch_array($result);
	            $ecokey = $result['js_key'];
	            $encrypted_password = $result['js_password'];
	            $hash = $this->checkhashSSHA($ecokey,  $password);


	            if ($encrypted_password != $hash) {
	            	return false;
	            }
	            else
	            {
	            	$hash_newPass = $this->hashSSHA($newPassword);
	            	$encrypted_newPass = $hash_newPass["encrypted"];
	            	$ecokey_new = $hash_newPass["ecokey"];

	            	mysql_query("UPDATE tb_us_account SET tb_us_account.js_password = '$encrypted_newPass', tb_us_account.js_key = '$ecokey_new' WHERE tb_us_account.us_ID= '$userID'");
	                return true;	            	
	            }
	        }
	        else 
	        {
	            return false;
	        }
	    }

	    
	}
?>

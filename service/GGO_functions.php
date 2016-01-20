<?php
	/**
     * GGO_functions.php
     *
     * File to handle all connections to the database.
     *
     * @category   GoldenGarbageServer
     * @package    com.spectrum.ecoapp.goldengabage
     * @author     Arreglo, Charlie Ahl F. <arreglo.charlieahl@live.com>
     * @copyright  Team Spectrum
     * @version    2.1.0.0
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
	    	$result = mysql_query("SELECT * FROM tb_js_account WHERE tb_js_account.js_username = '$username'") or die(mysql_error());
	        if (mysql_num_rows($result) != 0) {
	            $result = mysql_fetch_array($result);
	            $ecokey = $result['js_key'];
	            $encrypted_password = $result['js_password'];
	            $hash = $this->checkhashSSHA($ecokey,  $password);
	            if ($encrypted_password == $hash) {
	                return $result['js_ID'];
	            }
	        } else {
	            return false;
	        }
	    }

	    public function VerifyCode($activationCode) {
	    	$result = mysql_query("SELECT * FROM tb_js_account WHERE tb_js_account.js_activation = '$activationCode'");
	    	$reply['status'] = false;
	    	$reply['message'] = "Sorry, but the registration code is invalid.\nPlease, try again later...";
	    	if(mysql_num_rows($result) != 0)
	    	{
	    		$resultEntity = mysql_fetch_object($result);
	    		$reply['message'] = "Sorry, but the registration code has already an account.\nPlease, contact our customer service for help.";
	    		if($resultEntity->js_active_flag == 0) {
	        		$reply['status'] = true;
	        		$reply['junkshopID'] = $resultEntity->js_ID;
	        	}
	        }
	        return $reply;
	    }

	    public function IsUsernameExisted($username) {
	    	$result = mysql_query("SELECT * FROM tb_js_account WHERE tb_js_account.js_username = '$username'");
	        if(mysql_num_rows($result) != 0)
	        	return true;
	        else
	        	return false;
	    }

		public function RequestRegister($junkshopID, $username, $password) {
			$hash = $this->hashSSHA($password);
	        $encrypted_password = $hash["encrypted"];
	        $ecokey = $hash["ecokey"];
	    	$result = mysql_query("UPDATE tb_js_account SET tb_js_account.js_active_flag = 1, tb_js_account.js_username = '$username', tb_js_account.js_password = '$encrypted_password', tb_js_account.js_key = '$ecokey' WHERE tb_js_account.js_ID = '$junkshopID'");
	    	if ($result) {
	            return $junkshopID;
	        } else {
	            return false;
	        }
	    }

	     public function RequestJunkshopInfo($junkshopID) {
	    	$result = mysql_query("SELECT tb_js_info.js_name, tb_js_info.js_address, tb_js_info.js_owner, tb_js_info.js_contact_number, tb_js_info.js_pickup_flag FROM tb_js_info WHERE tb_js_info.js_ID = '$junkshopID'");
	    	if(mysql_num_rows($result) != 0)
	    	{
	    		$junkshopEntity = mysql_fetch_array($result);
	    		return $junkshopEntity;
	    	}
	    	else
	    		return false;
	    }

	    public function RequestJunkshopItems($junkshopID) {
	    	$result = mysql_query("SELECT tb_js_items.item_ID, tb_js_items.js_item_name, tb_js_items.js_item_price FROM tb_js_items WHERE tb_js_items.js_ID = '$junkshopID'");
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
	    	$result = mysql_query("SELECT (SELECT CONCAT(tb_us_info.us_firstname,' ',tb_us_info.us_lastname) FROM tb_us_info WHERE tb_us_info.us_ID=tb_js_reviews.us_ID) AS js_fullname, tb_js_reviews.js_star, tb_js_reviews.js_comment FROM tb_js_reviews WHERE tb_js_reviews.js_ID='$junkshopID' ORDER BY tb_js_reviews.comment_date");
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

	    public function RequestJunkshopList() {
	    	$result = mysql_query("SELECT tb_js_info.js_ID, tb_js_info.js_name, tb_js_info.js_address, tb_js_info.js_lat , tb_js_info.js_log FROM tb_js_info");
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

	    public function RequestJunkshopInfoUpdate($junkshopID, $junkshopOwnerName, $junkshopContact, $junkshopPickUpStatus) {
			$result = mysql_query("UPDATE tb_js_info SET tb_js_info.js_owner = '$junkshopOwnerName' , tb_js_info.js_contact_number = '$junkshopContact', tb_js_info.js_pickup_flag ='$junkshopPickUpStatus' WHERE tb_js_info.js_ID = '$junkshopID'") or die(mysql_error());
			if($result)
	    		return true;
	    	else
	    		return false;
	    }

	    public function RequestJunkshopItemDelete($itemID, $junkshopID) {
			$result = mysql_query("DELETE FROM tb_js_items WHERE tb_js_items.js_ID = '$junkshopID' AND tb_js_items.item_ID = '$itemID'") or die(mysql_error());
			if($result)
	    		return true;
	    	else
	    		return false;
	    }

	    public function CheckItemExist($itemID, $junkshopID) {
			$result = mysql_query("SELECT * FROM tb_js_items WHERE tb_js_items.item_ID = '$itemID' AND tb_js_items.js_ID = '$junkshopID'") or die(mysql_error());
			if(mysql_num_rows($result) != 0)
	    		return true;
	    	else
	    		return false;
	    }

	    public function CheckItemNameExistWithoutDuplicate($itemName, $junkshopID, $itemID) {
			$result = mysql_query("SELECT * FROM tb_js_items WHERE tb_js_items.js_item_name = '$itemName' AND tb_js_items.js_ID = '$junkshopID' AND NOT tb_js_items.item_ID = '$itemID'") or die(mysql_error());
			if(mysql_num_rows($result) != 0)
	    		return true;
	    	else
	    		return false;
	    }

	    public function CheckItemNameExist($itemName, $junkshopID) {
			$result = mysql_query("SELECT * FROM tb_js_items WHERE tb_js_items.js_item_name = '$itemName' AND tb_js_items.js_ID = '$junkshopID'") or die(mysql_error());
			if(mysql_num_rows($result) != 0)
	    		return true;
	    	else
	    		return false;
	    }

	    public function RequestJunkshopItemEdit($itemID, $junkshopID, $itemName, $itemPrice) {
			$result = mysql_query("UPDATE tb_js_items SET tb_js_items.js_item_name = '$itemName', tb_js_items.js_item_price = '$itemPrice' WHERE tb_js_items.item_ID = '$itemID' AND tb_js_items.js_ID = '$junkshopID'") or die(mysql_error());
			if($result)
	    		return true;
	    	else
	    		return false;
	    }

	    public function RequestJunkshopItemAdd($junkshopID, $itemName, $itemPrice) {
	    	$result = mysql_query("INSERT INTO tb_js_items(js_ID,js_item_name,js_item_price) VALUES ('$junkshopID', '$itemName', '$itemPrice')") or die(mysql_error());
			if($result)
	    		return true;
	    	else
	    		return false;
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
	}
?>
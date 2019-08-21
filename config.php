<?php
	//$current_page = end(explode('/', $_SERVER['REQUEST_URI']));
	
	$URI = $_SERVER['REQUEST_URI'];
	$strings = explode('/', $URI);
	$current_page = end($strings);

	$servername = "localhost";
	$username = "linn";
	$password = "linn";
	$dbname = "lab3";

	@ $db = new mysqli($servername, $username, $password, $dbname);

	if($db->connect_error){
		echo "I could not connect: " . $db->connect_error;
		exit();
	} 

	$db->set_charset("utf8");

	// only http can read cookie (not js tex)
	ini_set('session.cookie_httponly', true);
	session_start();

	//check if you are logged in by checking if session userrole is set
	function isLoggedIn(){
		return array_key_exists('userrole', $_SESSION);
	}

	//check what access the logged in person has 
	function hasAccess($roles, $index){
		if (isLoggedIn()){
			if (substr($roles, $index,1) == "1") {
				return true;
			}
		}
		return false;
	}

	/* positioner i userroles:
		0         1             2
	+---------+-------------+-----------+
	| 1=admin | 1=moderator | 1=browser |
	+---------+-------------+-----------+*/

	// admin = 111
	function hasAdminAccess(){
		return isLoggedIn() && hasAccess($_SESSION['userrole'], 0);
	}

	// moderator = 011
	function hasModeratorAccess(){
		return isLoggedIn() && hasAccess($_SESSION['userrole'], 1);
	}
	// browser = 001
	function hasBrowserAccess(){
		return isLoggedIn() && hasAccess($_SESSION['userrole'], 2);
	}
	
	//show which access/role the logged in person has on "manage users"
	function getAccess($roles){
		if (hasAccess($roles, 0)){
			return "Administrator";
		}
		if (hasAccess($roles, 1)){
			return "Moderator";
		}
		if (hasAccess($roles, 2)){
			return "Browser";
		}

		return "None";
	}

	function activePage($page, $current){
		if ($page == $current){
			return "active";
		}
		return "";
	}

	//check if a string end with the given extension(tex.jpg)
	//strlen - if negative, it starts counting from the end of the string
	// compare end of name and end of extension and if 0 they are the same
	function endsWith($name, $ext) {
    	return substr_compare(strtolower($name), strtolower($ext), -strlen($ext)) === 0;
	}

	/*if(isset($_SESSION['userip']) && $_SESSION['userip']!==$_SERVER['REMOTE_ADDR']){
	session_unset();
	session_destroy();
}*/
?>
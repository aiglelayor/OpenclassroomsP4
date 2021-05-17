<?php

require_once('Model/UserManager.php');

function userLogin($pseudoconnect, $passconnect)
{
	$userManager = new UserManager();
	$userLogin = $userManager->login($pseudoconnect, $passconnect);

	require('view/postsView.php');
}

// require('manager.php');

// require('userview.php');

// require('userModel.php');

// if(isset($_POST['formconnection']))
// {	
// 	$login = login($_POST['formconnection']);
// }
// else {
// 	echo 'not done';
// }






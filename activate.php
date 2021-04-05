<?php
//var_dump($_GET)
require 'config.php';

//First we check if the email and code exists
if(isset($_GET['email'], $_GET['code'])) {
    if($stmt = $con->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?')) {
        $stmt->bind_param('ss', $_GET['email'], $_GET['code']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
        //Account exists with the requested email and code
        if($stmt = $con->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
        //Set the new activation code to 'activated', this is how we can check if the user activated their account. 
            $newcode = 'activated';
            $stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
            $stmt->execute();
            echo 'Your account has been activated. Way to go!';
        } else {
                echo 'Your account was already activated or doesn\'t exist!';
        }
        }
    }
}
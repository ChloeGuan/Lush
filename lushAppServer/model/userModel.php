<?php
require_once("../model/src/user.php");

function signUp(){
$user = new user;
$user->signUpUser($_POST['username'],$_POST['password'],$_POST['email'],$_POST['displayname']);
}

function logIn(){
$user = new user;
$user->logInUser($_POST['username'],$_POST['password']);
    
}
?>
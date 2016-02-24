<?php
require_once("../model/userModel.php");
require_once("../model/src/utils.php");

if(Utils::isAJAX()){
    if(Utils::isPOST()){
        //creat user
        if(isset($_POST['signUp'])){
            signUp();
        }
        //login
        elseif(isset($_POST['logIn'])){
            logIn();
        }
        //update user
        elseif(isset($_POST['update'])){
           $type = $_POST['column'];
           switch ($type) {
               case "password":
                   $column = "password";
                   $value = md5($_POST['value']);
               break;
               case "displayname":
                   $column = "displayname";
                   $value = $_POST['value'];
               break;
               case "picture":
                   $column = "picture";
                   $value = $_POST['value'];
               break;
               default:
                   echo json_encode("something when wrong");
               break;
           }
        }
        //something neww
    }
}

?>
<?php
//Include local database
require_once("functions.php");
include_once("database.php");

//Adjust header("") filenames to proper pages, once built

//Create login variables
#id is auto increment
#type = if user is root, type=admin. else, type=customer
//User Name Info
$first=mysqli_real_escape_string($conn, $_POST["firstName"]);
$middle=mysqli_real_escape_string($conn, $_POST["middleName"]);
$last=mysqli_real_escape_string($conn, $_POST["lastName"]);
$title=mysqli_real_escape_string($conn, $_POST["title"]);
$suffix=mysqli_real_escape_string($conn, $_POST["suffix"]);
//User Account Info
$email=mysqli_real_escape_string($conn, $_POST["email"]);
$uid=mysqli_real_escape_string($conn, $_POST["username"]);
$pwd=mysqli_real_escape_string($conn, $_POST["password"]);
$confirmPwd=mysqli_real_escape_string($conn, $_POST["confirmPwd"]);
//User Bio Info
$dob=mysqli_real_escape_string($conn, $_POST["DOB"]);
$sex=mysqli_real_escape_string($conn, $_POST["sex"]);
$street=mysqli_real_escape_string($conn, $_POST["street"]); 
$city=mysqli_real_escape_string($conn, $_POST["city"]);
$state=mysqli_real_escape_string($conn, $_POST["state"]);
$zip=mysqli_real_escape_string($conn, $_POST["zip"]);
$country=mysqli_real_escape_string($conn, $_POST["country"]);
$phone=mysqli_real_escape_string($conn, $_POST["phone"]);
//Security Questions
$sq1=mysqli_real_escape_string($conn, $_POST["sq1"]);
$sq2=mysqli_real_escape_string($conn, $_POST["sq2"]);
$sq3=mysqli_real_escape_string($conn, $_POST["sq3"]);
$sa1=mysqli_real_escape_string($conn, $_POST["sa1"]);
$sa2=mysqli_real_escape_string($conn, $_POST["sa2"]);
$sa3=mysqli_real_escape_string($conn, $_POST["sa3"]);
//Misc. Info
$captcha=mysqli_real_escape_string($conn, $_POST["captcha"]); 
$newsletter=mysqli_real_escape_string($conn, $_POST["newsletter"]); 
$privacy=mysqli_real_escape_string($conn, $_POST["privacyPolicy"]);
//card id

$missingAdminField=empty($first)||empty($last)||empty($email)||empty($pwd)||empty($confirmPwd)||empty($captcha);
$missingCustomerField=$missingAdminField||empty($uid)||empty($dob)||empty($sex)||empty($captcha)||empty($privacy)||empty($street)||empty($city)||empty($state)||empty($zip)||empty($country)||empty($sq1)||empty($sq2)||empty($sq3)||empty($sa1)||empty($sa2)||empty($sa3);

//Signup Verification

//Check if the button is set
if (!isset($_POST['$registerBtn'])){
    header("Location: ../client/templates/register.html?signup=unsetButton"); 
    exit();
}
else{
    //Checks if admin submitted all necessary information
    if(isAdminLoggedIn() && $missingAdminField){
        header("Location: ../client/templates/register.html?signup=missingField"); 
        exit();
    }
    //Checks if customer submitted all necessary information
    else if($missingCustomerField){
        header("Location: ../client/templates/register.html?signup=missingField");
        exit();
    }
    else{
        //Check if email is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../client/templates/register.html?signup=invaidEmail");
            exit();
        }
        else{
            //Check if password is secure
            if(strlen($pwd)<=10){
                header("Location: ../client/templates/register.html?signup=insecurePwd");
                exit();
            }
            else{
                //Check if passwords match
                if ($pwd!=$confirmPwd){
                    header("Location: ../client/templates/register.html?signup=confirmPwd");
                    exit();
                }
                else{
                    //Check if age is valid
                    $lowestDob=strtotime(1900-1-1);
                    if($dob<$lowestDob){
                        header("Location: ../client/templates/register.html?signup=invalidAge");
                        exit();
                    }
                    else{
                        //Check if the CAPTCHA is correct
                        if($captcha!="4"){
                            header("Location: customer_register.php?signup=CAPTCHAError");
                            exit();
                        }
                        else{
                            //Check if the privacy policy was accepted
                            if(!isset($_POST["privacy"])){
                                header("Location: customer_register.php?signup=privacyError");
                                exit();
                            }
                            else{
                                //Check if the username is taken
                                //query the database against the username variable
                                //if there is a match, redirect to register form
                                //else hash the password with md5() and use a mysql insert to insert data into database. redirect to user dashboard
                                header("Location: ../client/templates/index.php?signup=unsetButton;
                            }
                        }
                    }
                }
            }
        }
    }
}
?>
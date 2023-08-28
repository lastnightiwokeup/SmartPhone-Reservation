<?php
   /* Name: Leung Tsz Ki Connie, Student ID: 21070955S */

   session_start(); // start the session
   require('db.php'); // so that the functon from db.php can be use here

   // Clear the session that containing error msg after entered a valid input.
   unset($_SESSION['fnameError'], $_SESSION['lnameError'], $_SESSION['emailError'], $_SESSION['mobileError'],
         $_SESSION['storeError'], $_SESSION['modelError'], $_SESSION['dateError']);

   unset($_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['mobile'],
         $_SESSION['store'], $_SESSION['model'], $_SESSION['pickup']);


   // First name validation
   if (isset($_POST['fname']) && !empty($_POST['fname'])) {

      // Apply a regular expression to check if the input only can incldue a-z, A-Z and space character.
      // While a-z : lower cases, A-Z : upper cases, \s : space, 
      // ^ & $: matches lines that consist entirely of [a-zA-Z\s] <- which is the user input name.
      // + : represents one or more characters can be input eg. Bobby, to ensure the "bb" inside Bobby is valid.
      // {2,19} : to limit the field must be larger than 1 and less than 20 characters.
      if(preg_match("/^[a-zA-Z\s]{2,19}+$/", $_POST['fname'])){
         $_SESSION['fname'] = trim($_POST['fname']);
      }
      // Otherwise, notify user the input format is not valid
      else {
         $_SESSION['fnameError']  = " (First name cannot contain symbols & numbers)<br/>";
      } 
      // Notify user first name is a required field
   } else {
      $_SESSION['fnameError']  = " (First name cannot be empty)<br/>";
   }

   // Last name validation
   if (isset($_POST['lname']) && !empty($_POST['lname'])) {

      // Apply a regular expression for checking the format which similar to fname
      if(preg_match("/^[a-zA-Z\s]{2,19}+$/", $_POST['lname'])){
      $_SESSION['lname'] = trim($_POST['lname']);
      }
      // Otherwise, notify user the input format is not valid
      else{
      $_SESSION['lnameError']  = " (Last name cannot contain symbols & numbers)<br/>";
      }
      // Notify user last name is a required field
   } else {
      $_SESSION['lnameError']  = " (Last name cannot be empty)<br/>";
   }

   // Email validation
   if (isset($_POST['email']) && !empty($_POST['email'])) {
      $_SESSION['email'] = trim($_POST['email']);
      }
      // Notify user if the email is not entered
      else {
      $_SESSION['emailError'] = " (Email cannot be empty)<br/>";
   }

   // Mobile number validation
   if (isset($_POST['mobile']) && !empty($_POST['mobile'])) {
         // Apply a regular expression to check if the input character is equal to 8 & include 0-9 characters only
         // (While [0-9] : digit, {8} : 8 characters only) and
         // the mobile number is duplicated before store into session.  
         if (preg_match("/^[0-9]{8}$/", $_POST['mobile'])) { 
            if (isPhoneDuplicate($_POST['mobile'])) {
               $_SESSION['mobile'] = trim($_POST['mobile']);
            // An error msg will be shown to user after checking for duplication.
            } else {
               $_SESSION['mobileError'] = " (Your mobile number is duplicated)<br/>";   
            }
         // Notify user if the format is incorrect.
         } else {
            $_SESSION['mobileError'] = " (Mobile number should be 8 digitals & numbers only)<br/>";
         }  
      // Notify user if the mobile field is empty.
   } else {
      $_SESSION['mobileError'] = " (Mobile number cannot be empty)<br/>";
   }           

   // Model validation
   if (isset($_POST['model']) && !empty($_POST['model'])) {
      $_SESSION['model'] = $_POST['model'];
      // Notify user if the model is not selected.
   } else {
      $_SESSION['modelError'] = " (Please choose a model)<br/>";
   }


   // Store validation
   if (isset($_POST['store']) && !empty($_POST['store'])) {
      $_SESSION['store'] = $_POST['store']; 
      // Notify user if the pickup store is not selected.   
   }  else{
      $_SESSION['storeError'] = " (Please choose a pickup store)<br/>";
   }


   // Create a function that check the user's pickup date is within 2 days to 2 weeks later
   function datePeriod($buf) {
      try {
         $dt = new DateTime (trim($buf));
      }
      catch(Exception $e){
         return false;    
      }
         // Set those variables in the format of Y,d and m 
         $month = $dt -> format ('m');
         $day = $dt -> format ('d');
         $year = $dt -> format ('Y');
         // Check the validity of the date and set the date period of pickup date using strtotime
         if( checkdate($month, $day, $year) && 
            $buf >= date('Y-m-d', strtotime('+2 days')) && 
            $buf<=date('Y-m-d', strtotime('+2 weeks'))) {
            return true;
         }
         else{
            return false;
         }
   }
   // Pickup date validation
   if (isset($_POST['pickup']) && !empty($_POST['pickup'])) {
      // Check if the date from the user input is within the pickup period
      if(datePeriod($_POST['pickup'])) {
         $_SESSION['pickup'] = $_POST['pickup'];
      }
      // Otherwise, notify user to choose a valid date 
      else {
         $_SESSION['dateError']  = " (The date is invalid) <br/>";
      }
   // Notify user if the pickup date field is empty
   } else {
      $_SESSION['dateError'] = " (Please choose a pickup date) <br/>";
   }


   // Make sure all the fields have values and insert them into database
   if (isset($_SESSION['fname']) && isset($_SESSION['lname']) && isset($_SESSION['email']) &&
      isset($_SESSION['model']) && isset($_SESSION['store']) && isset($_SESSION['pickup']) && isset($_SESSION['mobile'])) {     
      insertIntoTable(); 
   // Otherwise, redirect to the main page 
   } else {
      $_SESSION['addFailed'] = "There're some missing fields, please try again!";
      header('Location: reserve.php');
   }

?>
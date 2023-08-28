<?php 
/* Name: Leung Tsz Ki Connie, Student ID: 21070955S */
    session_start();
?>
<!-- Bootstrap is included for UI -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <title>Reserve and Pick Up</title>
    <a href="index.html" class="btn btn-secondary">Back to Home Page</a>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- styling using external css -->
    <link rel="stylesheet" href="./css/reservepage.css">
</head>
    
    <body id="page-top">
        <?php

            // If the user input is inserted into database table successfully, a success msg will be stored in session,
            // and show to user, then unset all the session
            if (isset($_SESSION['addSuccess']) && !empty($_SESSION['addSuccess'])) {
                echo '<br/>'. '<br/>'.'<div class="alert alert-success" role="alert">' . $_SESSION['addSuccess'] . '</div>';                
                session_unset();
            }
            // Error msg shows to user if there's any missing fileld
            if (isset($_SESSION['addFailed']) && !empty($_SESSION['addFailed'])) {
                echo '<br/>'. '<br/>'.'<div class="alert alert-danger" role="alert">' . $_SESSION['addFailed'] . '</div>';
                // Unset the session afer each time of showing error msg,
                // t000o avoid there's still an error msg even the input is added successfully.
                unset($_SESSION['addFailed']); 
            } 
        ?>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="index.php">Sunny Mobile</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home Page</a></li>
                    <li class="nav-item"><a class="nav-link" name="loginButton" href="adminlogin.php">Admin Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="reserve.php">Reserve Now!</a></li>
                </ul>

            </div>
        </div>
    </nav>        
<br/><br/><br/>

     
            

        <form method="POST" action="validateForm.php" id="inputForm" class="row g-3"> 
            <h1 style="text-align:center;">Reserve and Pick Up</h1>
            <!-- smartphone logo -->
            <img src="./img/phone.jpg" alt="phone" style="width:9%">
            <h3 style="text-align:center;"><u>Your Contact</u></h3>
            <p style="text-align:center;"><b>Input correct information so that we can contact you.</b></p>

            <!-- All the user are retained on the form before the refresh or submit the form by echoing the
            SESSION value using php, so that the cutsomers need not to input the data again and again even 
            they are encountering any errors or entered an invalid value. -->

            <!-- first name field -->
            <div class="col-md-6">
                <label for="fname" class="form-label">First Name</label>
                <!-- Limit the input limit between 2 to 19 using maxlength & maxlength
                    as this field must be larger than 1 and less than 20 of characters-->
                <input id="fname" class="form-control" type="text" name="fname" minlength="2" maxlength="19" placeholder="Siu Ming" value="<?php echo isset($_SESSION['fname']) ? $_SESSION['fname'] : '' ?>">
                    <p style="text-align:center" class= "pError">
                        <?php
                            // Show error msg if the first name is not entered or valid
                            if(isset($_SESSION['fnameError'])) print_r ($_SESSION['fnameError']);
                        ?>
                    </p>
            </div>

            <!-- last name field -->                   
            <div class="col-md-6">
                <label for="lname" class="form-label">Last Name</label>
                <!-- Limit the input limit between 2 to 19 using maxlength & maxlength
                    as this field must be larger than 1 and less than 20 of characters-->
                <input id="lname" class="form-control" type="text" name="lname" minlength="2" maxlength="19" placeholder="Chan" value="<?php echo isset($_SESSION['lname']) ? $_SESSION['lname'] : '' ?>" />
                    <p style="text-align:center" class= "pError">
                    <?php
                        // Show error msg if the Last name is not entered or valid
                        if(isset($_SESSION['lnameError'])) print_r($_SESSION['lnameError']);
                    ?>
                    </p>
            </div>

            <!-- email field -->
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@abc.com" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>">
                    <p style="text-align:center" class= "pError">
                    <?php
                        // Show error msg if the email is not entered 
                        if(isset($_SESSION['emailError'])) print_r($_SESSION['emailError']);
                    ?>
                    </p>
            </div>


            <!-- mobile field -->
            <div class="col-md-6">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="########" value="<?php echo isset($_SESSION['mobile']) ? $_SESSION['mobile'] : '' ?>">
                    <p style="text-align:center" class= "pError">
                        <?php
                            // Show error msg if the mobile no. is not entered, valid or duplicated
                            if(isset($_SESSION['mobileError'])) print_r($_SESSION['mobileError']);
                        ?>
                    </p>
            </div>

            <h3 style="text-align:center;"><u>Product Information</u></h3>
            <p style="text-align:center;"><b>Please choose the pickup Date, Store & Model for the product.</b></p>

            <!-- Model selection field-->
            <div class="col-md-6"> 
                <label for="model" class="form-label">Model</label>
                <select name="model" id="model" class="form-select">
                    <option value="" disabled selected>Please select a model</option>
                    <option value="1" <?php if(isset($_SESSION['model']) && $_SESSION['model'] == '1') echo 'selected';?>>16 GB</option>
                    <option value="2" <?php if(isset($_SESSION['model']) && $_SESSION['model'] == '2') echo 'selected';?>>32 GB</option>
                    <option value="3" <?php if(isset($_SESSION['model']) && $_SESSION['model'] == '3') echo 'selected';?>>64 GB</option>
                    <option value="4" <?php if(isset($_SESSION['model']) && $_SESSION['model'] == '4') echo 'selected';?>>128 GB</option>
                </select>  
                <p style="text-align:center" class= "pError">
                    <?php
                    // Show error msg if the model is not selected
                    if(isset($_SESSION['modelError'])) print_r($_SESSION['modelError']);
                    ?>
                </p>
            </div>


            <!-- Store selection field-->
            <div class="col-md-6"> 
                <label for="store" class="form-label">Pickup Store</label>
                <select name="store" id="store" class="form-select">
                    <option value="" disabled selected>Please select a pickup store</option>
                    <option value="1" <?php if(isset($_SESSION['store']) && $_SESSION['store'] == '1') echo 'selected';?>>IFC Mall</option>
                    <option value="2" <?php if(isset($_SESSION['store']) && $_SESSION['store'] == '2') echo 'selected';?>>Festival Walk</option>
                    <option value="3" <?php if(isset($_SESSION['store']) && $_SESSION['store'] == '3') echo 'selected';?>>Hysan Place</option>
                    <option value="4" <?php if(isset($_SESSION['store']) && $_SESSION['store'] == '4') echo 'selected';?>>APM</option>
                </select>  
                    <p style="text-align:center" class= "pError">
                    <?php
                    // Show error msg if the store is not selected
                    if(isset($_SESSION['storeError'])) print_r($_SESSION['storeError']);
                    ?>
            </div>

        <!-- pickup date field --> 
            <div class="col-md-6">
                <label for="date" class="form-label">Pickup Date</label>
                        <i> (Reservation is available starting from 2 days later to 2 weeks.)</i>

                    <input id="pickup" class="form-control" type="date" name="pickup" value="<?php echo isset($_SESSION['pickup']) ? $_SESSION['pickup'] : '' ?>">
                    <p style="text-align:center" class= "pError">
                    <?php
                    // Show error msg if the date is not selected or valid
                    if(isset($_SESSION['dateError'])) print_r($_SESSION['dateError']);
                    ?></p>
            </div>

            <!-- Sumbit & Reset button section-->
            <div class="col-6">   
                <p style="text-align:center;">
                    <input type="submit" class="btn btn-primary" name = "submitbtn" value="Submit Form"> 
                    <button type="button" class="btn btn-primary" onclick="resetForm();">Reset</button>
                </p>
            </div>
        </form>

        <?php
            // The retained value of all input field will only be shown once,
            // after the user refresh the page, all the session stored user input value will be unset
            unset($_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['mobile'],
                  $_SESSION['store'], $_SESSION['model'], $_SESSION['pickup']);
        ?>

        
    <script src="./js/scriptreset.js"></script>
</body>

</html>
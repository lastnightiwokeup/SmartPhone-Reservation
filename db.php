<?php
/* Name: Leung Tsz Ki Connie, Student ID: 21070955S */
    session_start(); //start the session

    // Connect to database
    function setupDBConnection() {
        $conn = mysqli_connect('localhost', 'root', '', 'sehs4517');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    // Get that all the user input from database
    function selectAllData($num) {
        $conn = setupDBConnection();
        $sort = "";
        // There're 4 cases that used for sorting from the data from database for admin,
        // Eg. If 2 is used as parameter, then the "pickup" from the table will be selected then break out the switch statement.
        switch ($num){  
            case 1 : $sort = "id"; break;
            case 2 : $sort = "pickup"; break;
            case 3 : $sort = "fname"; break;
            case 4 : $sort = "lname"; break;
        }
        // Sort all the result in ascending order using ORDER BY
        $sql = "SELECT * FROM `reservation` ORDER BY `" . $sort . "` ASC;";
        $result = mysqli_query($conn, $sql);
        // return result that fulfil the case in the switch statement
        return $result;
    }
    
    
    // Check if the mobile phone is duplicated 
    function isPhoneDuplicate($value) {
        $conn = setupDBConnection();
        // Store the mobile data from the table into $sql 
        // The $value between '%" is to make sure the whole phone number is selected. 
        $sql = "SELECT * FROM `reservation` WHERE `mobile` LIKE '%" . $value . "%'";
        $result = mysqli_query($conn, $sql);

        // In this case, is to check if there's no any data in row,
        // if there's no data which mysqli_num_rows($result)<=0,  it means the mobile phone no. is not duplicated.
        // If there's data which mysqli_num_rows($result) >= 1, then means the no. is duplicated.
        if ( mysqli_num_rows($result) <= 0) {
            return true;
        }  else {
            return false; 
        }
    }

    // Filter the table by mobile no. at the admin.php
    function mobileFilter($searchStr) {
        $conn = setupDBConnection();
        // Similar the isPhoneDuplicate() function, store the mobile data from table into $sql
        $sql = "SELECT * FROM `reservation` WHERE `mobile` LIKE '%" . $searchStr . "%'";
        $result = mysqli_query($conn, $sql);
        
        return $result;
    }

    // Insert all the fields from the user input into table
    function insertIntoTable() {
        $conn = mysqli_connect('localhost', 'root', '', 'sehs4517');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully<br/>";
        // Create a variable that store the user input from the session and insert into table
        $stmt = "insert into reservation(store,model,fname,lname,email,mobile,pickup) 
                values('" . $_SESSION['store'] . "','" . $_SESSION['model'] . "','" . $_SESSION['fname'] . "','" . $_SESSION['lname'] . "','" . $_SESSION['email'] . "','" . $_SESSION['mobile'] . "','" .  $_SESSION['pickup'] . "')";
    
    // If the input is inserted into table, redirect to the main page.
    // A successful message will be stored in the session.
    if($result = mysqli_query($conn, $stmt)) {
        $_SESSION['addSuccess'] = "Congratulations! Your information has been reserved."; 
        header('Location: reserve.php'); 
    }
}

?>
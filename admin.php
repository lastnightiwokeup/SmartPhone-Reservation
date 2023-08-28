<?php
    /* Name: Leung Tsz Ki Connie, Student ID: 21070955S */
    require('db.php');// so that the functon from db.php can be use here

    // The data is sorted by id at the admin page
    // (1) means the case 1 from the switch statement of function selectAllData($num) 
    $result = selectAllData(1);
?>

<!DOCTYPE html>
<html lang="en">
<!-- bootstrap is included -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Admin Page</title>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="#page-top">Sunny Mobile</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="reserve.php">Reserve Now!</a></li>
                    <li class="nav-item"><a class="nav-link" name="submit" href="adminlogin.php">Admin Login</a></li>
                </ul>

            </div>
        </div>
    </nav>
<br/><br/><br/><br/>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">    
        <div class="container mt-3">
        <!-- Create button that use to sort the list by diffect fields -->
        <button type="button" class="btn btn-dark">Sort By</button>:
        <input type="submit" class="btn btn-secondary" name="idbtn" value="id">
        <input type="submit" class="btn btn-secondary" name="datebtn" value="Pickup Date">
        <input type="submit" class="btn btn-secondary" name="fnamebtn" value="First Name">
        <input type="submit" class="btn btn-secondary" name="lnamebtn" value="Last Name">
        <!-- Creat search area for search records by mobile numbmer -->
        <p style="float: right;"><input type="text" name="searchFilter" value="" >
        <input type="submit" class="btn btn-secondary" name="filterBtn" value="Filter by mobile"></p>
    </div>
    <br><br/><br/>

    </form>
    <!-- Create table -->
        <table class="table table-striped">
        <thead class="table-dark">
            <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Model</th>
            <th>Store</th>
            <th>Pickup date</th>
            </tr>
        </thead>


    <?php

    // Check if POST method is used in this web server,
    // if it's true, then the the selectAllData() function will go through each cases,
    // and when the associated button is pressed, then the list will be shown by 4 different ways:
    // id, pickup date, first name and last name in sorted format.
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['idbtn'])){
            $result = selectAllData(1);
        }
        if(isset($_POST['datebtn'])){   
            $result = selectAllData(2);
        }
        if(isset($_POST['fnamebtn'])){
            $result = selectAllData(3);
        }  
        if(isset($_POST['lnamebtn'])){
            $result = selectAllData(4);
        }
        // When the search button is pressed, here will undergo the mobileFilter() function,
        // then admin can serach customer's input by mobile no.
        if (isset($_POST['filterBtn'])) {
            if (isset($_POST['searchFilter']) && !empty($_POST['searchFilter'])){
                $result = mobileFilter($_POST['searchFilter']);
            }
        }
    }

    // To check if there's any inserted data in the table, if it's true, 
    // fetch the result row as associative array of each fields and echo them into a table
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo"<tr>";
            echo"<td>". $row['id']. "</td>";
            echo"<td>". $row['fname']. "</td>";
            echo"<td>". $row['lname']. "</td>";
            echo"<td>". $row['email']. "</td>";
            echo"<td>". $row['mobile']. "</td>";
            // Since model & store are stored as INT at the database, which will show 1,2,3,4 in the admin page table.
            // Suppose not all the admins know which number represents to which model/store, then the information in the table is unclear.
            // Therefore, convert the INT into relevant model/store as a string, it will be much easier for every admin to read the table.
            echo"<td>". convertModelIntoString($row['model']). "</td>";
            echo"<td>". convertStoreIntoString($row['store']). "</td>";
            echo"<td>". $row['pickup']. "</td>";
            echo"</tr>";
        }
    // Otherwise, show no results if there's no data in the database table
    } else {
        echo "<p>no results</p>";
    }
        $modelstring = "";
        $storestring = "";
        // Covert each INT of 'model' in database that represents different model into relevant name as string
        function convertModelIntoString($m){
            $result = "";
            if($m == 1)
            {
                $result = "16GB";
            }
            elseif ($m == 2)
            {
                $result = "32GB";
            }
            elseif($m == 3){
                $result = "64GB";  
            }
            elseif($m == 4){
                $result = "128GB";  
            }
            return $result;
    }
        // Covert each INT of 'store' in database that represents different store into relevant name as string
        function convertStoreIntoString($s){
            $result = "";
            if($s == 1)
            {
                $result = "IFC Mall";
            }
            elseif ($s == 2)
            {
                $result = "Festival Walk";
            }
            elseif($s == 3){
                $result = "Hysan Place";  
            }
            elseif($s == 4){
                $result = "APM";  
            }
            return $result;
    }

    ?>

    </table>
</div>
</body>
</html>





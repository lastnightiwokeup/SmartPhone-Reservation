<!-- Name: Leung Tsz Ki Connie, Student ID: 21070955S -->
<!-- Using bootstrap for index page-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sunny Mobile</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./css/index.css" rel="stylesheet" />
</head>

<body id="page-top">
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
    <!-- Header-->
    <header class="bg-primary bg-gradient text-white">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">Welcome to Sunny Mobile</h1>
            <p class="lead">SmartPhone 4517 is here!</p>
            <a class="btn btn-lg btn-light" href="#about">Before your reservation...</a>
        </div>
    </header>
    <!-- Message to customer-->
    <section id="about">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2>About the reservation</h2>
                    <p class="lead"> Due to the strong demand: </p>
                    <ul>
                        <li>SmartPhone 4517 only accept a limited number of reservations</li>
                        <li>Responsive behavior when clicking nav links perfect for a one page website</li>
                        <li>If you want to order the SmartPhone 4517, select retail stores and SmartPhone 4517 models</li>
                        <li>If, your SmartPhone 4517 booking application is successful, you will receive an email confirmation notice before 23:55 tonight</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Services section-->
    <section class="bg-light" id="services">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2>If you do not receive an email: </h2>
                    <p class="lead">It represents the order fails. Only the customers who receive an email can buy the SmartPhone 4517 at the stores. You can apply for booking the SmartPhone 4517 every weekday from 09:00 to 17:00.<br /> Please try again later to submit
                        a reservation.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact section-->
    <section id="contact">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2>Are You Ready? </h2>
                    <p class="lead"> Click "Reserve Now" on the top right corner</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./js/scripts.js"></script>
</body>

</html>
<?php
// Redirect to admin page only if "admin" & "pass" is entered as login name and password respectively
if (isset($_POST['submit'])) {
    if ($_POST['login'] == 'admin' && $_POST['pw'] == 'pass') {
    	header('Location: admin.php');
    }
}
?>
<?php
    define('HOST', 'localhost');
    define('UNAME', 'root');
    define('PASS', '');
    define('DBNAME', 'contact');


    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

        if($conn = mysqli_connect(HOST, UNAME, PASS, DBNAME)){

            $email = mysqli_real_escape_string($conn, trim($_POST['email']));
            $number = mysqli_real_escape_string($conn, trim(intval($_POST['number'])));
            $feedback = mysqli_real_escape_string($conn, trim($_POST['feedback']));

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Email is invalid");
            }

            if(empty($email) or empty($number) or empty($feedback)) {
                echo "<script>";
                echo "alert('Please fill the details');";
                echo "window.location.href = '../portfolio'";
                echo "</script>";
            }

            $query = "INSERT INTO `contactinfo`(`email`, `number`, `feedback`) VALUES 
            ('{$email}','{$number}','{$feedback}')";

            $result = mysqli_query($conn, $query);

            if($result) {
                echo "<script>";
                echo "window.alert('Thank you for contacting me.');";
                echo "window.location.href = '../portfolio';";
                echo "</script>";
            } else {
                echo "<h1>ERROR OCCURED</h1>";
                echo "Please try again later.";
                echo "<a href='../portfolio'>Main page</a>";
            }

            mysqi_close($conn);

        } else {
            die(mysqli_error());
        }

    } else {
        header("Location: ../portfolio");
    }

?>
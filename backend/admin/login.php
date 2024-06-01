<?php
include("../DB/db_connect.php");
session_start();
is_login();
function is_login ()
{
    if(isset($_SESSION["is_login"]) == 1) {
        header("location:../admin/index.php");
        exit();
    }
}

if(isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    // echo $password; exit;

    $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
    // var_dump($sql);
    $result = mysqli_query($conn, $sql);
    $row    = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count  = mysqli_num_rows($result);
    //var_dump($count);
    if($count != 0) {
       
        $_SESSION['sess_user'] = $username;
        $_SESSION['is_login']  = 1;

        header("Location: ../admin/index.php");

    } else {

        $_SESSION['sess_user'] = "";
        $_SESSION['is_login']  = "";
         $error_message= "Invalid username or password!";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
    </head>

    <style>
        login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 125px auto 90px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        .form button:hover,
        .form button:active,
        .form button:focus {
            background: #43A047;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before,
        .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        .container .info span .fa {
            color: #EF3B3A;
        }

        body {
            background: #ccdec2;
            ;
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .label-display {
            float: left;
            margin-bottom: 5px;
        }
    </style>

    <body>
        <div class="login-page">
            <div class="form">

                <form class="login-form" method="POST">
                    <p>
                        <label class="label-display"> UserName </label>
                        <input type="text" id="user" name="username" required />
                    </p>
                    <p>
                        <label class="label-display"> Password </label>
                        <input type="password" id="pass" name="password" placeholder="Enter your password" required />
                    </p>
                    <button type="submit" id="btn" value="Login" name="Login">login</button>

                </form>
                <?php
                if(isset($error_message)) {
                    echo '<div style="color: red;">' . $error_message . '</div>';
                }
                ?>
            </div>
        </div>
    </body>

</html>
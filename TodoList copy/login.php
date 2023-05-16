<?php
session_start();
require 'controller.php';


//cek session
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
//cek cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    $temp = mysqli_query($conn, "SELECT username where ID='$id'");
    $result = mysqli_fetch_assoc($temp);

    if ($key === hash('ripemd160', $result["username"])) {
        $_SESSION["login"] = true;
    }
}
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) === 1) {
        $dataUser = mysqli_fetch_assoc($result);
        if (
            password_verify($password, $dataUser["password"])
        ) {
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $dataUser["user_id"];

            setcookie("id", $dataUser["user_id"], time() + 3600);


            $key = hash('ripemd160', $dataUser['username']);
            setcookie("key", $key, time() + 3600);

            echo "login is " . $_SESSION["login"] . ".<br>";
            echo "user_id is " . $_SESSION["user_id"] . ".";
            header('Location: index.php');
            exit;
        }
    }
    $error = true;
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="StylesLogin.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body style="padding-top: 50px;">

    <?php if (isset($error)) : ?>
        <p style="color: red; font-style:italic;">
            yikess
        </p>
    <?php endif ?>
    <section class="vh-100" style="height: 100%
    ;">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 " id="ContainerSign">
                    <form action="" method="post">

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Sign In</p>
                        </div>

                        <!-- username input -->
                        <div class="form-outline mb-4">
                            <input autocomplete="off" name="username" type="text" id="username" class="form-control form-control-lg" placeholder="Username" />
                            <label class="form-label" for="username">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input autocomplete="off" name="password" type="password" id="password" class="form-control form-control-lg" placeholder="Enter password" required />
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="remember" name="remember" />
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                                <a href="Regis.php" style="margin-left: 90px;">
                                    Dont have an account? sign up here
                                </a>
                            </div>

                        </div>
                        <!--sign Button Part-->
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="login" name="login" class="btn btn-primary btn-lg" id="loginBtn" style="padding-left: 2.5rem; padding-right: 2.5rem;">Sign In!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById("form3Example3").addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("form3Example4").focus();
            }
        });

        document.getElementById("form3Example4").addEventListener("keypress", function(event) {
            if (event.keyCode === 13) {
                document.getElementById("loginBtn").click();
            }
        });
    </script>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
            keyboard: false
        });
        myModal.show();
    </script>

    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
            keyboard: false
        });
        myModal.show();
    </script>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
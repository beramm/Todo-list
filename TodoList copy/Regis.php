<?php

require 'controller.php';

if (isset($_POST["submit"])) {
    if (registration($_POST) > 0) {
        echo "
        <script>
            alert('succes');
            document.location.href='login.php';
        </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Regist</title>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <section class="vh-100" style="height: 100%
    ;">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 " id="ContainerSign">

                    <form action="" method="post">

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Sign Up</p>
                        </div>

                        <!-- username input -->
                        <div class="form-outline mb-4">
                            <input autocomplete="off" name="username" type="text" id="username" class="form-control form-control-lg" placeholder="Username" />
                            <label class="form-label" for="username">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input autocomplete="off" name="password" type="password" id="password" class="form-control form-control-lg" placeholder="Enter password" required/>
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <!-- confirmation input -->
                        <div class="form-outline mb-3">
                            <input autocomplete="off" name="confirm" type="password" id="confirm" class="form-control form-control-lg" placeholder="Confirmation password" required/>
                            <label class="form-label" for="confirm">Confirmation</label>
                        </div>
                        <!--sign Button Part-->
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" id="loginBtn" style="padding-left: 2.5rem; padding-right: 2.5rem;">Sign Up!</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </section>
   

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>


</html>
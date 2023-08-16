<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="login-reg-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="login-reg-assets/css/untitled.css">
</head>

<body class="bg-gradient-primary" style="background: url(&quot;login-reg-assets/img/image.jpg&quot;) center / cover no-repeat, rgba(0,0,0,0);">
    <div class="container" id="con">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background: url(&quot;login-reg-assets/img/dogs/login-logo.jpg&quot;) center;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="font-family: Poppins, sans-serif;font-size: 25px;">Welcome Back!</h4>
                                    </div>
                                    <div style="margin-top: 30px;">
                                    <form class="user" action="authentication.php" method="POST">
                                    <?php
                                    session_start();
                                    // Check for session error message
                                    if (isset($_SESSION['error'])) {
                                        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                                        unset($_SESSION['error']); // Clear the error message from session
                                        }
                                    elseif(isset($_SESSION['success'])){
                                        echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
                                        unset($_SESSION['success']);
                                        }
                                        ?>
                                        <div class="mb-3"><input class="form-control form-control-user" name="email" type="email" id="login-email" aria-describedby="emailHelp" placeholder="Email" name="email" style="font-family: Poppins, sans-serif;" required=""></div>
                                        <div class="mb-3"><input class="form-control form-control-user" name="password" type="password" id="login-password" placeholder="Password" name="password" style="font-family: Poppins, sans-serif;" required="" minlength=""></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1" style="font-family: Poppins, sans-serif;">Remember Me</label></div>
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" name="Login" type="submit" style="background: rgb(0,23,235);border-width: 0px;font-family: Poppins, sans-serif;">Login</button>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgot-password.php" style="font-family: Poppins, sans-serif;">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="register.php" style="font-family: Poppins, sans-serif;">Create an Account!</a></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="login-reg-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="login-reg-assets/js/theme.js"></script>
    <script src="login-reg-assets/js/dropdown.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>

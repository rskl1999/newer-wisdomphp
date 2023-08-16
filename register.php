<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="login-reg-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="login-reg-assets/css/untitled.css">
    <link rel="stylesheet" href="login-reg-assets/css/radio.css">
</head>

<body class="bg-gradient-primary" style="background: url(&quot;login-reg-assets/img/image.jpg&quot;) center / cover no-repeat, rgba(211,237,255,0);">
    <div class="container" id="cont">
        <div class="card shadow-lg o-hidden border-0 my-5" style="background: rgb(255,255,255);">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-login-image" style="background: url(&quot;login-reg-assets/img/dogs/login-logo.jpg&quot;) center;"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4" style="color: rgb(255,255,255);">Create an Account!</h4>
                            </div>
                            <form class="user" method="POST" action="create-acct.php" >
                            <?php session_start();
                                // Check for session error message
                                    if (isset($_SESSION['error'])) {
                                    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                                    unset($_SESSION['error']); } // Clear the error message from session 
                            ?>
                                <div id="schoolName" class="mb-3"><input id="school-name" class="form-control form-control-user" placeholder="School Name" name="schoolName"style="font-family: Poppins, sans-serif;" required onkeypress="return isVarchar(event)"/></div>
                                <div id="emailAddress" class="mb-3"><input class="form-control form-control-user" type="email" id="email-address" placeholder="Email" name="email" style="font-family: Poppins, sans-serif;" required onkeypress="return validateEmail(event)"> </div>
                                <div id="userAddress" class="mb-3"><input id="address" class="form-control form-control-user" placeholder="Address" name="address" style="font-family: Poppins, sans-serif;" required onkeypress="return isVarchar(event)"/></div>
                                <div id="contactNumber" class="mb-3"><input id="contact-number" class="form-control form-control-user" placeholder="Contact Number" name="contact-no" style="font-family: Poppins, sans-serif;" inputmode="numeric" maxlength="11" required onkeypress="return isNumberKey(event)"/>
                            </div>
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3 mb-sm-0" id="province">
                                <select id="provinceSelect" name="province" class="form-select" style="height: 53.1875px;padding: 16px;font-family: Poppins, sans-serif;font-size: 12.8px;border-radius: 160px;" required>
                                    <option value="" disabled selected>Select a Province</option>
                                </select>
                            </div>
                            <div class="col-sm-6" id="city">
                                <select id="citySelect" name="city" class="form-select" style="height: 53.1875px;padding: 16px;font-family: Poppins, sans-serif;font-size: 12.8px;border-radius: 160px;" required>
                                    <option name="city" value="" disabled selected>Select a City</option>
                                </select>
                            </div>
                        </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0" id="password"><input class="form-control form-control-user" type="password" id="password-input" placeholder="Password" name="password" style="font-family: Poppins, sans-serif;" required="" minlength="8" onkeypress="return isAlphanumericKey(event)"></div>
                            <div class="col-sm-6" id="confirm-pass"><input class="form-control form-control-user" type="password" id="confirm-password" placeholder="Confirm Password" name="con-pass" style="font-family: Poppins, sans-serif;" required="" minlength="8" onkeypress="return isAlphanumericKey(event)"></div>
                            </div>
                            <div class="col mb-2">
                                <h3 style="font-family: Poppins, sans-serif; font-size:13px; margin-bottom:10px;">Department</h3>
                                <label>
                                    <input type="radio" name="department" value="Admin" />
                                    <span style="font-family: Poppins, sans-serif;">Admin</span>
                                </label>
                                <label>
                                    <input type="radio" name="department" value="Facilitator" />
                                    <span style="font-family: Poppins, sans-serif;">Facilitator</span>
                                </label>
                                <label>
                                    <input type="radio" name="department" value="HR" />
                                    <span style="font-family: Poppins, sans-serif;">HR</span>
                                </label>
                                <label>
                                    <input type="radio" name="department" value="School" />
                                    <span style="font-family: Poppins, sans-serif;">School</span>
                                </label>
                                <label>
                                    <input type="radio" name="department" value="Student" />
                                    <span style="font-family: Poppins, sans-serif;">Student</span>
                                </label>
                            </div>
                                <button class="btn btn-primary d-block btn-user w-100" name="next" type="submit" style="font-family: Poppins, sans-serif;background: rgb(17,55,239);" id="register">Register</button>
                            </form>
                            <hr>
                            <div class="text-center"><a class="small" href="login.php" style="font-family: Poppins, sans-serif;">Already have an account?</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="login-reg-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="login-reg-assets/js/theme.js"></script>
    <script src="addressList.js"></script>
</body>

</html>

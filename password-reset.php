<?php
require_once('connection.php');

if (isset($_POST['change-pass'])) {
    $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
    $newpass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $conf_pass = filter_input(INPUT_POST, 'confirm-pass', FILTER_SANITIZE_STRING);

    if (empty($newpass)) {
        $error_msg = 'Please enter a new password.';
    } elseif (empty($conf_pass)) {
        $error_msg = 'Please confirm your new password.';
    } elseif ($newpass !== $conf_pass) {
        $error_msg = 'The new password and confirm password fields do not match.';
    } else {
        $stmt = $con->prepare("SELECT * FROM accounttbl WHERE token=? LIMIT 1");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            $salt = random_bytes(16);
            $hashed_pass = password_hash($newpass, PASSWORD_DEFAULT);

            $stmt = $con->prepare("UPDATE accounttbl SET pass=? WHERE token=? LIMIT 1");
            $stmt->bind_param("ss", $hashed_pass, $token);
            $result = $stmt->execute();

            if ($result) {
                header('Location: login.php?password_changed=1');
                exit;
            } else {
                $error_msg = "Error updating password: " . $stmt->error;
            }
        } else {
            $error_msg = 'Invalid or missing token.';
        }

        $stmt->close();
    }

    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Password Reset</title>
    <link rel="stylesheet" href="login-reg-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="login-reg-assets/css/untitled.css">
</head>

<body class="bg-gradient-primary" style="background: url(&quot;login-reg-assets/img/image.jpg&quot;) center / cover no-repeat, rgba(255,255,255,0);">
    <div class="container" id="con" style="padding-top: 25px;padding-bottom: 25px;">
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
                                        <h4 class="text-dark mb-4" style="font-family: Poppins, sans-serif;font-size: 22px;">Reset your password</h4>
                                    </div>
                                    <?php if (isset($error_msg)): ?>
                                            <?php echo '<p style=color:red>'. $error_msg .'</p>'?>
                                        <?php endif; ?>
                                    <form method="POST" class="user">
                                    
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="new-password" placeholder="New password" name="password" onkeypress="return isAlphanumericKey(event)"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="confirm-password" placeholder="Confirm password" name="confirm-pass" onkeypress="return isAlphanumericKey(event)" style="font-family: Poppins, sans-serif;"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small"></div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" name="change-pass" type="submit" style="background: rgb(0,23,235);border-width: 0px;font-family: Poppins, sans-serif;">Login</button>
                                    </form>
                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="login-reg-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="login-reg-assets/js/theme.js"></script>
</body>

</html>
<script>
function isAlphanumericKey(event) {
        const charCode = event.which || event.keyCode;
    const passwordRegex = /^[a-zA-Z0-9]*$/;

    if (!passwordRegex.test(String.fromCharCode(charCode))) {
        event.preventDefault();
    }
    return passwordRegex.test(String.fromCharCode(charCode));
}

</script>
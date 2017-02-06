<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Soilmaster</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
    <link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
    <link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
    <link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">

</head>
<body>
<div class="app app-default">
    <div class="app-container app-login">
        <div class="flex-center">
            <div class="app-header"></div>
            <div class="app-body">
                <div class="loader-container text-center">
                    <div class="icon">
                        <div class="sk-folding-cube">
                            <div class="sk-cube1 sk-cube"></div>
                            <div class="sk-cube2 sk-cube"></div>
                            <div class="sk-cube4 sk-cube"></div>
                            <div class="sk-cube3 sk-cube"></div>
                        </div>
                    </div>
                    <div class="title">Logging in...</div>
                </div>
                <div class="app-block">
                    <div class="app-form">
                        <div class="form-header">
                            <div class="app-brand"><span class="highlight">Soilmaster</span> V1</div>
                        </div>
                        <form action="index.php" method="POST" name="loginform">
                            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-user" aria-hidden="true"></i></span>
                                <input id="login_input_username" name="user_name" type="text"
                                       class="form-control login_input" placeholder="Username"
                                       aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2">
                <i class="fa fa-key" aria-hidden="true"></i></span>
                                <input id="login_input_password" name="user_password" type="password"
                                       class="form-control login_input" placeholder="Password"
                                       aria-describedby="basic-addon2" autocomplete="off" required>
                            </div>
                            <div class="text-center">
                                <input name="login" type="submit" class="btn btn-success btn-submit" value="Log in">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="app-footer">
            </div>
        </div>
    </div>
</div>

<!--  <script type="text/javascript" src="assets/js/vendor.js"></script>-->
<!--  <script type="text/javascript" src="assets/js/app.js"></script>-->

</body>
</html>
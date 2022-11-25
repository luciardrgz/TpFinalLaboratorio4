<?php

namespace Views;

?>

<html>

<head>
    <title>Reset Password | Pet Hero</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "recoverPass.css" ?>">


</head>

<body>

    <div class="container">

        <h3><i class="fa fa-lock fa-4x"></i></h3>
        <h2>Reset password</h2>
        <p>Enter your new password below.</p>


        <div class="panel-body">

            <form action="<?php echo FRONT_ROOT . "User/resetPassword/" ?>" id="register-form" role="form"
                autocomplete="off" class="form" method="post">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>

                        <input id="newPass" name="newPass" placeholder="New Password" class="form-control" type="text">

                        <input type="email" name="email" value="<?php echo $email ?>" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password"
                        type="submit">
                </div>

            </form>

        </div>
    </div>
</body>

</html>
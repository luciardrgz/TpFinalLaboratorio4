<?php

namespace Views;

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>

<head>
    <title>Pet Hero</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "login.css" ?>">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">

            <div class="card">

                <div class="card-header">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "logo.png" ?>" width="30%">
                </div>

                <div class="card-body">
                    <form action="<?php echo FRONT_ROOT . "Auth/login" ?>" method="POST">


                        <div class="email-pass-box">

                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="email" name="email" placeholder="Your email" required>
                            </div>

                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <div id='pass-container'>
                                    <input type="password" id="login-form-pass" name="password"
                                        placeholder="Your password" required></input>

                                    <svg id="openEye" onclick="togglePass()" data-name="openEye" width="25"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <title>eye-glyph</title>
                                        <path
                                            d="M320,256a64,64,0,1,1-64-64A64.07,64.07,0,0,1,320,256Zm189.81,9.42C460.86,364.89,363.6,426.67,256,426.67S51.14,364.89,2.19,265.42a21.33,21.33,0,0,1,0-18.83C51.14,147.11,148.4,85.33,256,85.33s204.86,61.78,253.81,161.25A21.33,21.33,0,0,1,509.81,265.42ZM362.67,256A106.67,106.67,0,1,0,256,362.67,106.79,106.79,0,0,0,362.67,256Z" />
                                    </svg>
                                    <svg id="closedEye" onclick="togglePass()" data-name="closedEye" width="25"
                                        xmlns="http://www.w3.org/2000/svg" style='display: none' viewBox="0 0 512 512">
                                        <title>eye-disabled-glyph</title>
                                        <path
                                            d="M409.84,132.33l95.91-95.91A21.33,21.33,0,1,0,475.58,6.25L6.25,475.58a21.33,21.33,0,1,0,30.17,30.17L140.77,401.4A275.84,275.84,0,0,0,256,426.67c107.6,0,204.85-61.78,253.81-161.25a21.33,21.33,0,0,0,0-18.83A291,291,0,0,0,409.84,132.33ZM256,362.67a105.78,105.78,0,0,1-58.7-17.8l31.21-31.21A63.29,63.29,0,0,0,256,320a64.07,64.07,0,0,0,64-64,63.28,63.28,0,0,0-6.34-27.49l31.21-31.21A106.45,106.45,0,0,1,256,362.67ZM2.19,265.42a21.33,21.33,0,0,1,0-18.83C51.15,147.11,148.4,85.33,256,85.33a277,277,0,0,1,70.4,9.22l-55.88,55.88A105.9,105.9,0,0,0,150.44,270.52L67.88,353.08A295.2,295.2,0,0,1,2.19,265.42Z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="login-btn-box">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?
                        <a href="<?php echo FRONT_ROOT . "Home/signUp" ?>">Sign Up </a>
                    </div>
                    <div class="d-flex justify-content-center">
					<a href="<?php echo FRONT_ROOT . "Auth/viewRecoverPass" ?>">Forgot your password?</a>
				    </div>
                </div>
           
                <?php
                if ($message != null) { ?>
                <div class="alert alert-danger">
                    <?php echo $message; ?>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</body>

</html>

<!-- JavaScript para el toggle de ver/e see/hide the password-->
<script>
const x = document.getElementById("login-form-pass"); // Input
const s = document.getElementById("openEye"); // Show pass
const h = document.getElementById("closedEye"); // Hide pass

function togglePass() {
    if (x.type === "password") {
        x.type = 'text';
        s.style.display = 'none';
        h.style.display = 'inline';
    } else {
        x.type = 'password';
        s.style.display = 'inline';
        h.style.display = 'none';
    }
}
</script>
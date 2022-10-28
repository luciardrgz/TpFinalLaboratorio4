<?php

namespace Views;

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>

<head>
    <title>Sign up</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "signUp.css" ?>">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">

            <div class="row justify-content-center align-items-center h-100">

                <div class="col-12 col-lg-9 col-xl-7">

                    <div class="hola" style="border-radius: 15px;">

                        <div class="card-body p-4 p-md-5">

                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Sign up</h3>

                            <form action="<?php echo FRONT_ROOT."User/add/" ?>" method="POST">

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">First Name</label>
                                            <input type="text" name="firstName" id="firstName"
                                                class="form-control form-control-lg" placeholder="George" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Last Name</label>
                                            <input type="text" name="lastName" class="form-control form-control-lg"
                                                placeholder="Washington" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline datepicker w-100">
                                            <label for="birthdate" class="form-label">Birthday</label>
                                            <input type="date" name="birthDate" class="form-control form-control-lg" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="emailAddress"
                                                class="form-control form-control-lg" placeholder="ejemplo@gmail.com" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            <input type="number" name="phoneNumber" class="form-control form-control-lg"
                                                placeholder="1234567890"required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="nickName">Nickname</labe>
                                            <input type="text" name="nickName" class="form-control form-control-lg"
                                                placeholder="Nickname"required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="text" name="password" class="form-control form-control-lg"
                                                placeholder="Password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label select-label">Choose option</label> <br>
                                        <select name="type" class="select form-control-lg" required>
                                            <option value="G" selected>Pet Guardian</option>
                                            <option value="O">Pet Owner</option>
                                        </select>
                                    </div>
                                </div>

                                <button name="submit" type="submit" value="Submit"
                                    class="btn btn-warning">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>


<!--
                                    <div class="col-md-6 mb-4">
                                        <h6 class="mb-2 pb-1">Gender </h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="femaleGender" value="option1" checked />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="maleGender" value="option2" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="otherGender" value="option3" />
                                            <label class="form-check-label" for="otherGender">Other</label>
                                        </div>
                                    </div>
                                    -->

</html>
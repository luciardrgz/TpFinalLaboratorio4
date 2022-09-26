<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>

<html>

<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/signUp.css">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">

            <div class="row justify-content-center align-items-center h-100">

                <div class="col-12 col-lg-9 col-xl-7">

                    <div class="hola" style="border-radius: 15px;">

                        <div class="card-body p-4 p-md-5">

                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Sign up</h3>
                            <form class="prueba">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="firstName" class="form-control form-control-lg" placeholder="George"/>
                                            <label class="form-label" for="firstName">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="lastName" class="form-control form-control-lg" placeholder="Washington"/>
                                            <label class="form-label" for="lastName">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <input type="date" class="form-control form-control-lg" id="birthdayDate" />
                                            <label for="birthdayDate" class="form-label">Birthday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="mb-2 pb-1">Gender </h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender" value="option1" checked />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender" value="option2" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender" value="option3" />
                                            <label class="form-check-label" for="otherGender">Other</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="email" id="emailAddress" class="form-control form-control-lg"  placeholder="ejemplo@gmail.com" />
                                            <label class="form-label" for="emailAddress">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="tel" id="phoneNumber" class="form-control form-control-lg"  placeholder="1234567890" />
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
									    <label class="form-label select-label">Choose option</label> <br>
                                        <select class="select form-control-lg">
                                            <option value="2">Guardian</option>
                                            <option value="3">Pet owner</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div>
                                    <button type="submit" value="Submit" class="btn btn-warning">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
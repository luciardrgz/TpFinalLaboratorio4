<?php

namespace Views;

include("navOwner.php");

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>

<head>
    <title>Add your Pet!</title>

    <!--
    <script type="text/javascript">
    function disableTypeSelect() {
        if (document.getElementById('Cat').checked) {
            document.getElementById('size').disabled = true;
        } else {
            if (document.getElementById('Dog').checked) {
                document.getElementById('size').disabled = false;
            }
        }
    }
    </script>
 En cada input (Dog y Cat) va onclick="disableTypeSelect()" 
-->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "addPet.css" ?>">

</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">

            <div class="row justify-content-center align-items-center h-100">

                <div class="col-12 col-lg-9 col-xl-7">

                    <div class="hola" style="border-radius: 15px;">

                        <div class="card-body p-4 p-md-5">

                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5"><b>Add a new pet</b></h3>

                            <form action="<?php echo FRONT_ROOT . "Pet/addPet" ?>" method="POST">

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="petName">Pet Name*</label>
                                            <input type="text" name="petName" id="petName"
                                                class="form-control form-control-lg" placeholder="Your pet's name"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="picture">Picture URL*</label>
                                            <input type="text" name="pictureURL" class="form-control form-control-lg"
                                                placeholder="Your pet's picture" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline datepicker w-100">
                                            <label for="breed" class="form-label">Breed*</label>
                                            <input type="text" name="breed" placeholder="Your pet's breed" class=" form-control
                                                form-control-lg" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="video">Video URL (optional)</label>
                                            <input type="text" name="video" id="video"
                                                class="form-control form-control-lg" placeholder="Your pet's video">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="vacc">Vaccination Certificate URL*</label>
                                            <input type="text" name="vaccination" class="form-control form-control-lg"
                                                placeholder="Your pet's vaccines" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">
                                        <label class="form-label select-label">Pet type*</label> <br>
                                        <label class="petTypeCheck">
                                            <input type="radio" name="Pet" id="Dog" value="D"
                                               > Dog &nbsp;&nbsp;

                                        </label>

                                        <label class=" petTypeCheck">
                                            <input type="radio" name="Pet" id="Cat" value="C"
                                                > Cat
                                        </label>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <label class="form-label select-label">Pet size</label> <br>
                                        <select name="size" id="size" class="select form-control-lg">
                                            <option value="S">Small</option>
                                            <option value="M">Medium</option>
                                            <option value="B">Big</option>
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
<!--         
                                        
                                                
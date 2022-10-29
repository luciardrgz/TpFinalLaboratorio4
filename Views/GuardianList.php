<?php

namespace Views;
/*
session_start();
if ($_SESSION['guardian']guardian){
    include("../navGuardian.php");
}else{
  include("../navOwner.php");  
}*/

include("navOwner.php");

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "BookingHistory.css" ?>">
</head>

<body>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto mb-4">
                <div class="section-title text-center ">
                    <h3 class="top-c-sep"><br>Guardian List</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">
                    <!-- Posible filtro de Mascotas      
                    <form action="#" class="career-form mb-60">
                        <div class="row">
                            <div class="col-md-6 col-lg-3 my-3">
                                <div class="input-group position-relative">
                                    <input type="text" class="form-control" placeholder="Enter Your Keywords"
                                        id="keywords">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 my-3">
                                <div class="select-container">
                                    <select class="custom-select">
                                        <option selected="">Location</option>
                                        <option value="1">Jaipur</option>
                                        <option value="2">Pune</option>
                                        <option value="3">Bangalore</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 my-3">
                                <div class="select-container">
                                    <select class="custom-select">
                                        <option selected="">Select Job Type</option>
                                        <option value="1">Ui designer</option>
                                        <option value="2">JS developer</option>
                                        <option value="3">Web developer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 my-3">
                                <button type="button" class="btn btn-lg btn-block btn-light btn-custom"
                                    id="contact-submit">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>  -->
                    <!-- desde aca      -->

                    <?php

                    if ($guardianList != null) {
                        foreach ($guardianList as $guardian) { ?>
                    <div class="filter-result">

                        <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                            <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                    FD
                                    <!-- foto según pettype-->
                                </div>
                                <div class="job-content">

                                    <h5 class="text-md-left"><?php echo $guardian->getNickName(); ?></h5>

                                    <ul class="d-md-flex flex-wrap text-capitalize ff-open-sans">
                                        <li class="mr-md-4">
                                            <?php echo "<br>Name: " . $guardian->getFirstName() . " | Last Name:" . $guardian->getLastName(); ?>

                                            <?php echo "<br>Email: " . $guardian->getEmail() . " | Phone Number: " . $guardian->getPhoneNumber(); ?>

                                            <?php echo "<br>Date of Birth: " . $guardian->getBirthDate(); ?>

                                            <?php
                                                    if ($guardian->getScore() != null) {
                                                        echo "<br>Score: " . $guardian->getScore();
                                                    }

                                                    if ($guardian->getPetsize() != null) {
                                                        echo "<br>Pet Size Preference: " . $guardian->getPetsize();
                                                    }

                                                    if ($guardian->getFirstAvailableDay() != null && $guardian->getLastAvailableDay() != null) {
                                                        echo "<br>Availability: " . $guardian->getFirstAvailableDay() . " | " . $guardian->getLastAvailableDay();
                                                    }
                                                    ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="job-right my-4 flex-shrink-0">
                                <a href="<?php echo "user/booking/" . $guardian->getEmail(); ?>"
                                    class="btn d-block w-100 d-sm-inline-block btn-light">Apply now</a>
                            </div>
                        </div>
                        <?php }
                    } else {
                        echo "No hay guardianes disponibles";
                    } ?>
                        <!-- hasta aca      -->



                        <!-- START Pagination -->

                        <ul class="pagination pagination-reset justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <i class="zmdi zmdi-long-arrow-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">2</a></li>
                            <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">8</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="zmdi zmdi-long-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                        </nav>
                        <!-- END Pagination -->
                    </div>
                </div>

            </div>
</body>

</html>
<?php

namespace Views;

use DB\BreedDAO;

include("navOwner.php");

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "petSelection.css" ?>">
</head>

<body>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto mb-4">
                <div class="section-title text-center ">
                    <h3 class="top-c-sep"><br>Select Pets and Booking Date</h3>
                    <h4 class="top-c-sep">Guardians can take care of one size of dog at a time.</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">

                    <form action="<?php echo FRONT_ROOT . "Booking/bookDate/" ?>" method="POST">

                        <input type="text" name="id" value="<?php echo $id ?>" hidden>

                        <?php
                        $breedDAO = new BreedDAO();

                        if ($petList != null) {
                            foreach ($petList as $pets) { ?>

                        <div class="filter-result">
                            <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                                <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                    <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                        PS
                                        <!-- foto según pettype-->
                                    </div>
                                    <div class="job-content">

                                        <h5 class="text-md-left"><?php echo $pets->getName(); ?></h5>

                                        <ul class="d-md-flex flex-wrap text-capitalize ff-open-sans">
                                            <li class="mr-md-4">
                                                <?php echo "<br>Breed: " . $breedDAO->getBreedName($pets->getBreed()); ?>
                                                <?php echo "<br>Size: " . $pets->getSizeText(); ?>
                                                <?php echo "<br>Picture: " . $pets->getPicture(); ?>
                                                <?php echo "<br>Video: " . $pets->getVideo(); ?>
                                                <?php echo "<br>Vaccines: " . $pets->getVaccination(); ?>

                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="job-right my-4 flex-shrink-0">
                                    <input type="checkbox" name="selectedPet[]" value="<?php echo $pets->getId(); ?>">
                                    Select
                                </div>

                            </div>
                            <?php
                            }
                        } ?>

                            From: <input type="date" name="firstDay" className="dateSelection" required>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:&nbsp;<input type="date" name="lastDay"
                                className="dateSelection" required>

                            <div className="submitBtnBox">
                                <button name="submit" type="submit" value="Submit"
                                    class="btn btn-warning">Submit</button>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>

                    </form>

                </div>
            </div>

        </div>
        <br>
        <br>

</body>

</html>
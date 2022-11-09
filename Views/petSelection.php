<?php

namespace Views;

use DB\BreedDAO as BreedDAO;
use DB\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

include("navOwner.php");

$guardianDAO = new GuardianDAO();
$guardian = new Guardian();
$guardian = $guardianDAO->getById($id);
$guardianName = $guardian->getFirstName();
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

                <div class="instructions-div">
                    <h3><br>You've selected <?php echo $guardianName; ?> to take care of your pets!</h3>
                    <h4>Now, you have to select <b>at least 1 pet</b> to continue. <br>
                        <img src="https://im5.ezgif.com/tmp/ezgif-5-d9ad6955f2.gif">
                        Guardians can take care of <b>1 size of pet</b> and <b>1 breed of dog</b> at
                        a time.
                        <img src="https://im5.ezgif.com/tmp/ezgif-5-1523c91a9d.gif">
                    </h4>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">

                    <form action="<?php echo FRONT_ROOT . "Booking/bookDate/" ?>" method="POST">

                        <input type="text" name="id" value="<?php echo $id ?>" hidden>
                        <input type="date" name="firstDay" value="<?php echo $firstDay ?>" hidden>
                        <input type="date" name="lastDay" value="<?php echo $lastDay ?>" hidden>

                        <?php
                        $breedDAO = new BreedDAO();

                        if ($petList != null) {
                            foreach ($petList as $pets) { ?>

                        <div class="filter-result">
                            <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                                <div class="job-left my-4 d-md-flex align-items-center flex-wrap">

                                    <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                        <img src="<?php echo $pets->getPicture(); ?>" />
                                    </div>

                                    <div class="job-content">

                                        <h5 class="h5-pets"><?php echo $pets->getName(); ?></h5>

                                        <ul>
                                            <li class="mr-md-4">
                                                <?php echo "<br>" . $pets->getSizeText() . " " .  $breedDAO->getBreedName($pets->getBreed()); ?>

                                                <?php if ($pets->getVideo() != null) {
                                                            echo "<br>Video: " . $pets->getVideo();
                                                        } else {
                                                            echo "<br>No video available";
                                                        } ?>

                                                <br><label>Vaccines: </label> <br>
                                                <div class="vacc-pic">
                                                    <img src="<?php echo $pets->getVaccination(); ?>" />
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="job-right my-4 flex-shrink-0">
                                    <label class="pet-select-container">
                                        <input type="checkbox" name="selectedPet[]"
                                            value="<?php echo $pets->getId(); ?>">
                                        Select
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                            <?php
                            }
                        } ?>

                            <div class="submitBtnBox">
                                <button name="submit" type="submit">Submit</button>
                            </div>
                    </form>

                </div>
            </div>

        </div>
        <br>
        <br>

</body>

</html>
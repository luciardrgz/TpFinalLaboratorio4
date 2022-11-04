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
                    <h3 class="top-c-sep"><br>Your Pets</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">

                    <?php

                    $breedDAO = new BreedDAO();

                    if ($petList != null) {
                        foreach ($petList as $pets) { ?>

                    <div class="filter-result">

                        <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                            <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                    PL
                                    <!-- foto según pettype-->
                                </div>
                                <div class="job-content">

                                    <h5 class="text-md-left"><?php echo $pets->getName(); ?></h5>

                                    <ul class="d-md-flex flex-wrap text-capitalize ff-open-sans">
                                        <li class="mr-md-4">
                                            <?php echo "<br>Breed: " . $breedDAO->getBreedName($pets->getBreed()); ?>
                                            <?php echo "<br>Picture: " . $pets->getPicture(); ?>
                                            <?php echo "<br>Video: " . $pets->getVideo(); ?>
                                            <?php echo "<br>Vaccines: " . $pets->getVaccination(); ?>
                                            <?php if ($pets->getType() == "D") {
                                                        echo "<br>Size: " . $pets->getSizeText();
                                                    } ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="job-right my-4 flex-shrink-0">
                                <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light">Remove</a>
                            </div>
                        </div>
                        <?php
                        }
                    } ?>

                    </div>
                </div>

            </div>
</body>

</html>
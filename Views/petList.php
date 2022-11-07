<?php

namespace Views;

use DB\BreedDAO;


include("navOwner.php");

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "list.css" ?>">
</head>

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

    <div class="container">
        <div class="row">
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">

                    <?php

                    $breedDAO = new BreedDAO();

                    if ($petList != null) {
                    ?>

                        <div class="title-div">
                            <h3 class="list-title">Your lovely pets</h3>
                        </div>

                        <?php foreach ($petList as $pets) { ?>

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

                                                    <?php echo "<br>Breed: " . $breedDAO->getBreedName($pets->getBreed()); ?>

                                                    <?php if ($pets->getVideo() != null) {
                                                        echo "<br>Video: " . $pets->getVideo();
                                                    } else {
                                                        echo "<br>No video available";
                                                    } ?>

                                                    <br><label>Vaccines: </label> <br>
                                                    <div class="vacc-pic">
                                                        <img src="<?php echo $pets->getVaccination(); ?>" />
                                                    </div>

                                                    <?php if ($pets->getType() == "D") {
                                                        echo "<br>Size: " . $pets->getSizeText();
                                                    } ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="job-right my-4 flex-shrink-0">
                                        <a href="<?php echo FRONT_ROOT . "Pet/remove/" . $pets->getId(); ?>" class="btn d-block w-100 d-sm-inline-block btn-light" onclick="return confirm('Are you sure that you want to remove that pet?')">Remove</a>
                                    </div>
                                </div>
                            <?php
                        }
                    } else { ?>
                            <div class="title-div">
                                <h3 class="list-title">You haven't added any pets yet :(</h3>
                            </div>
                        <?php
                    } ?>

                            </div>
                </div>

            </div>
</body>

</html>
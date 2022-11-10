<?php

namespace Views;

include("navOwner.php");

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "list.css" ?>">
</head>

<body>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

    <div class="container">
        <div class="row">

            <?php 
            if(isset($_GET['message'])){
                    $message = $_GET['message'];
                }
                if ($message != null) { ?>
            <div class="alert alert-danger">
                <?php echo $message;?>
            </div>
            <?php } ?>
 
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">


                    <div class="title-div">
                        <h3 class="list-title">Guardians available from 
                            <?php 
                            if (!isset($firstDay)){
                                if(isset($_GET['firstDay'])){
                                     $firstDay = $_GET['firstDay'];
                                 }
                            }
                             echo $firstDay; ?> to <?php 
                            if (!isset($lastDay)){
                                if(isset($_GET['lastDay'])){
                                    $lastDay = $_GET['lastDay'];
                                }
                            }
                             echo $lastDay ?> </h3>
                    </div>


                    <?php if ($guardianList != null) { ?>

                    <?php foreach ($guardianList as $guardian) { ?>

                    <div class="filter-result">
                        <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                            <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                <div class="guardian-id mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                    <?php echo "#" . $guardian->getId(); ?>
                                </div>
                                <div class="job-content">

                                    <h5 class="h5-guardians"><?php echo $guardian->getNickName(); ?></h5>

                                    <ul class="d-md-flex flex-wrap ff-open-sans">
                                        <li class="mr-md-4">
                                            <img
                                                src="https://img.icons8.com/material/24/null/user-male-circle--v1.png" />
                                            <?php echo $guardian->getFirstName() . " " . $guardian->getLastName(); ?>

                                            <br>

                                            <img src="https://img.icons8.com/material/24/null/new-post--v1.png" />
                                            <?php echo $guardian->getEmail(); ?>

                                            <br>

                                            <img src="https://img.icons8.com/material/24/null/phone--v1.png" />
                                            <?php echo $guardian->getPhoneNumber(); ?>

                                            <br>

                                            <img src="https://img.icons8.com/material/24/null/party-baloons--v1.png" />
                                            <?php echo $guardian->getBirthDate(); ?>

                                            <br>

                                            <img src="https://img.icons8.com/material/24/null/animal-shelter.png" />
                                            <?php echo "Willing to take care of " . $guardian->getPetsize() . " pets"; ?>

                                            <br>

                                            <img src="https://img.icons8.com/material/24/null/calendar-plus.png" />
                                            <?php echo "Available from " . $guardian->getFirstAvailableDay() . " to " . $guardian->getLastAvailableDay(); ?>

                                            <br>

                                            <?php if ($guardian->getScore() != null) {
                                                        ?>
                                            <img src="https://img.icons8.com/material/24/null/dog-bone.png" />
                                            <?php
                                                            echo "Score: " . $guardian->getScore() . "<br>";
                                                        }
                                                        ?>

                                            <img src="https://img.icons8.com/material/24/null/banknotes--v1.png" />
                                            <?php echo "Price per day: " . "$" . $guardian->getPrice(); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="job-right my-4 flex-shrink-0">
                                <a href="<?php echo FRONT_ROOT . "Booking/bookDate/" . $guardian->getId() . "/" . $firstDay . "/" . $lastDay ?>"
                                    class="btn d-block w-100 d-sm-inline-block btn-light">Hire</a>
                            </div>
                        </div>
                        <?php 
                        }
                    } else { ?>
                        <div class="title-div">
                            <h3 class="list-title">Sorry, no guardians available :(</h3>
                        </div>
                        <?php
                    } ?>
                    </div>
                </div>

            </div>
</body>

</html>
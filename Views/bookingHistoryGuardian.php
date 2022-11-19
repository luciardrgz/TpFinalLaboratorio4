<?php

namespace Views;

include("navGuardian.php");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pet Hero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "list.css" ?>">
</head>

<body>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="career-search mb-60">

                <?php if ($arrayRequests != null) { ?>

                <div class="title-div">
                    <h3 class="list-title">Booking History</h3>
                </div>

                <?php for ($i = 0; $i < count($arrayRequests); $i++) { ?>

                <div class="filter-result">

                    <div class="info-box d-md-flex align-items-center justify-content-between mb-30">
                        <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                            <div class="booking-content">

                                <h5 class="h5-guardians">
                                    <?php
                                            $status = $arrayRequests[$i]->getStatusText();

                                            echo $arrayNickname[$i] . "'s Request | ";

                                            if ($status == 'Accepted') { ?>
                                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "accepted.png" ?>" />
                                    <?php echo $status;
                                            } else if ($status == 'Rejected') { ?>
                                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "rejected.png" ?>" />
                                    <?php echo $status;
                                            } else if ($status == 'Finished') { ?>
                                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "finished.png" ?>" />
                                    <?php echo $status;
                                            } else if ($status == 'Confirmed') { ?>
                                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "Confirmed.png" ?>" />
                                    <?php echo $status;
                                            } else if ($status == 'Timed Out') { ?>
                                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "TimedOut.png" ?>" />
                                    <?php echo $status;
                                            } else if ($status == 'Rated') { ?>
                                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "Rated.png" ?>" />
                                    <?php echo $status;
                                            }
                                            ?>
                                </h5>

                                <ul>
                                    <li>
                                        <img src="https://img.icons8.com/material/24/null/calendar-plus.png" />
                                        <b><?php echo "From " . $arrayRequests[$i]->getStartDate() . " to " . $arrayRequests[$i]->getEndDate(); ?></b>

                                        <br>

                                        <img src="https://img.icons8.com/material/24/null/dog-paw-print.png" />
                                        <b><?php
                                                    $arrayPets = $arrayRequests[$i]->getPet();

                                                    echo "Pets to take care of: <br>";
                                                    ?></b>

                                        <?php foreach ($arrayPets as $pet) { ?>

                                        <div class="bh-pet-profile">
                                            <div
                                                class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                                <img src="<?php echo $pet->getPicture() ?>" />
                                            </div>

                                            <label><?php echo $pet->getName() . " | " . $pet->getSizeText() . " " .  $pet->getBreed(); ?></label>
                                        </div>

                                        <?php if ($pet->getVideo() != null) { ?>
                                        <b><label>Video: </label></b>
                                        <a href="<?php echo $pet->getVideo(); ?>"><?php echo $pet->getName() ?>'s
                                            video</a>
                                        <?php } else { ?>
                                        <b><label>No video available </label></b>
                                        <?php
                                                    } ?>

                                        <br><b><label>Vaccines: </label></b>
                                        <div class="vacc-pic">
                                            <img src="<?php echo $pet->getVaccination(); ?>" />
                                        </div>

                                        <?php
                                                } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php

                    }
                } else { ?>

                    <div class="title-div">
                        <h3 class="list-title">Your history is empty :(</h3>
                    </div>

                    <?php } ?>

                </div>
            </div>

        </div>
</body>

</html>
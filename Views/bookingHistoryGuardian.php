<?php

namespace Views;

include("navGuardian.php");

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

            <?php /*if ($message != null) { ?>
            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>
            <?php }*/ ?>

        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">
                    <!--
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
                    </form> 
                        -->

                    <?php if ($arrayRequests != null) { ?>

                    <div class="title-div">
                        <h3 class="list-title">Booking History</h3>
                    </div>

                    <?php for ($i = 0; $i < count($arrayRequests); $i++) { ?>

                    <div class="filter-result">

                        <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                            <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                <div class="booking-content">

                                    <h5 class="h5-guardians">
                                        <?php
                                                $status = $arrayRequests[$i]->getStatusText();

                                                echo $arrayNickname[$i] . "'s Request | ";

                                                if ($status == 'Accepted') { ?>
                                        <img src="https://i.ibb.co/31jPdqD/accepted.png" />
                                        <?php echo $status;
                                                } else if ($status == 'Rejected') { ?>
                                        <img src="https://i.ibb.co/3WPbhrj/rejected.png" />
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

                                                <label><?php echo $pet->getName() . " | "; ?></label> &nbsp;

                                                <?php if ($pet->getType() == "1") { ?>
                                                <label> <?php echo $pet->getSizeText() ?> </label> &nbsp;
                                                <?php }  ?>

                                                <label><?php echo $pet->getBreed(); ?></label>
                                            </div>

                                            <?php if ($pet->getVideo() != null) { ?>
                                            <b><label>Video: </label></b>
                                            <?php
                                                            echo $pet->getVideo();
                                                        } else { ?>
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
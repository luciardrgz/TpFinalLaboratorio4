<?php

namespace Views;

include("navOwner.php");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pet Hero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />


    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "list.css" ?>">
</head>

<body>

    <div class="error-msg">
        <?php if (isset($_GET['message'])) { ?>
        <div class="alert alert-danger">
            <?php echo $_GET['message']; ?>
        </div>
        <?php } ?>
    </div>

    <div class="listing">

        <?php if ($myBookings != null) { ?>

        <div class="title-div">
            <h3 class="list-title">Booking History</h3>
        </div>

        <?php for ($i = 0; $i < count($myBookings); $i++) { ?>

        <div class="filter-result">
            <div class="info-box d-md-flex align-items-center justify-content-between mb-30">

                <div class="booking-content">

                    <div class="booking-content-left">

                        <h5 class="h5-guardians">
                            <?php
                                    $status = $myBookings[$i]->getStatusText();

                                    if ($status == 'Accepted') { ?>
                            <img src="<?php echo  FRONT_ROOT . IMG_PATH . "accepted.png" ?>" />
                            <?php echo $status . " | " . $arrayNicknamesGuardian[$i];
                                    } else if ($status == 'Waiting') { ?>
                            <img src="<?php echo  FRONT_ROOT . IMG_PATH . "waiting.png" ?>" />

                            <?php } else if ($status == 'Confirmed') { ?>
                            <img src="<?php echo  FRONT_ROOT . IMG_PATH . "Confirmed.png" ?>" />
                            <?php echo $status . " | " . $arrayNicknamesGuardian[$i];
                                    } else if ($status == 'Timed Out') { ?>
                            <img src="<?php echo  FRONT_ROOT . IMG_PATH . "TimedOut.png" ?>" />
                            <?php echo $status;
                                    } else if ($status == 'Rated') { ?>
                            <img src="<?php echo  FRONT_ROOT . IMG_PATH . "Rated.png" ?>" />
                            <?php echo $status . " | " . $arrayNicknamesGuardian[$i];;
                                    } else if ($status == 'Waiting') { ?>
                            <?php echo $status . " for " . $arrayNicknamesGuardian[$i] . "'s response";
                                    } else if ($status == 'Rejected') { ?>
                            <img src="<?php echo  FRONT_ROOT . IMG_PATH . "rejected.png" ?>" />
                            <?php echo $status . " | " . $arrayNicknamesGuardian[$i];
                                    } else if ($status == 'Finished') { ?>
                            <img src="<?php echo  FRONT_ROOT . IMG_PATH . "finished.png" ?>" />
                            <?php echo $status . " | " . $arrayNicknamesGuardian[$i];
                                    } ?>
                        </h5>

                        <ul>
                            <li>
                                <img src="https://img.icons8.com/material/24/null/calendar-plus.png" />
                                <b><?php echo "From " . $myBookings[$i]->getStartDate() . " to " . $myBookings[$i]->getEndDate(); ?></b>

                                <br>


                                <img src="https://img.icons8.com/material/24/null/dog-paw-print.png" />
                                <b><?php
                                            $arrayPets = $myBookings[$i]->getPet();

                                            echo "Pets to take care of: <br>";
                                            ?></b>

                                <?php foreach ($arrayPets as $pet) { ?>

                                <div class="bh-pet-profile">
                                    <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                        <img src="<?php echo $pet->getPicture() ?>" />
                                    </div>

                                    <label><?php echo $pet->getName(); ?></label> &nbsp;

                                </div>

                                <?php
                                        } ?>
                            </li>
                        </ul>
                    </div>

                    <?php if ($status == 'Accepted') { ?>

                    <div class="booking-content-right">
                        <div class="pay-btn-box">
                            <a href="<?php echo FRONT_ROOT . "Booking/showPaymentView/" . $myBookings[$i]->getId() . "/" . $myBookings[$i]->getPrice() ?>"
                                class="btn btn-success">
                                Pay</a>
                        </div>
                    </div>

                    <?php } elseif ($status == 'Finished') { ?>

                    <div class="booking-content-right">
                        <form action="<?php echo FRONT_ROOT . "User/addScore/" ?>" method="POST">

                            <div class="BoxRate">

                                <div class="info">
                                    <label>1: Very Bad | 2: Bad | 3: Good | 4: Very Good | 5: Excellent</label>
                                    <div class="emoji"></div>
                                    <div class="status"></div>
                                    <input name="idGuardian" value="<?php echo $myBookings[$i]->getGuardianId() ?>"
                                        hidden>
                                </div>

                                <div class="stars">

                                    <input type="radio" class="star" name="score" data-rate="5" value='5'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </svg>


                                    <input type="radio" class="star" name="score" data-rate="4" value='4'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </svg>


                                    <input type="radio" class="star" name="score" data-rate="3" value='3'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </svg>


                                    <input type="radio" class="star" name="score" data-rate="2" value='2'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </svg>


                                    <input type="radio" class="star" name="score" data-rate="1" value='1'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </svg>
                                </div>

                                <input name="idBooking" value="<?php echo $myBookings[$i]->getId() ?>" hidden>

                                <div class="rate-btn-box">
                                    <button name="submit" type="submit">Rate</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <?php } ?>

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
</body>

</html>

<!-- JavaScript para mostrar emojis al ratear un guardian -->
<script>
const stars = document.querySelectorAll(".star");
const emojiEl = document.querySelector(".emoji");
const statusEl = document.querySelector(".status");
const defaultRatingIndex = 0;
let currentRatingIndex = 0;

const ratings = [{
        emoji: "🐾",
        name: "Rate this Guardian"
    },
    {
        emoji: "😔",
        name: "Very Bad"
    },
    {
        emoji: "🙁",
        name: "Bad"
    },
    {
        emoji: "🙂",
        name: "Good"
    },
    {
        emoji: "🤩",
        name: "Very Good"
    },
    {
        emoji: "🥰",
        name: "Excellent"
    }
];

const checkSelectedStar = (star) => {
    if (parseInt(star.getAttribute("data-rate")) === currentRatingIndex) {
        return true;
    } else {
        return false;
    }
};

const setRating = (index) => {
    stars.forEach((star) => star.classList.remove("selected"));
    if (index > 0 && index <= stars.length) {
        document
            .querySelector('[data-rate="' + index + '"]')
            .classList.add("selected");
    }
    emojiEl.innerHTML = ratings[index].emoji;
    statusEl.innerHTML = ratings[index].name;
};

const resetRating = () => {
    currentRatingIndex = defaultRatingIndex;
    setRating(defaultRatingIndex);
};

stars.forEach((star) => {
    star.addEventListener("click", function() {
        if (checkSelectedStar(star)) {
            resetRating();
            return;
        }
        const index = parseInt(star.getAttribute("data-rate"));
        currentRatingIndex = index;
        setRating(index);
    });

    star.addEventListener("mouseover", function() {
        const index = parseInt(star.getAttribute("data-rate"));
        setRating(index);
    });

    star.addEventListener("mouseout", function() {
        setRating(currentRatingIndex);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    setRating(defaultRatingIndex);
});
</script>
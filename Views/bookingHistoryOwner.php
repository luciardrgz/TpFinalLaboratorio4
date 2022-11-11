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

            <?php /*if ($message != null) { ?>
            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>
            <?php }*/ ?>

        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">

                    <?php if ($myBookings != null) { ?>

                    <div class="title-div">
                        <h3 class="list-title">Booking History</h3>
                    </div>

                    <?php for ($i = 0; $i < count($myBookings); $i++) { ?>

                    <div class="filter-result">

                        <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                            <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                <div class="booking-content">

                                    <h5 class="h5-guardians">
                                        <?php
                                                $status = $myBookings[$i]->getStatusText();

                                                if ($status == 'Accepted') { ?>
                                        <img src="https://i.ibb.co/31jPdqD/accepted.png" />
                                        <?php echo $status . " | " . $arrayNicknamesGuardian[$i]; ?>
                                        
                                        <div class="job-right my-4 flex-shrink-0">
                                            <a href="#" class="btn d-block w-100 d-sm-inline-block btn-success">
                                             Pay</a>
                                        </div>
                                        
                                               <?php } 
                                                else if ($status == 'Finished') { ?>
                                                <img src="https://i.ibb.co/GVx5TxH/finished.png"/>
                                                <?php echo $status . " | " . $arrayNicknamesGuardian[$i]; ?>

                                            <form action="<?php echo FRONT_ROOT ."User/addScore/"?>" method="POST">
                                            <div class="BoxRate">
                                            <div class="info">
                                                <div class="emoji"></div>
                                                <div class="status"></div>
                                                <input name="idGuardian" value="<?php echo $myBookings[$i]->getGuardianId() ?>" hidden>
                                            </div>
                                            
                                            <div class="stars">
                                                <span class="star-rating">
                                                <input type="radio" class="star" name="score" data-rate="1"  value='1'><!--<i></i> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">   
                                                </svg>
                                                
                                                
                                                <input type="radio" class="star" name="score" data-rate="2" value= '2'><!--<i></i>-->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                                </svg>
                                                

                                                <input type="radio" class="star" name="score" data-rate="3" value= '3'><!--<i></i>-->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">  
                                                </svg>
                                                

                                                <input type="radio" class="star" name="score" data-rate="4" value= '4'><!--<i></i>-->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                                </svg>
                                                

                                                <input type="radio" class="star" name="score" data-rate="5" value= '5'><!--<i></i>-->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                                </svg>
                                                </span>
                                                
                                            </div>
                                            <input name="idBooking" value="<?php echo $myBookings[$i]->getId() ?>" hidden>

                                            <div class="job-right my-4 flex-shrink-0">
                                            <button name="submit" type="submit" class="signup-btn">Rate</button>
                                            </div>
                                            
                                            </div>
                                            </form>
                                                <?php
                                                    }
                                                ?>
                                                
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
                                                <div
                                                    class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                                    <img src="<?php echo $pet->getPicture() ?>" />
                                                </div>

                                                <label><?php echo $pet->getName(); ?></label> &nbsp;

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
<script>
const stars = document.querySelectorAll(".star");
const emojiEl = document.querySelector(".emoji");
const statusEl = document.querySelector(".status");
const defaultRatingIndex = 0;
let currentRatingIndex = 0;

const ratings = [
  { emoji: "✨", name: "Rating" },
  { emoji: "😔", name: "Very Bad" },
  { emoji: "🙁", name: "Bad" },
  { emoji: "🙂", name: "Good" },
  { emoji: "🤩", name: "Very Good" },
  { emoji: "🥰", name: "Excellent" }
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
  star.addEventListener("click", function () {
    if (checkSelectedStar(star)) {
      resetRating();
      return;
    }
    const index = parseInt(star.getAttribute("data-rate"));
    currentRatingIndex = index;
    setRating(index);
  });

  star.addEventListener("mouseover", function () {
    const index = parseInt(star.getAttribute("data-rate"));
    setRating(index);
  });

  star.addEventListener("mouseout", function () {
    setRating(currentRatingIndex);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  setRating(defaultRatingIndex);
});
</script>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "landingPage.css" ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- Carousel -->
    <div class="carousel">

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo FRONT_ROOT . IMG_PATH . "bannerImage1.jpg" ?>" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "bannerImage2.jpg" ?>" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo FRONT_ROOT . IMG_PATH . "bannerImage3.jpg" ?>" class="d-block w-100">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Cards -->
    <div class="container">

        <div class="row row-cols-1 row-cols-md-3 g-4">

            <div class="guardianCol">
                <div class="card">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "card1.png" ?>" class="card-img-top" />
                    <div class="card-body">
                        <h5 align='center'><b>Find pets to care for</b></h5>
                        <h6 align='center'>If you enjoy <b>spending time with other people's pets</b>, you're in the
                            right
                            place
                        </h6>
                    </div>
                </div>
            </div>

            <div class="guardianCol">
                <div class="card">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "card2.jpg" ?>" class="card-img-top" />
                    <div class="card-body">
                        <h5 align='center'><b>Give love and receive it back</b></h5>
                        <h6 align='center'>Not only will you be able to take care of pets, but you will also <b>get
                                points</b> for doing so!
                        </h6>
                    </div>
                </div>
            </div>

            <div class="guardianCol">
                <div class="card">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "card3.jpg" ?>" class="card-img-top" />
                    <div class="card-body">
                        <h5 align='center'><b>One Rule: make them happy</b></h5>
                        <h6 align='center'>Pet Hero has many other guardians like you who want to make sure <b>pets
                                don't feel alone</b>
                        </h6>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Us  -->
    <div class="home-footer">
    Metodología de Sistemas 2023 - <b>Alemán Tomás y Rodriguez Lucía</b>
    </div>




</body>

</html>
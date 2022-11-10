<?php

namespace Views;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "BookingConfirmation.css" ?>">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5">
                        <img src="https://cdn.shopify.com/s/files/1/0552/1244/1789/files/LOGOTIPO_PET_HERO_1200x1200.png?v=1629479663"
                            width="10%">
                    </div>

                    <div class="invoice p-5">
                        <span class="font-weight-bold d-block mt-4">You're a tread away,
                            <?php echo $_SESSION['nickname'] ?>!</span>
                        <span>You have to confirm the information below in order to make your booking :)</span>

                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <br>

                            <h5>Booking information</h5>

                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="d-block text-muted">Booking Date</span>
                                            <span><?php echo $firstDay . " to " . $lastDay ?></span>
                                        </td>
                                        <td>
                                            <span class="d-block text-muted">Guardian Name</span>
                                            <span><?php echo $guardian->getFirstName(); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="product border-bottom table-responsive">

                            <table class="table table-borderless">

                                <h5>Pets to be cared for</h5>
                                <?php

                                foreach ($ArrayPets as $pet) { ?>
                                <tbody>
                                    <tr>
                                        <td width="10%">
                                            <img src="<?php echo $pet->getPicture(); ?>" width="90"
                                                class="selected-pet-pic">
                                        </td>

                                        <td width="60%">
                                            <span class="font-weight-bold"><?php echo $pet->getName() ?></span>
                                            <div class="product-qty">
                                                <span class="d-block">Breed:
                                                    <?php $pet->getBreed(); ?></span>
                                                <span>Size: <?php echo $pet->getSizeText() ?></span>
                                            </div>
                                        </td>
                                </tbody>
                                <?php } ?>
                            </table>
                        </div>
                        <br>
                        <p class="font-weight-bold mb-0">Thank you for trusting in our Guardians!</p>
                        <span>Pet Hero Team 🐾</span>
                    </div>

                    <div class="d-flex justify-content-between footer p-3">
                        <a href="<?php echo FRONT_ROOT . "Booking/add/" . $idPetsArray . "/" .  $firstDay . "/" .  $lastDay . "/" .  $guardian->getId() . "/" . $totalAmount; ?>"
                            class="btn d-block w-100 d-sm-inline-block btn-success">Confirm</a>
                    </div>

                    <div class="d-flex justify-content-between footer p-3">
                        <a href="<?php echo FRONT_ROOT . "User/showLandingPage/" . $_SESSION['type']; ?>"
                            class="btn d-block w-100 d-sm-inline-block btn-danger">Go home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>->
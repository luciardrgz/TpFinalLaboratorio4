<?php

namespace Views;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href=<?php echo CSS_PATH . "navOwner.css" ?>>
</head>

<body>
    <nav>
        <a href="<?php echo FRONT_ROOT . "User/showLandingPage/" . $_SESSION['type']; ?>">Home</a>
        <a href="<?php echo FRONT_ROOT . "User/showProfileInfo" ?>">Profile</a>
        <a href="<?php echo FRONT_ROOT . "Booking/showMyBookings" ?>">My&nbsp;bookings</a>
        <a href="<?php echo FRONT_ROOT . "Booking/showNewBookingDates" ?>">New&nbsp;booking</a>
        <a href="<?php echo FRONT_ROOT . "Pet/addPet" ?>">Add Pet</a>
        <a href="<?php echo FRONT_ROOT . "Pet/listPets" ?>">Pet list </a>
        <a href="<?php echo FRONT_ROOT . "Auth/logout" ?>">Logout</a>
        <div class="animation start-home"></div>
    </nav>

</body>

</html>
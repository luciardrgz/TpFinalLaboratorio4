<?php

namespace Views;

if ($_SESSION["type"] == "O") {
    include("navOwner.php");
} else if ($_SESSION["type"] == "G") {
    include("navGuardian.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your profile</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "profile.css" ?>">
</head>

<body>

    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <?php if ($_SESSION['type'] == 'O') { ?>
                    <img src="https://static.boredpanda.com/blog/wp-content/uploads/2021/08/Ba_JjS-jdVu-png__700.jpg" />
                    <?php } else { ?>
                    <img src="https://media.biobiochile.cl/wp-content/uploads/2021/09/cesarmillan.jpg" />
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5><b><?php echo $user->getFirstName() . " " . $user->getLastName() ?></b>
                    </h5>
                    <?php if ($_SESSION['type'] == 'O') { ?>
                    <h6><i><?php echo "Pet Owner"; ?></i></h6>
                    <?php } else { ?>
                    <h6><i><?php echo " Pet Guardian"; ?></i></h6>
                    <p class="profile-rating">Your guardian score: <span><?php if($user->getScore() != null){echo $user->getScore() . "/5";}else{echo 'empty';}?></span></p>
                    <?php } ?>

                </div>
            </div>

            <!--<div class=" col-md-2">
                <input type="submit" class="profile-btns" value="Edit profile" />
            </div> -->

        </div>
        <div class="row">

            <div class="col-md-4">
                <div class="profile-work">

                    <?php if ($_SESSION['type'] == 'G') { ?>
                    <form action="<?php echo FRONT_ROOT . "User/updatePetSizePreference/" ?>" method="POST">
                        <label class="edit-subtitle"><br> <b>My pet size preference</b> </label><br>

                        <select name="petSize" class="size-pref">
                            <option value="3">Big</option>
                            <option value="2">Medium</option>
                            <option value="1">Small</option>
                        </select>
                        <br><br>

                        <input type="submit" name="submit" class="profile-btns" value="Save preference" />
                    </form>

                    <form action="<?php echo FRONT_ROOT . "User/updateDate/" ?>" method="POST">

                        <label class="edit-subtitle"><br> <b>I'm available...</b> </label>

                        <div class="dates-div">
                            <label>From: </label>
                            <input type="date" name="firstDay" class="first-day-selector" required><br><br>
                            <label>to: </label>
                            <input type="date" name="lastDay" class="last-day-selector" required>
                        </div>

                        <input type="submit" name="submit" class="profile-btns" value="Save availability" />
                    </form>

                    <form action="<?php echo FRONT_ROOT . "User/updatePrice/" ?>" method="POST">

                        <label class="edit-subtitle"><br> <b>My daily rate</b> </label><br>
                        $&nbsp;<input type="number" name="price" min="0" max="9999" placeholder="999"
                            class="price-input" required>
                        <br><br>

                        <input type="submit" name="submit" class="profile-btns" value="Save price" />
                    </form>
                    <?php } ?>
                </div>
            </div>


            <div class="col-md-8">
                <div class="tab-content profile-tab">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                            </div>
                            <div class="col-md-6">
                                <label><?php echo $user->getFirstName() ?></label>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Last Name</label>
                            </div>
                            <div class="col-md-6">
                                <label><?php echo $user->getLastName() ?></label>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <label><?php echo $user->getEmail() ?></label>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone Number</label>
                            </div>
                            <div class="col-md-6">
                                <label><?php echo $user->getPhoneNumber() ?></label>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Date of Birth</label>
                            </div>
                            <div class="col-md-6">
                                <label><?php echo $user->getBirthDate() ?></label>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Nickname</label>
                            </div>
                            <div class="col-md-6">
                                <label><?php echo $user->getNickName() ?></label>
                            </div>
                        </div>
                        <br>

                        <?php if ($_SESSION['type'] == 'G') { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Pet size preference</label>
                            </div>
                            <div class="col-md-6">
                                <label><?php echo $user->getPetsize() ?></label>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Availability </label>
                            </div>

                            <div class="col-md-6">
                                <?php if ($user->getFirstAvailableDay() != null && $user->getLastAvailableDay() != null) { ?>
                                <label>
                                    <?php echo "From " . $user->getFirstAvailableDay() . " to " . $user->getLastAvailableDay();
                                    } ?></label>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Rate per day</label>
                            </div>
                            <div class="col-md-6">
                                <label><?php if ($user->getPrice() != null) {
                                                echo "$" . $user->getPrice();
                                            } ?></label>
                            </div>
                        </div>

                        <div class="note">
                            <label class="note-txt">Note: if you don't select a pet size preference, availability and
                                daily rate,
                                <br> you won't appear on our guardian list to be hired by pet owners</label>
                        </div>


                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

</body>

</html>
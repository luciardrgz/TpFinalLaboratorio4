<?php
namespace Views;

//session_start();
if($_SESSION["type"] == "O"){
    include("navOwner.php");
}else if($_SESSION["type"]== "G"){
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
    <link rel="stylesheet" type="text/css" href="<?php echo "/Lab4/TpFinalLaboratorio4/Views/css/Profile.css" ?>">
</head>

<body>

    <div class="container emp-profile">
                    <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="https://s.keepmeme.com/files/en_posts/20201223/delete-this-mark-zuckerberg-holding-gun-meme.jpg"
                            alt="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            <?php echo $user->getFirstName() . " " . $user->getLastName()?>
                        </h5>
                        <?php if($_SESSION['type'] == 'O'){?>
                        <h6><?php echo "Owner";?></h6>
                        <?php }else{?>
                         <h6><?php echo "Guardian";?></h6>
                         <p class="profile-rating">Your score: <span>8/10</span></p>
                         <?php }?>
                        
                    </div>
                </div>
                <div class=" col-md-2">
                    <input type="submit" class="profile-edit-btn" value="Edit Profile" />
                    
                    
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-4">
                    <div class="profile-work">

                    <?php if($_SESSION['type'] == 'G'){?>
                    <form action="<?php echo "/Lab4/TpFinalLaboratorio4/User/updatePetSizePreference/" ?>" method="POST"> 
                        <label><br> <b>Change pet size preference</b> </label><br>
                        
                        <select name="petSize">
                            <option value="Big">Big</option>
                            <option value="Medium">Medium</option>
                            <option value="Small">Small</option>
                        </select>
                        <br><br>

                        <input type="submit" name="submit" class="profile-edit-btn" value="Save Changes" />
                    </form>
                    <?php }?>
                       
                        <a href=""></a><br />
                        <a href=""></a><br />
                        <a href=""></a><br><br>
                        <label></label><br>
                        <a href=""></a><br />
                        <a href=""></a><br />
                        <a href=""></a><br />
                        <a href=""></a><br />
                        <a href=""></a><br />
                    </div>
                </div>
                
                    
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo $user->getFirstName()?></label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Last Name</label>
                                </div>
                                <div class="col-md-6">

                                    <label><?php echo $user->getLastName()?></label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo $user->getEmail()?></label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phonenumber</label>
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo $user->getPhoneNumber()?></label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Birth Date</label>
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo $user->getBirthDate()?></label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nickname</label>
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo $user->getNickName()?></label>
                                </div>
                            </div>
                            <br>

                            <?php if($_SESSION['type'] == 'G'){?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Pet size preference</label>
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo $user->getPetsize()?></label>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>

</body>

</html>
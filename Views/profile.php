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
                        <?php if($_SESSION['type'] == 'O'){?>
                        <img src="https://www.dogmagazine.net/wp-content/uploads/2014/12/The-dog-who-mimicks-their-owner.jpg"/>
                        <?php }else{?>
                            <img src="https://media.biobiochile.cl/wp-content/uploads/2021/09/cesarmillan.jpg"/>
                            <?php }?>
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

                        <input type="submit" name="submit" class="profile-edit-btn" value="Save preference" />
                    </form>
                    
                    <?php }?>
                        <form action="<?php echo "/Lab4/TpFinalLaboratorio4/User/updateDate/" ?>" method="POST"></form>  
                            <label><br> <b>My availability</b> </label><br>

                             
                            <input type="checkbox" <?php if(in_array("Mon",$availability){echo "checked";} ) ?>name="availability[]" value="Mon"> Monday <br>
                            <input type="checkbox" <?php if(in_array("Tue",$availability){echo "checked";} ) ?>name="availability[]" value="Tue"> Tuesday <br>
                            <input type="checkbox" <?php if(in_array("Wed",$availability){echo "checked";} ) ?>name="availability[]" value="Wed"> Wednesday <br>
                            <input type="checkbox" <?php if(in_array("Thu",$availability){echo "checked";} ) ?>name="availability[]" value="Thu"> Thursday <br>
                            <input type="checkbox" <?php if(in_array("Fri",$availability){echo "checked";} ) ?>name="availability[]" value="Fri"> Friday <br>
                            <input type="checkbox" <?php if(in_array("Sat",$availability){echo "checked";} ) ?>name="availability[]" value="Sat"> Saturday <br> 
                            <input type="checkbox" <?php if(in_array("Sun",$availability){echo "checked";} ) ?>name="availability[]" value="Sun"> Sunday 
                            <br><br>
                             
                            <input type="submit" name="submit" class="profile-edit-btn" value="Save date" />

                        </form>  
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
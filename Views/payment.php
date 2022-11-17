<?php 
namespace Views;

include("navOwner.php");
?>

<!DOCTYPE html>
<html>

<head>
<title>Pet Hero</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "payment.css" ?>">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Payment Details
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo FRONT_ROOT . "Mail/sendMail/"?>" method="POST" role="form">
                    <div class="form-group">

                    <input type="text" name="statusId" value="5" hidden/>
                    <input type="text" name="idBooking" value="<?php echo $idBooking ?>" hidden/>
                    <input type="text" name="price" value="<?php echo $price ?>" hidden/>
                    
                        <label for="cardNumber">
                            CARD NUMBER</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
                                required autofocus />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-xs-7 col-md-7">
                            <div class="form-group">
                                <label for="expityMonth">
                                    EXPIRY DATE</label>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
                                </div>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityYear" placeholder="YY" required /></div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-md-5 pull-right">
                            <div class="form-group">
                                <label for="cvCode">
                                    CV CODE</label>
                                <input type="password" class="form-control" id="cvCode" placeholder="CV" required />
                            </div>
                        </div>
                    </div>
                    <div class="final-payment">
                        <span>Final Payment:  </span>
                    </span><?php echo  "$" . $price  ?></span>
                     </div>
                     
                    <div class="pay-btn">
                     <button name="submit" type="submit" class="btn btn-warning" >Pay</button>
                    </div>
                    <div class ="comment-pay">
                        <span style="text-align: center; display:block;">This payment only covers 50% of the stay</span>
                     </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</div>

</body>
</html>
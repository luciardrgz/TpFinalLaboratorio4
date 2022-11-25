<?php

namespace DAOInterfaces;

use Models\Coupon as Coupon;

interface ICouponDAO
{
    public function add(Coupon $coupon);
}
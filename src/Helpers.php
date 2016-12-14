<?php
/**
 * Created by PhpStorm.
 * User: honfei
 * Date: 2016/12/14
 * Time: 11:40
 */

namespace Omnipay\Shenzhoufu;


class Helpers
{
    public static function sign($data, $key){
        return MD5($data['version'] + $data['merId'] + $data['payMoney'] + $data['orderId'] + $data['returnUrl'] + $data['privateField'] + $data['verifyType'] + $key);
    }
}
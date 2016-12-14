<?php
/**
 * 助手函数.
 * User: honfei
 * Date: 2016/12/14
 * Time: 11:40
 */

namespace Omnipay\Shenzhoufu;


class Helpers
{
    public static function sign($data, $key){
        $privateField = isset($data['privateField']) ? $data['privateField'] : '';
        $signkey =$data['version'].$data['merId'].$data['payMoney'].$data['orderId'].$data['returnUrl'].$privateField.$data['verifyType'].$key;
        return md5($signkey);
    }
}
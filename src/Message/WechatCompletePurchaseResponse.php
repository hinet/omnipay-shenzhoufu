<?php
/**
 * 异步通知接收响应.
 * User: honfei
 * Date: 2016/12/16
 * Time: 11:04
 */

namespace Omnipay\Shenzhoufu\Message;



use Omnipay\Common\Message\AbstractResponse;

class WechatCompletePurchaseResponse extends AbstractResponse
{

    public function isSuccessful()
    {
        //支付成功
        if($this->data['payResult'] == 1){
            return true;
        }else{
            return false;
        }
    }

    public function getOrderID()
    {
        return isset($this->data['orderId']) ? $this->data['orderId'] : null;
    }

    public function getTransactionReference()
    {
        return isset($this->data['payResult']) ? $this->data['payResult'] : null;
    }
}
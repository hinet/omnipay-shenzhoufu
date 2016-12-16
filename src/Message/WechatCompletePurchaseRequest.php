<?php
/**
 * 支付完成响应.
 * User: honfei
 * Date: 2016/12/14
 * Time: 12:58
 */

namespace Omnipay\Shenzhoufu\Message;


use Omnipay\Common\Exception\InvalidResponseException;

class WechatCompletePurchaseRequest extends WechatPurchaseRequest
{
    public function getData()
    {
        $orderId = $this->httpRequest->request->get('orderId');
        $payResult = $this->httpRequest->request->get('payResult');
        $payDetails = $this->httpRequest->request->get('payDetails');

        $sign=md5(static::API_VERSION.$this->getPartnerId().$this->getAmount().$this->getOrderId().$payResult.$this->getPrivateField().$payDetails.$this->getApiKey());
        if ($this->httpRequest->request->get('md5String') !== $sign) {
            throw new InvalidResponseException('Invalid md5String');
        }
        return $this->httpRequest->request->all();
    }
    public function sendData($data)
    {
        return $this->response = new WechatCompletePurchaseResponse($this, $data);
    }
}
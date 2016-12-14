<?php
/**
 * 支付响应.
 * User: honfei
 * Date: 2016/12/14
 * Time: 11:36
 */

namespace Omnipay\Shenzhoufu\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Shenzhoufu\Helpers;

class WechatPurchaseRequest extends AbstractRequest
{
    const API_VERSION = '3';//3.0
    protected $endpoint = 'http://pay3.shenzhoufu.com/version3/serverconnwxsm/entry.aspx';

    public function getData(){
        $this->validate(
            'orderId',
            'amount'
        );
        $data = array (
            'version'            => static::API_VERSION,
            'merId'           => $this->getPartnerId(),
            'payMoney'      => $this->getAmount(),
            'orderId'             => $this->getOrderId(),
            'returnUrl'           => $this->getNotifyUrl(),
            'merUserName'           => $this->getUserName(),
            'merUserMail'     => $this->getEmail(),
            'verifyType'        => $this->getVerifyType(),
        );
        //过滤数组为空值
        $data = array_filter($data);
        $data['privateField'] = $this->getPrivateField();//privateField是空值也要传递，所在放在外面
        $data['md5String'] = Helpers::sign($data, $this->getApiKey());
        return $data;
    }
    public function getPartnerId()
    {
        return $this->getParameter('partnerId');
    }

    public function setPartnerId($value)
    {
        return $this->setParameter('partnerId', $value);
    }
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }
    public function getAmount()
    {
        return $this->getParameter('amount');
    }
    public function setAmount($value)
    {
        return $this->setParameter('amount',$value);
    }
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }
    public function setOrderId($value)
    {
        return $this->setParameter('orderId',$value);
    }
    public function getNotifyUrl()
    {
        return $this->getParameter('notifyUrl');
    }

    public function setNotifyUrl($value)
    {
        return $this->setParameter('notifyUrl', $value);
    }
    public function getUserName()
    {
        return $this->getParameter('userName');
    }
    public function setUserName($value)
    {
        return $this->setParameter('userName',$value);
    }
    public function getEmail()
    {
        return $this->getParameter('email');
    }
    public function setEmail($value)
    {
        return $this->setParameter('email',$value);
    }
    public function getPrivateField(){
        return $this->getParameter('privateField');
    }
    public function setPrivateField($value){
        return $this->setParameter('privateField',$value);
    }
    public function getVerifyType(){
        return $this->getParameter('verifyType') ? $this->getParameter('verifyType') : 1;
    }
    public function setVerifyType($value){
        return $this->setParameter('verifyType',$value);
    }
    public function sendData($data)
    {
        $request = $this->httpClient->post($this->getEndpoint(), ["Content-type"=>"text/html; charset=utf-8"], $data);
        $reponse = $request->send();
        return $this->response = new WechatResponse($this, $reponse->json(),$this->getApiKey());
    }
    public function getEndPoint(){
        return $this->endpoint ? $this->endpoint : null;
    }
}
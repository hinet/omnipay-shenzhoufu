<?php
namespace Omnipay\Shenzhoufu;
use Omnipay\Common\AbstractGateway;

/**
 * 神州付支付网关
 * @package Omnipay\Shenzhoufu
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Shengzhoufu';
    }
    public function getDefaultParameters()
    {
        return array(
            'merId' => '',
            'apikey' => '',
            'verifyType' => '1',
            'version' => '3'
        );
    }
    public function getPartnerId(){
        return $this->getParameter('partnerId');
    }
    public function setPartnerId($value){
        return $this->setParameter('partnerId',$value);
    }
    public function getApiKey(){
        return $this->getParameter('apiKey');
    }
    public function setApiKey($value){
        return $this->setParameter('apiKey',$value);
    }
    public function getNotifyUrl()
    {
        return $this->getParameter('notifyUrl');
    }

    public function setNotifyUrl($value)
    {
        return $this->setParameter('notifyUrl', $value);
    }

    public function purchase(array $parameters = array()){
        return $this->createRequest('\Omnipay\Shenzhoufu\Message\WechatPurchaseRequest', $parameters);
    }
    public function completePurchase(array $parameters = array()){
        return $this->createRequest('\Omnipay\Shenzhoufu\Message\WechatCompletePurchaseRequest', $parameters);
    }
}
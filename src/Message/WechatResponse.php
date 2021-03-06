<?php
/**
 * Created by PhpStorm.
 * User: honfei
 * Date: 2016/12/14
 * Time: 12:32
 */

namespace Omnipay\Shenzhoufu\Message;


use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Shenzhoufu\QRcode;

class WechatResponse extends AbstractResponse
{
    private $apikey = '';
    public static $MESSAGES = array(
        '200'=>'请求通过，神州付收单，获取到二维码字符串',
        '101'=>'md5 验证失败',
        '106'=>'系统繁忙，请稍后再试',
        '902'=>'商户参数不全',
        '903'=>'商户 ID 不存在',
        '904'=>'商户没有激活',
        '905'=>'商户没有使用该接口的权限',
        '906'=>'密钥（privateKey）未配置，请登录partner.shenzhoufu.com',
        '907'=>'DES 密钥未配置，请联系神州付技术配置',
        '908'=>'该笔订单已经处理完成',
        '909'=>'该笔订单不符合重复支付的条件',
        '910'=>'服务器返回地址，不符合规范',
        '911'=>'订单号，不符合规范',
        '912'=>'非法订单',
        '917'=>'参数格式不正确',
    );
    function __construct(RequestInterface $request,$data,$key)
    {
        $this->apikey = $key;
        parent::__construct($request,$data);
    }

    public function isSuccessful()
    {
        if($this->data['resCode'] == 200){
            $sign = md5($this->data['resCode'].$this->data['orderId'].$this->data['qrCodeUrl'].$this->apikey);
            //校验签名
            return $sign == $this->data['md5String'];
        }else{
            return false;
        }


    }
    //获取二维码地址
    public function getQrcodeUrl()
    {
        return isset($this->data['qrCodeUrl']) ? (string) $this->data['qrCodeUrl'] : null;
    }

    /**
     * 生成二维码图片
     * @param int $matrixPointSize 点的大小：1到10
     * @param string $errorCorrectionLevel //纠错级别：L、M、Q、H
     */
    public function getQrcode($matrixPointSize=4,$errorCorrectionLevel = 'L'){
        $url = urldecode($this->data['qrCodeUrl']);
        // 输出图像
        exit(QRcode::png($url,false,$errorCorrectionLevel,$matrixPointSize));
    }
    //获取订单号
    public function getOrderID()
    {
        var_dump($this->data);
        return isset($this->data['orderId']) ? (string) $this->data['orderId'] : null;
    }

    /**
     * 获取错误信息
     * @return mixed|null
     */
    public function getMessage()
    {
        $code = $this->data['resCode'];
        return isset(static::$MESSAGES[$code]) ? static::$MESSAGES[$code] : null;
    }

}
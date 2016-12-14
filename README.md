# omnipay-alipay
神州付手机充值卡,游戏支付支付平台

# 安装

```php
composer require hinet/omnipay-shenzhoufu
```

# 使用

```php
$gateway    = Omnipay::create('Shengzhoufu');
$gateway->setPartnerId($config['partner_id']);
$gateway->setApiKey($config['api_key']);

$order = [
    'orderId'      => date('YmdHis').mt_rand(1000, 9999),
    'payMoney'         => 1, //=0.01
];

/**
 * @var Omnipay\WechatPay\Message\CreateOrderRequest $request
 * @var Omnipay\WechatPay\Message\CreateOrderResponse $response
 */
$request  = $gateway->purchase($order);
$response = $request->send();

//available methods
$response->isSuccessful();
$response->getData(); 
$response->getOrderId();
$response->getQrCodeUrl();
```

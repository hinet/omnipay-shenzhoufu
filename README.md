# omnipay-alipay
神州付手机充值卡,游戏支付支付平台

# 安装

```php
composer require hinet/omnipay-shenzhoufu
```

# 使用

```php
$gateway = Omnipay::create('Shenzhoufu');
$gateway->setPartnerId(config('payment.shenzhoufu.partner'));
$gateway->setApiKey(config('payment.shenzhoufu.apikey'));
$gateway->setNotifyUrl(config('payment.shenzhoufu.notifyUrl'));
$order = [
     'orderId'      => '201612141621487926',
     'amount'         => 1*100, //=0.01
];
$request  = $gateway->purchase($order);
$response = $request->send();
if($response->isSuccessful()){
     echo '<img src="'.$response->getQrcode().'">';
}else{
     $response->getMessage();
}
```

# 异步通知回调

```php
$gateway = Omnipay::create('Shenzhoufu');
$options = [
        'request_params'=> $_REQUEST,
];
$response = $gateway->completePurchase($options)->send();
if ($response->isSuccessful() && $response->getTransactionReference()) {
    //支付成功后操作
    exit($response->getOrderID());
} else {
    //支付失败通知.
    exit('支付失败');
}
```

<?php

namespace Omnipay\Weixin\Message;

class QrPurchaseRequest extends BasePurchaseRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validateData();
        $data = array(
            "appid"            => $this->getAppid(),
            "mch_id"           => $this->getMchid(),
            "nonce_str"        => md5(time()),
            "notify_url"       => $this->getNotifyUrl(),
            "out_trade_no"     => $this->getOutTradeNo(),
            "total_fee"        => $this->getTotalFee(),
            "body"             => $this->getBody(),
            "spbill_create_ip" => $this->getSpbillCreateIp(),
           // "time_start"       => $this->getTimeStart(),
           // "time_expire"      => $this->getTimeExpire(),
            "trade_type"       => "NATIVE",
            "product_id"       =>1
        );
        $data = array_filter($data);
        $data['sign'] = Helper::getParamsSignature($data, $this->getApiKey());

        return $data;
    }


    public function sendData($data)
    {
        return $this->response = new QrPurchaseResponse($this, $data);
    }
}

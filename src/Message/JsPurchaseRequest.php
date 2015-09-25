<?php

namespace Omnipay\Weixin\Message;

class JsPurchaseRequest extends BasePurchaseRequest
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
            "trade_type"       => "JSAPI",
            "openid"           => $this->getOpenid()
        );
        $data = array_filter($data);
        $data['sign'] = $this->getParamsSignature($data);
        $data['sign_type'] = $this->getSignType();

        return $data;
    }

    public function getOpenid()
    {
        return $this->getParameter('openid');
    }

    public function setOpenid($value)
    {
        $this->setParameter('openid', $value);
    }

}

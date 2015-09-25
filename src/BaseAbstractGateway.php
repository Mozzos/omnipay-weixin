<?php

namespace Omnipay\Weixin;

use Omnipay\Common\AbstractGateway;

/**
 * Weixin Base Gateway Class
 */
abstract class BaseAbstractGateway extends AbstractGateway
{

    public function getDefaultParameters()
    {
        return array(
            'partner'      => '',
            'key'          => '',
            'signType'     => 'MD5',
            'inputCharset' => 'utf-8',
            'transport'    => 'http',
            'paymentType'  => 1,
            'itBPay'       => '1d',
        );
    }

    public function getProductId()
    {
        return $this->getParameter('product_id');
    }

    public function setProductId($value)
    {
        $this->setParameter('product_id', $value);
    }

    public function getTradeType()
    {
        return $this->getParameter('trade_type');
    }

    public function setTradeType($value)
    {
        $this->setParameter('trade_type', $value);
    }

    public function getApiKey()
    {
        return $this->getParameter('api_key');
    }

    public function setApiKey($value)
    {
        $this->setParameter('api_key', $value);
    }

    public function getSpbillCreateIp()
    {
        return $this->getParameter('spbill_create_ip');
    }

    public function setSpbillCreateIp($value)
    {
        return $this->setParameter('spbill_create_ip', $value);
    }

    public function getAppid()
    {
        return $this->getParameter('appid');
    }

    public function setAppid($value)
    {
        $this->setParameter('appid', $value);
    }

    public function getMchid()
    {
        return $this->getParameter('mch_id');
    }

    public function setMchid($value)
    {
        $this->setParameter('mch_id', $value);
    }

    public function getBody()
    {
        return $this->getParameter('body');
    }

    public function setBody($value)
    {
        $this->setParameter('body', $value);
    }

    public function getDetail()
    {
        return $this->getParameter('detail');
    }

    public function setDetail($value)
    {
        $this->setParameter('detail', $value);
    }

    public function getOutTradeNo()
    {
        return $this->getParameter('out_trade_no');
    }

    public function setOutTradeNo($value)
    {
        $this->setParameter('out_trade_no', $value);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }


    public function setNotifyUrl($value)
    {
        $this->setParameter('notify_url', $value);
    }

    public function getTotalFee()
    {
        return $this->getParameter('total_fee');
    }


    public function setTotalFee($value)
    {
        $this->setParameter('total_fee', $value);
    }

    public function getTimeStart()
    {
        return $this->getParameter('time_start')?:date('YmdHis');
    }

    public function setTimeStart($value)
    {
        $this->setParameter('time_start', $value);
    }

    public function getTimeExpire()
    {
        return $this->getParameter('time_start')?:date('YmdHis',time()+60000);
    }

    public function setTimeExpire($value)
    {
        $this->setParameter('time_start', $value);
    }

    public function setCaCertPath($value)
    {
        if (! is_file($value)) {
            throw new InvalidRequestException("The ca_cert_path($value) is not exists");
        }

        return $this->setParameter('ca_cert_path', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Weixin\Message\ExpressPurchaseRequest', $parameters);
    }


    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Weixin\Message\ExpressCompletePurchaseRequest', $parameters);
    }
}

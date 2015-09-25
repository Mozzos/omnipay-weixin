<?php

namespace Omnipay\Weixin\Message;

use Illuminate\Support\Facades\Log;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpRedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


/**
 * Buckaroo Purchase Response
 */
class QrPurchaseResponse extends PurchaseResponse
{
    public $response;

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        if ($this->getRedirectMethod() == 'GET') {
            return $this->getRequest()->getEndpoint() . '?' . http_build_query($this->getRedirectData());
        } else {
            return $this->getRequest()->getEndpoint();
        }
    }


    public function getRedirectMethod()
    {
        return 'POST';
    }


    public function getRedirectData()
    {
        return $this->data;
    }

    public function getQrcodeUri()
    {
        $this->response = parent::fromXml($this->getRedirectResponse()->getContent());

        /*
        $qrParams = [
            'appid' =>$this->data['appid'],
            'mch_id' =>$this->data['mch_id'],
            'nonce_str' =>$this->data['nonce_str'],
            'product_id' =>$this->data['product_id'],
            'time_stamp' =>time()
        ];
        $qrParams['sign'] = Helper::getParamsSignature($qrParams, $this->request->getApiKey());
        $qrParamsStr = Helper::toUrlParams($qrParams,true);
        return $this->response['code_url'].'&'.$qrParamsStr;
        */
        Log::info($this->response);
        return $this->response['code_url'];
    }

    public function getRedirectResponse()
    {
        if (!$this instanceof RedirectResponseInterface || !$this->isRedirect()) {
            throw new RuntimeException('This response does not support redirection.');
        }

        if ('GET' === $this->getRedirectMethod()) {
            return HttpRedirectResponse::create($this->getRedirectUrl());
        } elseif ('POST' === $this->getRedirectMethod()) {
            $xml = $this->toXml($this->getRedirectData());
            return HttpResponse::create(parent::postXmlCurl($xml,$this->getRedirectUrl(),false));
        }

        throw new RuntimeException('Invalid redirect method "'.$this->getRedirectMethod().'".');
    }
}

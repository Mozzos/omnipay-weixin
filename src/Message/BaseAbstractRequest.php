<?php

namespace Omnipay\Weixin\Message;

use Exception;
use Illuminate\Support\Facades\Log;
use Omnipay\Common\Message\AbstractRequest;

abstract class BaseAbstractRequest extends AbstractRequest
{

    public function setPrivateKey($value)
    {
        $this->setParameter('private_key', $value);
    }


    public function setKey($value)
    {
        $this->setParameter('key', $value);
    }


    public function setSignType($value)
    {
        if (in_array($value, array('md5', 'rsa'))) {
            throw new Exception('sign_type should be upper case');
        }
        $this->setParameter('sign_type', $value);
    }


    public function getSignType()
    {
        return $this->getParameter('sign_type');
    }


    protected function signWithMD5($query)
    {
        return md5($query . $this->getKey());
    }


    public function getKey()
    {
        return $this->getParameter('key');
    }


    protected function signWithRSA($data, $privateKey)
    {
        $privateKey = $this->prefixCertificateKeyPath($privateKey);
        $res        = openssl_pkey_get_private($privateKey);
        openssl_sign($data, $sign, $res);
        openssl_free_key($res);
        $sign = base64_encode($sign);

        return $sign;
    }


    /**
     * Prefix the key path with 'file://'
     *
     * @param $key
     *
     * @return string
     */
    protected function prefixCertificateKeyPath($key)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN' && is_file($key) && substr($key, 0, 7) != 'file://') {
            $key = 'file://' . $key;
        }

        return $key;
    }


    public function getPrivateKey()
    {
        return $this->getParameter('private_key');
    }
}

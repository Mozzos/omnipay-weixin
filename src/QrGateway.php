<?php

namespace Omnipay\Weixin;

/**
 * Class ExpressGateway
 *
 * @package Omnipay\Weixin
 */
class QrGateway extends BaseAbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'Weixin Qr';
    }


    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Weixin\Message\QrPurchaseRequest', $parameters);
    }
}

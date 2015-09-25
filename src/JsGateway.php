<?php

namespace Omnipay\Weixin;

/**
 * Class ExpressGateway
 *
 * @package Omnipay\Weixin
 */
class JsGateway extends BaseAbstractGateway
{

    protected $service = 'create_direct_pay_by_user';


    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'Weixin Js';
    }


    public function purchase(array $parameters = array())
    {
        $this->setService($this->service);

        return $this->createRequest('\Omnipay\Weixin\Message\JsPurchaseRequest', $parameters);
    }
}

<?php
/**
 * Created by Haozhong.Liu on 9/25/15 11:42.
 * Email: udoless@gmail.com
 */


namespace Omnipay\Weixin\Message;


class Helper
{
    public static function getParamsSignature($data, $key)
    {
        ksort($data);
        $query = self::toUrlParams($data);
        $query = $query . "&key=". $key;
        $query = md5($query);
        $result = strtoupper($query);
        return $result;
    }

    /**
     * 格式化参数格式化成url参数
     */
    public static function toUrlParams($values, $withSign = false)
    {
        $buff = "";
        foreach ($values as $k => $v)
        {
            if($withSign)
                $sign = true;
            else
                $sign = $k != "sign";
            if($sign && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }
}
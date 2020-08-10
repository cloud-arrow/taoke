<?php

namespace CloudArrow\Taoke\Pinduoduo;

use GuzzleHttp\Client;

class Pinduoduo
{
    private $clientId;
    private $clientSecret;
    const URL = "http://gw-api.pinduoduo.com/api/router";

    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    private function getHttpClient()
    {
        return new Client();
    }

    private function getPublicParams($type)
    {
        $clientId = $this->clientId;
        $timestamp = time();
        $params = [
            'type'      => $type,
            'client_id' => $clientId,
            'timestamp' => $timestamp,
        ];

        return $params;
    }

    private function sign($params)
    {
        $clientSecret = $this->clientSecret;
        //按首字母升序排列
        ksort($params);
        //连接字符串，并在首尾加上client_secret
        $str = $clientSecret;
        foreach ($params as $k=>$v) {
            if ($k != 'sign' && $v !== '' && !is_array($v)) {
                $str .= $k.$v;
            }
        }
        $str = $str.$clientSecret;
        //生成签名 sign
        $sign = strtoupper(md5($str));

        return $sign;
    }

    //1. 查询已经生成的推广位信息：pdd.ddk.goods.pid.query
    //本接口用于您查询已经生成的推广位信息（推广位列表、推广位名称、剩余可用推广位数量，请注意，您的推广位数量有限，初始只有30万个，请谨慎使用）
    public function getPidList()
    {
        $type = 'pdd.ddk.goods.pid.query';
        $InputParams = [

        ];

        return  $this->common($type, $InputParams);
    }

    //1. 创建多多进宝推广位：pdd.ddk.goods.pid.generate
    //本接口用于您创建推广位。
    public function createPid($number = 10)
    {
        $type = 'pdd.ddk.goods.pid.generate';
        $InputParams = [
            'number'=> $number,
        ];

        return  $this->common($type, $InputParams);
    }

    //1. 多多进宝商品查询：pdd.ddk.goods.search
    //支持用标签、分类、商品价格、佣金等筛选条件（由入参range_list字段控制）过滤出满足条件的商品，也可根据排序条件对检索出来的商品进行排序（由入参sort_type进行排序）。
    public function searchGoods($keyword = '')
    {
        $type = 'pdd.ddk.goods.search';
        $InputParams = [
            'keyword'=> $keyword,
        ];

        return  $this->common($type, $InputParams);
    }

    //2. 多多进宝商品详情查询：pdd.ddk.goods.detail
    //本接口用于查询商品详情信息（商品标题、描述、金额等字段）。
    public function getGoodsDetail(array $goodsIdList)
    {
        $type = 'pdd.ddk.goods.detail';
        $InputParams = [
            'goods_id_list'=> '['.implode(',', $goodsIdList).']',
        ];

        return  $this->common($type, $InputParams);
    }

    private function common($type, $InputParams)
    {
        $publicParams = $this->getPublicParams($type);
        $params = array_merge($publicParams, $InputParams);
        $sign = $this->sign($params);
        $params['sign'] = $sign;
        $response = $this->getHttpClient()->request('POST', self::URL, ['json'=>$params])->getBody()->getContents();

        return json_decode($response, true);
    }
}

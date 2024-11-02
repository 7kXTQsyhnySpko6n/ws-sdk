<?php

namespace  Wcs;


class Config
{
    //version
    public $WCS_SDK_VER = "2.0.10";


    //url设置
    public $WCS_PUT_URL	= 'http://PUT_URL'; //WCS put 上传域名，可在统一控制台空间概览查看
    public $WCS_GET_URL	= 'http://GET_URL';    //WCS get 下载域名，客户自定义的下载域名
    public $WCS_MGR_URL	= 'http://MGR_URL';    //WCS MGR 管理域名，可在统一控制台空间概览查看

    //access key and secret key
    public $WCS_ACCESS_KEY	= '';
    public $WCS_SECRET_KEY	= '';

    //token的deadline,默认是1小时,也就是3600s
    public $WCS_TOKEN_DEADLINE = 3600;

    //上传文件设置
    public $WCS_OVERWRITE = 0; //默认文件不覆盖
    //超时时间
    public $WCS_TIMEOUT = 120;
    public $WCS_CONNECTTIMEOUT = 120;

    //虚拟内存目录
    public $WCS_RAM_URL = '/mnt/ramdisk/';

    //分片上传参数设置
    public $WCS_BLOCK_SIZE = 4194304; //4 * 1024 * 1024 默认块大小4M
    public $WCS_CHUNK_SIZE = 4194304; //  4 * 1024 * 1024 默认不分片
    public $WCS_RECORD_URL = ''; //默认当前文件目录
    public $WCS_COUNT_FOR_RETRY = 3;  //超时重试次数

    //并发请求数目
    public $WCS_CONCURRENCY = 5;
    
    //是否输出curl；请求信息
    public $CURLOPT_VERBOSE = true;

    public function __construct($WCS_ACCESS_KEY,$WCS_SECRET_KEY)
    {
        $this->WCS_ACCESS_KEY = $WCS_ACCESS_KEY;
        $this->WCS_SECRET_KEY = $WCS_SECRET_KEY;
     }
}


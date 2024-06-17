<?php

namespace Wcs;

class Auth
{

    public static function wcs_require_mac($mac,$config)
    {
        if (isset($mac)) {
            return $mac;
        }

        return new Mac($config->WCS_ACCESS_KEY, $config->WCS_SECRET_KEY );
    }

    public static function get_token($mac, $data,$config)
    {
        return self::wcs_require_mac($mac,$config)->get_token($data);
    }

    public static function get_token_with_data($mac, $data,$config)
    {
        return self::wcs_require_mac($mac,$config)->get_token_with_data($data);
    }

    public static function get_file_stat_token($bucketName, $fileName,$config) {
        $encodedEntry = Utils::url_safe_base64_encode($bucketName . ':' . $fileName);
        $encodedPath = '/stat/' . $encodedEntry . "\n";
        return self::wcs_require_mac(null,$config)->get_token($encodedPath);
    }

    public static function get_file_delete_token($bucketName, $fileName,$config) {
        $encodedEntry = Utils::url_safe_base64_encode($bucketName . ':' . $fileName);
        $encodedPath = '/delete/' . $encodedEntry . "\n";
        return self::wcs_require_mac(null,$config)->get_token($encodedPath);
    }

    public static function get_src_manage_token($path, $body = null,$config = null) {
        $signingStr = $path;
        if($body) {
            $signingStr .= $body;
        }
        return self::wcs_require_mac(null,$config)->get_token($signingStr);
    }
}

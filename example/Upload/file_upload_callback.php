<?php
require_once __DIR__ . '/../common.php';
use Wcs\Upload\Uploader;
use Wcs\Http\PutPolicy;
use Wcs\Config;

function print_help() {
    echo "Usage: php file_upload_calllback.php [-h | --help] -b <bucketName> -f <fileKey> -l <localFile> -c <callbackUrl> [-r <callbackBody>] [-u <userParam>] [-v <userVars>] [-m <mimeType>]\n";
}
$opts = "hb:f:l:r:c:u:v:m:";
$longopts = array (
    'h',
    'help'
);

$options = getopt($opts, $longopts);
if (isset($options['h']) || isset($options['help'])) {
    print_help();
    exit(0);
}

if (!isset($options['b']) || !isset($options['f']) || !isset($options['l'])  || !isset($options['c'])) {
    print_help();
    exit(0);
}

$bucketName = $options['b'];
$fileKey = $options['f'];
$localFile = $options['l'];
$callbackUrl = $options['c'];
$callbackBody =  $options['r'];
$userParam = (isset($options['u'])) ? $options['u'] : null;
$userVars = (isset($options['v'])) ? $options['v'] : null;
$mimeType = (isset($options['m'])) ? $options['m'] : null;

print("bucket: \t$bucketName\n");
print("file: \t\t$fileKey\n");
print("localFile: \t$localFile\n");
print("callbackUrl: \t$callbackUrl\n");
print("callbackBody: \t$callbackBody\n");

print("\n");
$pp = new PutPolicy();
$pp->overwrite = Config::WCS_OVERWRITE;
if ($fileKey == null || $fileKey === '') {
    $pp->scope = $bucketName;
} else {
    $pp->scope = $bucketName . ':' . $fileKey;
}
$pp->callbackUrl = $callbackUrl;
$pp->callbackBody = $callbackBody;
$token = $pp->get_token();
$client = new Uploader($token, $userParam, $userVars, $mimeType);
$res = $client->upload_return($localFile);
print_r($res->code." ".$res->respBody);
print("\n");

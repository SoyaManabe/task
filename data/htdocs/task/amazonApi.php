<?php
define("ACCESS_KEY_ID"     , 'AKIAIQA3Z6UDRTQASMBA');
define("SECRET_ACCESS_KEY" , '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');
define("ASSOCIATE_TAG"     , 'rikean-22');
define("ACCESS_URL"        , 'http://ecs.amazonaws.jp/onca/xml');

$base_param = 'AWSAccessKeyId='.ACCESS_KEY_ID;

$params = array();
$params['Service']       = 'AWSECommerceService';
$params['Version']       = '2013-08-01';
$params['Operation']     = 'ItemSearch';
$params['SearchIndex']   = "Books";
$params['Title']         = 'リーダブルコード';
$params['AssociateTag']  = ASSOCIATE_TAG;
$params['ResponseGroup'] = 'ItemAttributes,Images';
$params['Timestamp']     = gmdate('Y-m-d\TH:i:s\Z');

/*
ksort($params);

$canonical_string = $base_param;
foreach ($params as $k => $v) {
	$canonical_string .= '&'.urlencode_RFC3986($k).'='.urlencode_RFC3986($v);
}

function urlencode_RFC3986($str)
{
	return str_replace('%7E', '~', rawurlencode($str));
}

$parsed_url = parse_url(ACCESS_URL);
$string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$canonical_string}";

$signature = base64_encode(
		hash_hmac('sha256', $string_to_sign, SECRET_ACCESS_KEY, true)
	);

$url = ACCESS_URL.'?'.$canonical_string.'&Signature='.urlencode_RFC3986($signature);
*/
ksort($params);

$parameter = '';
foreach ($params as $key => $value) {
	$parameter .= $key . '=' . rawurlencode($value) . '&';
}
$parameter = rtrim($parameter, '&');
$signature = "GET\necs.amazonaws.jp\n/onca/xml\n" . $parameter;
$signature = hash_hmac('sha256', $signature, SECRET_ACCESS_KEY, true);
$signature = rawurlencode(base64_encode($signature));

$request_url = 'http://ecs.amazonaws.jp/onca/xml?' . $parameter . '&Signature=' . $signature;

$xml = simplexml_load_file($request_url);

return $xml;

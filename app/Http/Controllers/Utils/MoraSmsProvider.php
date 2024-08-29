<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class MoraSmsProvider extends Controller
{
    public $client;

    protected $key;

    private function __construct()
    {
        $this->client = new Client([
            'base_uri' => "https://mora-sa.com/api/v1/sendsms",
            'verify' => false
        ]);


         $this->key = "api_key=" . $this->apiKey() . "&username=" . $this->username();

    }


    public static function sendSms(String $numbers, String $message)
    {
        $options = [
            'sender'   => 'Afras',
            'numbers' => (new self)->_numbers($numbers),
            'message'  => $message,
            'response' => 'json'
        ];
        
        $resp = (new self)->handleResponse((new self)->_sms("sendsms", $options));

        if(is_object($resp)){

             return (new self)->errorMessages($resp->code);
        }

        return $resp;
    }

    public static function balance()
    {
        $resp = (new self)->handleResponse((new self)->_sms("balance"));

        return (new self)->responseData($resp,"balance");
    }

    public static function senderNames()
    {
        $resp = (new self)->handleResponse((new self)->_sms("sender_names"));

        return (new self)->responseData($resp,"sender_names");
    }

    private function responseData($response,$property)
    {
        if(is_object($response)){

            return $response->$property;
        }
        return $response;
    }

    private function apiKey()
    {
        return getSettingValue("smsToken") ?? "d1d38f274df6a2429da059b191c1041ec292c71e";
    }

    private function username()
    {
        return (getSettingValue("smsUsername") ?  getSettingValue("smsUsername") : '966595517111');
    }

    private function _numbers($numbers)
    {
        if (is_array($numbers)) {
            return implode(",", $numbers);
        }

        return $numbers;
    }

    private function _sms(String $route, array $options = [])
    {

        try {
             return $this->client->get("$route?" . $this->key . (new self)->_queryParams($options));

        } catch (\Throwable $th) {

            $e = explode("\n", $th->getMessage());

            if(is_array($e) && array_key_exists(1,$e)){

                return $this->errorMessages(json_decode($e[1])->status->code);
            }

            return trans("common.error");
        }
    }


    private function handleResponse($response)
    {


        if(is_string($response)){

            return $response;
        }

        if ($response->getStatusCode() == 200) {

            $data =  json_decode($response->getBody()->getContents());

            return $data->data;
        }

        return $response;
    }

    private function _queryParams($options)
    {
        $query = "";

        foreach ($options as $key => $item) {
            $query .= "&$key=$item";
        }

        return $query;
    }


    private function errorMessages($code)
    {
        $erros = [
            '100' => trans("common.ok"),
            '105' => trans("common.sms_balance"),
            '106' => trans("common.senderName"),
            '107' => trans("common.senderBlocked"),
            '108' => trans("common.noNumbers"),
            '112' => trans("common.messageHasBlokedKey"),
            '114' => trans("common.accountBlocked"),
            '115' => trans("common.phoneNotActive"),
            '116' => trans("common.EmailNotActive"),
            '117' => trans("common.messageRequired"),
            '118' => trans("common.senderNameRquired"),
            '119' => trans("common.numbersRequired"),
            '401' => trans("common.not_auth"),
        ];

        return array_key_exists($code, $erros) ? $erros[$code] : trans("common.error");
    }
}

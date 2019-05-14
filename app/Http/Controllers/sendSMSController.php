<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sendSMSController extends Controller
{
    private $_endpoint;
    public $key;
    public $message;
    public $numbers;
    public $sender;

    public function __construct()
    {
        $this->_endpoint = 'https://apps.mnotify.net/smsapi';
    }

    public function sendMessage()
    {
        $url = $this->_endpoint . "?key=" . $this->key . "&to=" . $this->numbers . "&msg=" . $this->message . "&sender_id=" . $this->sender;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $result = curl_exec($ch);
        curl_close ($ch);
        return $this->interpret($result);
    }

    private function interpret($code)
    {
        $status = '';
        switch ($code) {
            case '1000':
                $status = 'Messages has been sent successfully';
                return $status;
                break;
            case '1002':
                $status = 'SMS sending failed. Might be due to server error or other reason';
                return $status;
                break;
            case '1003':
                $status = 'Insufficient SMS credit balance';
                return $status;
                break;
            case '1004':
                $status = 'Invalid API Key';
                return $status;
                break;
            case '1005':
                $status = 'Invalid recipient\'s phone number';
                return $status;
                break;
            case '1006':
                $status = 'Invalid sender id. Sender id must not be more than 11 characters. Characters include white space';
                return $status;
                break;
            case '1007':
                $status = 'Message scheduled for later delivery';
                return $status;
                break;
            case '1008':
                $status = 'Empty Message';
                return $status;
                break;
            default:
                return $status;
                break;
        }
    }
}

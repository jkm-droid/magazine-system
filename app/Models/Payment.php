<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    private $accessKey = 'NAvzQnSJhAgRckhVxPVALxEGDhGnynwkdugEbhQdCUeTeXyVLAyCYTuVdRuqW';
    private $ivKey = "McjqbdvDTPhDaLqS";
    private $secretKey = "FpgrKqHXDGSjChDS";

    /**
     * request access for payment to the central system
     */

//    public function accessFirstCode(){
//        $url = 'https://central.firstcodesystems.com/system/get_token.php';
//        $ch = curl_init($url);
//
//        // Setup request to send json via POST
//        $data = array(
//            "system_name"=>"paytest",
//            "secret_key"=>"Eft9q7vhi3bV0KWNQueSRaxOLAMrPsHTo85zG4yY2nUlJIFZcm",
//            "server_key"=>"m8J67Ybi0KRZkDxUETutpvS1BXVwlyqFQcNAgM3Ws4d9anzI5P"
//        );
//        $payload = json_encode($data);
//
//        // Attach encoded JSON string to the POST fields
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $result = curl_exec($ch);
//        $access = json_decode($result);
//        // echo $result;
//        $token = $access->token;
//        curl_close($ch);
//        return $token;
//    }

//    public function newTinggRequest($payrequest){
//        $token = $this->accessFirstcode();
//
//        $data = array("integration"=>"Tingg", "payrequest"=>$payrequest);
//
//        $url = 'https://central.firstcodesystems.com/payment/new.php';
//        $ch = curl_init($url);
//
//        $authorization = "Authorization: Bearer $token";
//        $payload = json_encode($data);
//        // echo $payload;
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization));
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $result = curl_exec($ch);
//        curl_close($ch);
//        // echo $result;
//        return json_decode($result, true);
//    }

   /**
     * checking out the encryption
     */
    public function checkoutEncryption(){
        $encryptedParams = $this->encrypt($this->ivKey, $this->secretKey, json_decode(file_get_contents('php://input'), true));
        $result = [
            'params' => $encryptedParams,
            'accessKey' => $this->accessKey,
            'countryCode' => $this->request['countryCode']
        ];

        echo json_encode($result);
    }

    /**
     * Encrypt the string containing customer details with the IV and secret
     * key provided in the developer portal
     *
     * @return $encryptedPayload
     */
    public function encrypt($ivKey, $secretKey, $payload = []){
        //The encryption method to be used
        $encrypt_method = "AES-256-CBC";

        // Hash the secret key
        $key = hash('sha256', $secretKey);

        // Hash the iv - encrypt method AES-256-CBC expects 16 bytes
        $iv = substr(hash('sha256', $ivKey), 0, 16);
        $encrypted = openssl_encrypt(
            json_encode($payload, true), $encrypt_method, $key, 0, $iv
        );

        //Base 64 Encode the encrypted payload
        $encryptedPayload = base64_encode($encrypted);

        return $encryptedPayload;
    }
}

<?php

namespace App\HelperFunctions;

trait AccessFirstCode
{
    /**
     * request access for payment to the central system
     */

    public function accessFirstCode(){
        $url = 'https://central.firstcodesystems.com/system/get_token.php';
        $ch = curl_init($url);

        // Setup request to send json via POST
        $data = array(
            "system_name"=>"magazine_blog",
            "secret_key"=>"6ne0pVwWZ5xUjO23ckvszP8rybhMgCu1FfKNDBGRtlSa4dJmEY",
            "server_key"=>"BTXQWdeY6x72kghzoMqvb1tHPVpuA8w3KSDICEOFyRsL0nZcNG"
        );
        $payload = json_encode($data);

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $access = json_decode($result);
        // echo $result;
        $token = $access->token;
        curl_close($ch);
        return $token;
    }
}

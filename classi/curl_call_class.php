<?php
class CurlCallClass
{
    
    public static function curl_call($url, $method, $data = null) {
        $ch = curl_init();
    
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        } else {
            if($data != null)
                curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($data));
            else
                curl_setopt($ch, CURLOPT_URL, $url);
        }
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
    
        curl_close($ch);
    
        return $response;
    }
}
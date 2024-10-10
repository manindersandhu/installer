<?php

namespace Manindersandhu\Installer\Traits;

use Illuminate\Http\Request;

trait SetEnvironment
{
    public function uploadLog()
    {
        $domainName     = str_replace(['https://www.', 'http://www.', 'https://', 'http://', 'www.'], '', request()->getHttpHost());
        $domainIp       = request()->ip();
        $data = array(
            'base_url'        => $domainName,
            'domain_ip'          => $domainIp,
            'item_id' => config('installer.random') ?? 'removed'
        );
        $url = "http://localhost/savepath.php";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        $response = curl_exec($ch);
        return json_decode($response);
    }
}

<?php
class nc {
    private $serverIP;
    private $userNC;
    private $apiNC;
    
	public function __construct($serverIP, $userNC, $apiNC) {
		$this->Sip = $serverIP;
		$this->Auser = $userNC;
		$this->Akey = $apiNC;
	}
	
    public function iSAvailable($domain, $args) {
        $url = "https://api.namecheap.com/xml.response?ApiUser=$this->Auser&ApiKey=$this->Akey&UserName=$this->Auser&Command=namecheap.domains.check&ClientIp=$this->Sip&DomainList=$domain";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_USERAGENT,'IDK');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $res = curl_exec($ch);
        curl_close($ch);
        $xmlR = simplexml_load_string($res);
        $thisJS = json_encode($xmlR);
        $decJS = json_decode($thisJS, true);

        $ipr = $decJS['CommandResponse']['DomainCheckResult']['@attributes']['IsPremiumName'];
        if ($ipr = 'false') {
            $status = $decJS['@attributes']['Status'];
            if ($status == 'OK') {
                $check = $decJS['CommandResponse']['DomainCheckResult']['@attributes']['Available'];
                 if ($check == 'false') {
                     echo "Taken.";
                 } else {
                     echo "Available";
                 }
            } else {
                echo "Err Not Available";
            }
        } else {
            echo "This is a premium domain please contact support to register it.";
        }
        
    }
    
}
?>

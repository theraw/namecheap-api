<?php
$serverIP = 'xxxxxxxxxxxxx';
$userNC = 'xxxxxxxxxxxx';
$apiNC = 'xxxxxxxxxxxxxx';
    
require 'nc-class.php';
$nc = new nc($serverIP, $userNC, $apiNC);

$nc->iSAvailable("dope.al");

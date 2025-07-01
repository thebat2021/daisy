<?php

// --- Functions to get information (same as before) ---

function getClientIpAddress() {
    $ipAddress = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipParts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ipAddress = trim($ipParts[0]);
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddress;
}

function getRobustClientIp() {
    $ipKeys = array(
        'HTTP_CF_CONNECTING_IP',
        'HTTP_INCAP_CLIENT_IP',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_TRUE_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_CLIENT_IP',
        'HTTP_X_REAL_IP',
        'REMOTE_ADDR'
    );

    foreach ($ipKeys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return 'UNKNOWN';
}

// --- Collect the information ---

$timestamp = date("Y-m-d H:i:s");
$clientIp = getClientIpAddress();
$robustClientIp = getRobustClientIp();
$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'N/A';
$clientPort = isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : 'N/A';
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'N/A';

$serverIp = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : 'N/A';
$serverName = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'N/A';
$serverHostname = gethostname();
$serverPort = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 'N/A';
$serverSoftware = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'N/A';
$documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : 'N/A';
$phpOsUname = php_uname();
$phpOsConstant = PHP_OS;
$phpVersion = phpversion();
$scriptFilename = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : 'N/A';

// --- Prepare the content to write to the file ---

$fileContent = "--- System Information Log ({$timestamp}) ---\n";
$fileContent .= "Client Information:\n";
$fileContent .= "  Your IP Address: {$clientIp}\n";
$fileContent .= "  Your IP Address (Robust): {$robustClientIp}\n";
$fileContent .= "  Your Browser/OS (User Agent): {$userAgent}\n";
$fileContent .= "  Your Port: {$clientPort}\n";
$fileContent .= "  Referring Page: {$referer}\n";
$fileContent .= "\n";
$fileContent .= "Server Information:\n";
$fileContent .= "  Server IP Address: {$serverIp}\n";
$fileContent .= "  Server Name: {$serverName}\n";
$fileContent .= "  Server Hostname: {$serverHostname}\n";
$fileContent .= "  Server Port: {$serverPort}\n";
$fileContent .= "  Server Software: {$serverSoftware}\n";
$fileContent .= "  Document Root: {$documentRoot}\n";
$fileContent .= "  PHP Operating System (php_uname()): {$phpOsUname}\n";
$fileContent .= "  PHP Operating System (PHP_OS constant): {$phpOsConstant}\n";
$fileContent .= "  PHP Version: {$phpVersion}\n";
$fileContent .= "  Script Filename: {$scriptFilename}\n";
$fileContent .= "------------------------------------------------\n\n";

// --- Define the filename ---
$filename = 'tomb/tomb.txt';

// --- Write to the file ---
$fileHandle = fopen($filename, 'a'); // 'a' mode appends to the file. Use 'w' to overwrite.

if ($fileHandle) {
    fwrite($fileHandle, $fileContent);
    fclose($fileHandle);
    $message = "Information successfully written to '{$filename}'.";
} else {
    $message = "Error: Could not open the file '{$filename}' for writing. Check file permissions.";
}

// --- Display feedback to the user (optional, for web display) ---
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Daisy Clinics - Live Show </title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        pre { background-color: #eee; padding: 10px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container" style="text-align: center;">
        <h1>⚠️<br> اي شخص هيستعمل السيستم بتاعي  مع النصاب مصطفى هنيكه </h1>

        <h2>  النصاب و الخولات و الشراميط المحظور التعامل معاهم <br> 👇🏻</h2>

        <p style="color: red; font-weight:bolder;">Mustafa Sarya 
            <br>
            Rony Salib
            <br>
            Marianna Kamal
            <br>
            Marina Morkos
            <br>
            Nizar Ghareeb
            <br>
            Ahmed Nageeb
            
        </p>

          <h3>🏴‍☠️ <br>سرقة كود السيستم تعتبر جريمة الكترونية ضدي و من حقي الكامل الدفاع عن نفسي و ممارسة اي اعمال تخريبية بالقرصنة ضد النصاب و اي حد شغال معاه و بيستعمل السيستم الخاص بيا  
            <br>
⛔ <br> انا غير مسؤول عن اللي هيحصل لاي حد لاني حذرت كتير و ده اخر تحذير <br> ⛔</h3>
    </div>
</body>
</html>
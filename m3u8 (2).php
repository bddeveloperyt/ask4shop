<?php
if (!in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1'])) {
    if (!isset($_SERVER['HTTP_REFERER']) || 
        parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) !== $_SERVER['HTTP_HOST']) {
        header('HTTP/1.0 403 Forbidden');
        exit('Access Denied');
    }
}

$willowusa = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '.m3u8');

if (empty($willowusa)) {
    echo 'Error: Missing "id" parameter in the URL.';
    exit;
}

$initialUrl = 'https://apex2nova.com/premium.php?player=desktop&live=' . urlencode($willowusa);
$initialReferer = 'https://stream.crichd.vip/';

$chInitial = curl_init($initialUrl);

curl_setopt_array($chInitial, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_REFERER => $initialReferer,
]);

$responseInitial = curl_exec($chInitial);

if ($responseInitial === false) {
    echo 'Curl error: ' . curl_error($chInitial);
    curl_close($chInitial);
    exit;
}

curl_close($chInitial);

$pattern = '/return\(\[(.*)\]/';
if (preg_match($pattern, $responseInitial, $matches)) {
    $cleanString = trim(str_replace(['return([', '","', '\/', '\\', ']'], ['', '', '/', '', ''], $matches[1]), '"');
    $cleanString = preg_replace('#(?<=https:)/+#', '//', $cleanString);

    $chSecond = curl_init($cleanString);
    $newReferer = 'https://apex2nova.com/';

    curl_setopt_array($chSecond, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_REFERER => $newReferer,
    ]);

    $responseSecond = curl_exec($chSecond);

    if ($responseSecond === false) {
        echo 'Curl error (second request): ' . curl_error($chSecond);
    } else {
        // Modify the clean string based on the specified pattern
        $modifiedCleanString = preg_replace('#(/hls/)[^$]+#', '$1', $cleanString);

        // Add "/ts.php?url=" before "https://"
        $finalResponse = str_replace('https://', 'https://', str_replace($willowusa, $modifiedCleanString . $willowusa, $responseSecond));

        // Echo the final response
        echo $finalResponse;
    }

    curl_close($chSecond);
} else {
    echo 'Go back Server Not Found';
}
?>

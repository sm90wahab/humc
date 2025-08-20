<?php
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

$reportUrl = 'https://forms.zohopublic.com/FSC-Hayat-Admissions/report/HUMCRCStudentRegistration2025/reportperma/XdsonQ24mK2kxEL51tLoD3mQoA7p2WPOQy1EWwSA2tc';

$ch = curl_init($reportUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115 Safari/537.36');

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Language: en-US,en;q=0.9'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($httpCode === 200 && $response) {
    // Fix relative paths for CSS, JS, images
    $base = dirname($reportUrl);
    $response = preg_replace('/(href|src)=\"(?!https?:\/\/|\/\/)([^"]+)\"/', '$1="' . $base . '/$2"', $response);

    echo $response;
} else {
    echo "<h2>Error loading Zoho content</h2>";
    echo "<p>Status Code: $httpCode</p>";
    if (!empty($error)) {
        echo "<p>cURL Error: $error</p>";
    }
}
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
        </head>
    <body>
    </body>
</html>
<?php
//the url defines records of it collage and bachelor program
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// timeout= 30 seconds
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$response = curl_exec($ch);

// Check if the request failed
if ($response === false) {
    die('API request failed: ' . curl_error($ch));
}

curl_close($ch); // Close cURL session

$data = json_decode($response, true); // JSON response into a PHP associative array.

// Continue with your table rendering...
echo "<h1>student table</h1>";
echo "<table border='1'>
<tr>
    <th>year</th>
    <th>semester</th>
    <th>Program</th>
    <th>Nationality</th>
    <th>College</th>
 
 <th>Number of Students</th>
</tr>";

if (isset($data['results'])) {
    foreach ($data['results'] as $record) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($record['year'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['semester'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['the_programs'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['nationality'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['colleges'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['number_of_students'] ?? 'N/A') . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No data found</td></tr>";
}
echo "</table>";
?>

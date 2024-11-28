<!DOCTYPE html>
<html lang="en">
<!-- Define the document type and language as English -->
<head>
    <meta charset="UTF-8">
    <!-- Set character encoding to UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the viewport for responsive design -->
    <title>Document</title>
    <!-- Set the title of the web page -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <!-- Include Pico.css library for styling -->
</head>
<body>
</body>
</html>
<!-- Create the basic structure of an HTML document -->
<?php
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Initialize a cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Force HTTP/1.1 to avoid HTTP/2 issues
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

// Optional: Disable SSL verification (for testing only)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// Increase timeout to 30 seconds
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$response = curl_exec($ch);

// Check if the request failed
if ($response === false) {
    die('API request failed: ' . curl_error($ch));
}

curl_close($ch); // Close the cURL session

$data = json_decode($response, true); // Decode JSON response

// Continue with your table rendering...
echo "<h1>Student Table</h1>";
echo "<table border='1'>
<tr>
 <th>year</th>
 <th>semester</th>
 <th>College</th>
 <th>Program</th>
 <th>Nationality</th>
 <th>Number of Students</th>
</tr>";

if (isset($data['results'])) {
    foreach ($data['results'] as $record) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($record['year'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['semester'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['colleges'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['the_programs'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['nationality'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['number_of_students'] ?? 'N/A') . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No data found</td></tr>";
}
echo "</table>";
?>
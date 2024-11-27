<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
   
 
</head>
<body>
</body>
</html>
<?php
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Use cURL for more reliable API requests
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if ($response === false) {
    die('API request failed: ' . curl_error($ch));
}
curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);

// Start HTML table
echo "<h1>Table</h1>";
echo "<table border='1'>
<tr>
    <th>year</th>
    <th>College</th>
    <th>Program</th>
    <th>Nationality</th>
    <th>Number of Students</th>
</tr>";

// Print out the raw data to debug
// Uncomment the next line to see the actual structure
// print_r($data);

// Loop through records and create table rows
if (isset($data['results'])) {
    foreach ($data['results'] as $record) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($record['year'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['colleges'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['the_programs'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['nationality'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['number_of_students'] ?? 'N/A') . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}

echo "</table>";
?>
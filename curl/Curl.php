<?php
include_once "../views/index.php";
$servername = "localhost";
$username = "root";
$password = "1234567";
$dbName = "abc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uri = $_POST['url'];

$reTitle = '/<h1 class.*>(.*?)<\/h1>/m';
$reDate = '/<span class="date">(.*?)<\/span>/m';
$reContent = '/<p class="description">(.*)<\/article>/ms';

// Initialize CURL
$curl = curl_init($uri);
// Set return
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);
// Disconnect CURL, free
curl_close($curl);

function getData($re, $res) {
    preg_match_all($re, $res, $matches);
    return $matches[1];
}

$title = getData($reTitle, $result)[0];

$date = getData($reDate, $result)[0];

$content = getData($reContent, $result)[0];

$title = addslashes($title);

$article = addslashes($article);

$datetime = addslashes($datetime);

$sql = "INSERT INTO crawler (title, article, datetime) VALUES ('$title','$content','$date')";

if (empty($title) || empty($content) || empty($date)) {
    echo "no insert values empty";
} else if ($conn->query($sql)) {
    echo 'insert suc<br>';
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

function showData() {
    global $conn;
    $sql = "SELECT* FROM crawler";
    return $conn->query($sql);
}

$conn->close();

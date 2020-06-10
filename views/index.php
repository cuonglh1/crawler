<!DOCTYPE html>
<html>

<head>
    <title>Crawler</title>
</head>
<h1>Crawler</h1>

<body>
    <div class="containner">
        <form action="" method="POST">

            <label>Enter the address you want to crawl data</label>
            <input type="text" class="form-control" id="inputUrl" name="url" placeholder="Enter url"> </br>
            <button type="submit" name="submit">Submit</button>

        </form>

    </div>

    <?php
    $uri = $_POST['url'];
    echo $uri;
    $reTitle = '/<h1 class.*>(.*?)<\/h1>/m';
    $reDate = '/<span class="date">(.*?)<\/span>/m';

    // Initialize CURL
    $curl = curl_init($uri);
    // Set return
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);
    // Disconnect CURL, free
    curl_close($curl);

    // preg_match_all($reTitle,$result ,$matches);
    // var_dump($matches)

    preg_match_all($reDate, $result, $matches);

    var_dump($matches[1][0]);
    ?>
</body>

</html>
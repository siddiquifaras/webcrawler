<!DOCTYPE html>
<html>
<head>
    <title>Faras' Crawler</title>
</head>
<body>
    <h1>Web Crawler</h1>
    <?php
    //function to crawl a url and return anchor tag content
    function crawlPage($url) {
        $html = file_get_contents($url);  // Get the HTML content of the page
        $pattern = '/<a\s(?:[^>]?\s)?href=(["\'])(.?)\1/'; //match anchor tag and extract href
        if (preg_match_all($pattern, $html, $matches)) {
            $urls = $matches[2]; // Extract the URLs from the matched patterns
            return $urls; //will return url
        } else {
            return [];
        }
    }
    ?>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Faras' Crawler</title>
</head>
<body>
    <h1>Faras' Web Crawler</h1>
    <!--takes input url from user and crawls that-->
    <form id="crawlForm" method="POST">
        <label for="urlInput">Enter a vaid URL:</label>
        <input type="text" id="urlInput" name="url" required>
        <button type="submit">Begin Crawling</button>
    </form>
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

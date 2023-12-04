<!DOCTYPE html>
<html>
<head>
    <title>Faras' Crawler</title>
</head>
<body>
    <h1>Web Crawler</h1>
    <!--takes input url from user and crawls that-->
    <form id="crawlForm" method="POST">
        <label for="urlInput">Enter a URL:</label>
        <input type="text" id="urlInput" name="url" required>
        <label for="depthInput">Enter the Depth Limit:</label>
        <input type="number" id="depthInput" name="depth" min="1" required>
        <button type="submit">Crawl</button>
    </form>
    <div id="result"></div>
    <?php
    //requests url's and calls the crawlPage function and places
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $url = $_POST["url"];
        $depth = $_POST["depth"];
        $urls = crawlPage($url, $depth);
        $response = [
            "urls" => $urls
        ];
        
        displayResults($response["urls"]);
        exit;
    }
    //function to crawl a url and return anchor tag content
    function crawlPage($url, $depth) {
         if ($depth <= 0) {
            return false; //returning false if the depth limit is not a positive number
        }
        $html = file_get_contents($url); // Get the HTML content of the page
        $pattern = '/<a\s(?:[^>]?\s)?href=(["\'])(.*?)\1/'; // Regular expression pattern to match URLs
        if (preg_match_all($pattern, $html, $matches)) {
            $urls = $matches[2]; // Extract the URLs from the matched patterns
            if ($depth === 1) {
                return $urls; //return the URLs at the current depth level
            } else {
                $filteredUrls = [];
                foreach ($urls as $url) {
                    $subUrls = crawlPage($url, $depth - 1); //recursive crawl the URLs at the next depth level
                    if (!empty($subUrls)) {
                        $filteredUrls = array_merge($filteredUrls, $subUrls); // Merge the sub URLs into the main URL list
                    }
                }
                return array_unique($filteredUrls); // Use array_unique to remove duplicates from the URL list
            }
        } else {
            return [];
        }
    }
    //function to display all the urls appearing on a page
    function displayResults($urls) {
        echo "<h2>URLs found on the page:</h2>\n";
        foreach ($urls as $url) {
            echo "<a href=\"$url\">$url</a><br>\n";
        }
        echo "</body>\n";
        echo "</html>";
    }
    ?>
</body>
</html>

</body>
</html>

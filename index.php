<!DOCTYPE html>
<html>
<head>
    <title>Faras' Crawler</title>
</head>
<body>
    <h1>Web Crawler</h1>
    <!-- Takes input URL and depth limit from the user and crawls that -->
    <form id="crawlForm" method="POST">
        <label for="urlInput">Enter a URL:</label>
        <input type="text" id="urlInput" name="url" required>
        <br>
        <label for="depthInput">Enter the Depth Limit:</label>
        <input type="number" id="depthInput" name="depth" min="1" required>
        <button type="submit">Crawl</button>
    </form>
    <div id="result"></div>

    <?php
    // Requests URL and depth limit from the user and calls the crawlPage function
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $url = $_POST["url"];
        $depth = $_POST["depth"];
        $urls = crawlPage($url, $depth);

        if ($urls === false) {
            echo "An error occurred while crawling the page.";
            exit;
        }

        displayResults($urls);
        exit;
    }

    // Function to crawl a URL and return anchor tag content up to a specified depth level
    function crawlPage($url, $depth) {
        if ($depth <= 0) {
            return false; // Return false if the depth limit is not a positive number
        }

        $html = @file_get_contents($url); // Get the HTML content of the page and suppress errors
        if ($html === false) {
            return false; // Return false if there was an error fetching the page
        }

        $pattern = '/<a\s+(?:[^>]*?\s+)?href=([\'"])(.*?)\1/';
        if (preg_match_all($pattern, $html, $matches)) {
            $urls = $matches[2]; // Extract the URLs from the matched patterns
            if ($depth === 1) {
                return $urls; // Return the URLs at the current depth level
            } else {
                $filteredUrls = [];
                foreach ($urls as $url) {
                    $subUrls = crawlPage($url, $depth - 1); // recursive crawl the URLs at the next depth level
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

    // Function to display all the URLs appearing on a page
    function displayResults($urls) {
        echo "<h2>URLs found on the page:</h2>\n";
        if (!empty($urls)) {
            foreach ($urls as $url) {
                echo "<a href=\"$url\">$url</a><br>\n";
            }
        } else {
            echo "No URLs found.";
        }
    }
    ?>
</body>
</html>

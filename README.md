# Faras' Crawler

This is a simple web crawler implemented in PHP, allowing users to input a starting URL and a depth limit for crawling. The crawler fetches the HTML content of the specified page and recursively extracts anchor tags (`<a>`) up to the specified depth level.

## Usage

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/faras-crawler.git
    ```

2. Open the `index.php` file in your preferred PHP-enabled web server or use tools like XAMPP or MAMP.

3. Access the web crawler through your browser.

4. Enter a starting URL and set the depth limit using the provided form.

5. Click the "Crawl" button to initiate the crawling process. If the website is uncrawlable or any error occurs, you will get an error message.

## Libraries

No external libraries used. The code utilizes core PHP functionality.

## How It Works

1. The user provides a starting URL and a depth limit.
2. The PHP script fetches the HTML content of the page using `file_get_contents`.
3. Anchor tags are extracted from the HTML using a regular expression.
4. If the depth limit is greater than 1, the crawler recursively crawls the URLs found at the next depth level.
5. The unique set of URLs is displayed on the web page.

## Error Handling

The script handles errors gracefully, displaying appropriate messages in case of invalid URLs or other issues.

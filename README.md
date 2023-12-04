Faras' Crawler
This is a simple web crawler implemented in PHP, allowing users to input a starting URL and a depth limit for crawling. The crawler fetches the HTML content of the specified page and recursively extracts anchor tags ('<a>') up to the specified depth level.

Usage
Clone the repository:

bash
Copy code
git clone https://github.com/your-username/faras-crawler.git
Open the index.php file in your preferred PHP-enabled web server or use tools like XAMPP or MAMP.

Access the web crawler through your browser.

Enter a starting URL and set the depth limit using the provided form.

Click the "Crawl" button to initiate the crawling process.
If the website is uncrawlable or any error occurs, you will get an error message.



Libraries
No external libraries used. The code utilizes core PHP functionality.
How It Works
The user provides a starting URL and a depth limit.
The PHP script fetches the HTML content of the page using file_get_contents.
Anchor tags are extracted from the HTML using a regular expression.
If the depth limit is greater than 1, the crawler recursively crawls the URLs found at the next depth level.
The unique set of URLs is displayed on the web page.
Error Handling
The script handles errors gracefully, displaying appropriate messages in case of invalid URLs or other issues.

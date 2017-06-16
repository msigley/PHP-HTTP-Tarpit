PHP-HTTP-Tarpit
===============

Confuse and waste bot scanners time. 
Url rewrite unwanted bot traffic to the la_brea.php file. It is important you use Url rewrites not redirects as most bots ignore location headers.

Based on research done by Chris John Riley. http://github.com/ChrisJohnRiley/

Defense Techinques Implemented
------------------------------
* Blinding Mode
	* Return 200 Founds for all requests.
	* Outputs random alphanumeric content to client.
		* Special phrases and characters injected into the content.
	* Increases amount of false positives in scanners' results.
* Ninja Mode
	* Return 404 Not Founds for all requests.
	* Sometimes outputs random content as described above.
	* Increases amount of negatives in scanners' results.
* HTTP Tarpit
	* Returns a 101, 102, 103, or 401 for all requests.
	* Generates long response wait times to client.
	* Wastes time of scanners.
* Chained Redirection
	* Returns a 301, 302, or 307 for all requests.
	* Redirects to a randomly generated url many times in succession.
	* Wastes time of scanners.
	* Punishes bad web crawlers for not respecting the robots.txt. Looking at you Baidu.
	* Sometimes ends in Bounceback Redirection (see below).
* Bounceback Redirection
	* Returns a 301, 302, or 307 for all requests.
	* Redirects request back to requesting ip on common http/https ports.
	* Wastes time of scanners.
	* Could potentially tie up resources on attackers edge node.
* Random Defense Selection 
	* For each request
	* By the minute
		* By the minute is very effective in baiting the bots and by not looking too random or predictable.

Wishlist
--------
* ~~Robots.txt file emulation to not punish good web crawlers.~~
	* This is handled better by hosting an actual robots.txt and creating an exemption in the url rewrite to allow access to it.
* Support for dumping contents of random files in a folder for the Blinding Mode defense.
* Add file logging for
	* Comparing against the HTTP W3 Logs.
	* Checking for proxies via:
		* X-Forwarded-For headers.
		* Tor exit node DNSBL service.

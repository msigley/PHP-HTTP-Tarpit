PHP-HTTP-Tarpit
===============

Confuse and waste bot scanners time. 
Url rewrite unwanted bot traffic to the la_brea.php file. It is important you use Url rewrites not redirects as most bots ignore location headers.

Based on research done by Chris John Riley. http://github.com/ChrisJohnRiley/

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
* Add abuse reporting support
	* Using Abuse Contact DB: https://abusix.com/contactdb.html
	* X-arf format for emails: http://www.x-arf.org/ 

<h1>SharpEdge CMS</h1>
<p>SharpEdge is an open source content management system developed on the CodeIgniter Framework.
<br /><br />
Current Version 3.42.50<br />
<br />
PYRO_License - The installer is based off pyro's installer from about a year ago, some bbcode <br />
CODEIGNITER_License - for obvious reasons :D
<br /><br />
If someone thinks I missed something please let me know!
</p>

<h2>Donate</h2>
http://purdydesigns.com/en/Open-Source-Donation
<p>Donate to this project, help support development.</p>

<h2>Built With</h2>
- HMVC
- Widget Extensions (thanks to wiredesignz)
- CodeIgniter 2.2.2
- CodeIgniter (3.0 is currently in testing)

<h2>Modules</h2>
- Built on Ion Auth, with modifications
- Language Module
- Page System
- Widget System
- Module System
- Menu System - Legacy Support (DepreicateD)
- Navigation System (New)
- User Profiles
- Product System
- Download System
- Video System
- Paypal Support (including IPN)
- User/Roles and Permissions
- Custom User Fields
- Template Module to create layout variables
- Blog/News System
- Gallery System
- Slideshow System - Scheduled for Re-Development
- Contact Module
- Google Analytics
- Updater Module
- Log Module

<h2>Javascript framework/libraries</h2>
- ckeditor 4.4.7
- kcfinder 3.1.2
- jQuery 1.11.3
- jQuery Migrate 1.2.1
- jQuery UI 1.11.2
- jQuery.cookie 1.4
- jQuery Lazy Load 1.9.3
- modernizr 2.8.2
- Twitter Bootstrap 3.2.0
- lytebox 5.5

<h2>Included Widgets</h2>
- Blog/News Widget
- News Widget With Images (Articles with attached article image)
- News Photo Slideshow (Slideshow will be replaced soon with a responsive slideshow)
- Login Widget
- AddThis Widget
- Facebook Widget
- Twitter Widget
- Shopping Cart Widget (This uses the native CI Shopping cart, with changes to make it use ajax requests)
- Related Articles

<h2>Note Worthy Features</h2>
- 4 Widget Locations (Customize those locations in your (theme/template)
- Each widget location can have any number of widgets in them (Widget Groups)
- 4 Levels of Menu Navigation
- 3 Resource URLS for cookieless domains
- Attach-able Galleries to News Articles
- Attach-able Galleries to Products
- Custom Layouts (Designs Per Page, and per module)
- Widgets can be code based on HTML based)
- Software Updater - At a click of a button SharpEdge can update itself!
- StopForumSpam for user signups. (Registrations are checked against the StopForumSpam Database)
- Shortcodes (Currently Supporting Gallery and Google Maps)

<h2>Shortcodes</h2>
- [ai:gallery id=225] - This displays an entire gallery. All you need is the ID Number of the CATEGORY you want to display.
- [ai:single id=50|size=normal|full_size=false|align=left] - This displays a single image
- [ai:maps lat=52.373056|lon=4.892222] - Displays a google map using lat and lon
- [ai:articles tag=Category|exclude=Category|limit=999|title=Articles]
- [ai:grid size=4|class=class|classp=class2]
- [ai:endgrid]
- [ai:page_parallax id=page_id|close_main=Y|offset=100]
- [ai:nav id=menu_id|theme=navbar-default|pos=navbar-fixed-top|type=bar,pills,tabs]
<p>More will be added in coming versions</p>


<h2>Requirements</h2>
- PHP 5.3 Or Greater (Tested on 5.4, 5.5 and 5.6)
- PHP Must run as the domain user or you may have problems with file uploads and permissions (Such as suphp, fastcgi, etc)
- MYSQL 5 or greater, or MariaDB
- GD Library 2
- cURL Enabled (Used for the automatic updater)
- Apache Compiled with mod_expires,mod_headers,mod_rewrite and mod_deflate (highly suggested)

<h2>Inspirations</h2>
<p>Pyro CMS's Admin UI is nice and clean in someways the SharpEdge UI is inspired by this layout. :)</p>


<h2>How do I install it?</h2>
- Simply download the package from the : https://purdydesigns.com/billing/downloads/SharpEdgeV3_42_00.zip
- 1a Or you can download from the repo at github! 
- Unzip the archive somewhere onto your computer
- Upload all the files include in the package to your websites html folder (public_html, httpdocs)
- 3a Suggested (change the encryption key included in the /sharpedge/config/config.php file)
- Create a new database using your control panel on your hosting.
- run the installer script included in the package by going to yourwebsite.com/install
- Follow the onscreen instructions. (You'll be asked to create your admin login during this process)
- Delete the /install folder from the server 
- that's it, you should be able to login and start using SharpEdge

<h2>Problems?</h2>
- If your getting an internal 500 error when running the application. 
- Open the .htaccess file and remove the deflate and expire headers code from this file.

Any other problems send me an email or report the issue on github. :)

<h2>My Suggestions.</h2>
<p>- To make your own theme folders and build your design in those folders. The Updater will make changes to the default_bootstrap theme when files get updated but your custom themes will go untouched. This will allow you to apply those updates to your themes yourself.</p>

<h2>Feedback?</h2>
<p>Love to hear it! :)</p>
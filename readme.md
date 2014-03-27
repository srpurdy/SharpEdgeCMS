<h1>SharpEdge CMS</h1>
<p>Version 3.36.50 is the first community launch of SharpEdge CMS. It has been, being used on my own and client websites for sometime now, and I've finally decided to launch it as open source under the MIT License. I've also included various license files in the package
<br /><br />
Current Version 3.39.12<br />
<br />
PYRO_License - The installer is based off pyro's installer from about a year ago, some bbcode <br />
CODEIGNITER_License - for obvious reasons :D
<br /><br />
If someone thinks I missed something please let me know!
</p>

<h2>Donate</h2>
http://www.purdydesigns.com/en/Donate-Sharpedge
<p>Donate to this project, help support development.</p>

<h2>Built With</h2>
- HMVC
- Widget Extensions (thanks to wiredesignz)
- CodeIgniter 2.1.4
- CodeIgniter (3.0dev is currently in testing)

<h2>Modules</h2>
- Built on Ion Auth, with modifications
- Language Module
- Page System
- Widget System
- Module System (fairly basic right now)
- Menu System
- User Profiles (will be expanded with currently under development forum module)
- Product System (still in the early stages plan to include much more options)
- Download System (very early going here, will plug into the product system)
- Paypal Support (including IPN)
- User/Roles and Permissions
- Basic Template Module to create layout variables
- Blog/News System
- Photo Gallery System (most note-able feature is the import by zip file)
  -> This also auto generates all thumbnails from the zip (can be memory extensive on large images)
- Slideshow System (Really old and is in the planning stages of re-development)
- Contact Module (Allows multiple contacts and custom fields)
- Google Analytics
- Assets Module (Will likely be depreicated, it's only a simply file uploader)
- Updater Module (this allows the CMS to update itself remotely)
- Log Module (This currently only has a Spam Log)

<h2>Javascript framework/libraries</h2>
- ckeditor 4.3.3
- kcfinder 2.5.1
- jQuery 1.11.0
- jQuery Migrate 1.1.1
- jQuery UI 1.10.4
- jQuery.cookie 1.4
- jQuery Laxy Load 1.9.3
- modernizr 2.7.1
- Twitter Bootstrap 3.0.1
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
- 3 Levels of Menu Navigation
- 3 Resource URLS for cookieless domains
- Attach-able Galleries to News Articles
- Attach-able Galleries to Products
- Custom Layouts (Designs Per Page, and per module)
- Widgets can be code based on HTML based)
- Software Updater - At a click of a button SharpEdge can update itself!
- StopForumSpam for user signups. (Registrations are checked against the StopForumSpam Database)
- Mobile Support (More than just responsive design there is also a mobile template you can use)
- Shortcodes (Currently Supporting Gallery and Google Maps)

<h2>Shortcodes</h2>
- [ai:gallery id=225] - This displays an entire gallery. All you need is the ID Number of the CATEGORY you want to display.
- [ai:single id=50|size=normal|full_size=false|align=left] - This displays a single image
- [ai:maps lat=52.373056|lon=4.892222] - Displays a google map using lat and lon
<p>More will be added in coming versions</p>


<h2>Requirements</h2>
- PHP 5.3 Or Higher (has also been tested on PHP 5.4) (has not been tested on PHP 5.2 or lower)
- PHP Must run as the domain user or you may have problems with file uploads and permissions
-- we don't use any insecure folder permissions. Files are always written as 644 and folders 755)
-- We suggest in shared environments to make the database.php file is set to 600 (to prevent apache symlink attacks)
- MYSQL 5 or greater
- GD Library 2
- cURL Enabled (Used for the automatic updater)
- Apache Compiled with mod_expires,mod_headers,mod_rewrite and mod_deflate (highly suggested)

<h2>Inspirations</h2>
<p>Pyro CMS's Admin UI is nice and clean in someways the SharpEdge UI is inspired by this layout. :)</p>


<h2>How do I install it?</h2>
- Simply download the package from the : https://purdydesigns.com/billing/downloads/SharpEdgeV3_38_00.zip
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
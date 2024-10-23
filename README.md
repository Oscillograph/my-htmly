<a href="https://www.htmly.com" target="_blank">![Logo](https://raw.githubusercontent.com/Oscillograph/my-htmly/master/system/resources/images/logo-big.png)</a>

myHTMLy is a fork of HTMLy -  an open source databaseless blogging platform that prioritizes simplicity and speed written in PHP. 

myHTMLy aims to enhance HTMLy customization features by altering some logic and adding new systems to provide advanced functionality. Also, it is intended to be used as a single-user CMS.

myHTMLy, in addition to what HTMLy offers, provides the following:

1. Disabling authorization via "login.lock" file in the root directory. Authorization is disabled automatically after logging out, and to turn it on, the website administrator has to rename the "login.lock" file to "_login.lock".
2. Plugin system.
3. Error 403 handling (via Plugin system).
4. Dummy plugin to provide an example of how the Plugin system works.
5. Website maintenance mode plugin.
6. BB-tags support via special plugin. Included tags:
* [box=...] .. [/box], [boxl=...] .. [/boxl], [boxr=...] .. [/boxr], [boxc=...] .. [/boxc] - to form a box-like widgets on a page with headers and contents.
* [img=...] .. [/img] - to show a clickable image with a link and description.
* [url=...] .. [/url] - traditional hyperlink tag.
* [quote=...] .. [/quote] - traditional quote tag with an author.
* [code] ... [/code] - traditional code tag.
* [more=...] .. [/more] - traditional spoiler tag with a header.
* -- automatically transform into a long dash.
7. Maths formulae support via KaTeX plugin.
8. A brand new theme called Solid.
9. Configuration page now allows to set up website keywords.
10. Social networks include VKontakte and Telegram.
11. New blog posts can be exported now to PhpBB forum and Telegram channel.
12. myHTMLy namespace envelopes most of the code so that external libraries are easier to integrate.
13. Most of Markdown usage was removed.
14. Some vendor libraries were removed.
15. HTML special chars are saved as their HTML equivalents to prevent admin panel markup from breaking.
16. Implemented a simple File manager plugin to allow files and directories management from the admin panel.
17. Implemented Yandex Metrika plugin to support usage of Yandex counters and metrics.
18. Most languages were removed save from ru_RU and en_US.
- 

Requirements
------------
myHTMLy requires PHP 8.1 or greater (however, it might happen to work on versions lower), PHP-XML package, PHP-INTL package, and PHP-ZIP package for backup feature.

Installations
-------------

Install myHTMLy using the source code:

 1. Download the latest version from the [Github repo](https://github.com/Oscillograph/my-htmly/releases/latest)
 2. Upload and extract the zip file to your web server. You can upload it in the root directory, or in subdirectory such as `htmly`.
 3. Visit your domain. If you extract it in root directory visit `https://www.example.com/install.php` and if in subdirectory visit `https://www.example.com/htmly/install.php`.
 4. Follow the installer to install myHTMLy.
 5. The installer will try to delete itself. Please delete the installer manually if the `install.php` still exist. 
 
**Note:** To disable log in feature, create an empty file "login.lock" in the root directory. Rename it to "_login.lock" if you want to have login feature enabled again.

Configurations
--------------
Set written permission for the `cache` and `content` directories.

Users assigned with the admin role can edit/delete all users posts.

To access the admin panel, add `/login` to the end of your site's URL.
e.g. `www.yoursite.com/login`


As myHTMLy is a fork of an original HTMLy CMS, it is useful to look into [HTMLy repo](https://github.com/danpros/htmly/) for more information about content structure, basic usage, advanced configuration, etc.


Contribute
----------
1. Fork and edit
2. Submit pull request for consideration

Contributors
----------
- [HTMLy Contributors](https://github.com/danpros/htmly/graphs/contributors)

Copyright / License
-------------------
For copyright notice please read [COPYRIGHT.txt](https://github.com/Oscillograph/my-htmly/blob/master/COPYRIGHT.txt). myHTMLy, as HTMLy was, is licensed under the GNU General Public License Version 2.0 (or later).

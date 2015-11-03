Latest Post With Image (Joomla Module)
========
By: Maureen Davey
URL: http://www.maureenldavey.com
GitHub: https://github.com/mldavey

This is a module to automatically pull your latest article (except for 'skipped' categories, which you can designate by ID in the module settings) that has an <img> tag, and display the article title, image, and the introtext (text before the "Read More").  You can also add classes to the title, image, or text through the module settings, and you can designate text to link to the full article (such as "Read More" or "Click here to continue").  Please take/reuse/customize to meet your needs.

This module has been installed/tested on Joomla 3.4 only.  Please use at your own risk for other versions.

To Do:
====
* Expand options to enable/disable the title and introtext
* Allow a designated 'fallback' image if there is no image in the latest article
* Currently checks that the article's category is published but still needs to check if parent categories are published
* Expand the single post/image into the option of using a rotator or slider that allows you flip through the last few posts

File Structure:
====
* Joomla-Module-Latest-Post-With-Image
	* readme.md
	* mod_latestpostwimage
		* helper.php
		* index.html
		* mod_latestpostwimage.php
		* mod_latestpostwimage.xml
		* tmpl
			* default.php
			* index.html
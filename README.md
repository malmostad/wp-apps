Intranet Wordpress Themes
=============
Wordpress theme for the following intranet publishing services at Malmö stad:
* Blog
* News
* HR, help texts to the HR system.

The themes are using Malmö stads’s intranet global assets, see the repo `intranet-assets`.

For more information about the services, contact kominteamet@malmo.se.

## Dependencies
* Wordpress >= 3.5
* Wordpress compatible database
* The themes `komin-nyheter` and `komin-blogg` are child themes to `komin-master`.
* APC
* LDAP server for authentication
* SSL certificate
* Dynamic linking to Malmö stad’s assets.
* Sass for development and build
* Wordpress plugins used:
  * auto-hyperlink-urls
  * content-scheduler
  * valideratext
  * wpdirauth

## Setup
* Perform a regular Wordpress installation.
* Install and activate one of the themes.
* Install the plugins listed above.
* Copy and edit the following files from this code base (do __not__ check in config files in the repository):
  * `wp-config-example.php` to `wp-config.php`
  * `.htaccess-example` to `.htaccess`
* Edit `themes/<theme_name>/functions/theme-config.php`

## Licence
TBD

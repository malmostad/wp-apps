# Wordpress Themes and Plugins

Wordpress applications for the following publishing services at Malmö stad:
* Intranet Blog
* External Blog
* Intranet News
* HR, help texts to the HR system.

The themes are using Malmö stads’s global assets, see the repo see the repo [intranet-assets](https://github.com/malmostad/intranet-assets).

For more information about the services, contact kominteamet@malmo.se.

## Dependencies
* Wordpress >= 3.8
* Wordpress compatible database
* LDAP server or a SAML IdP for authentication
* [Assets service](https://github.com/malmostad/intranet-assets).
* [Avatar service](https://github.com/malmostad/intranet-dashboard/wiki/Avatar-Service-API-v1).
* Sass for development and build. See `wp-content/themes/komin-master/stylesheets/application.scss` for info.
* Wordpress plugins used:
  * auto-hyperlink-urls
  * content-scheduler
  * valideratext
  * wpdirauth
  * Force Login (included in source)
  * Force SSL In Content (included in source)
  * SAML 2.0 (included in source)

## Setup
* Copy and edit the following files from this code base (do __not__ check in config files in the repository):
  * `wp-config-example.php` to `wp-config.php`
  * `.htaccess-example` to `.htaccess`
* Perform a regular Wordpress installation.
* Install and activate one of the themes.
* Install the plugins listed above.
* Edit `themes/<theme_name>/functions/theme-config.php`

## Licence
Released under AGPL version 3.

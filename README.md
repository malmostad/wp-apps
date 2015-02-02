# Wordpress Themes and Plugins

Wordpress applications for the following publishing services at Malmö stad:
* Intranet Blog
* External Blog
* Intranet News

The themes are using Malmö stads’s global assets, see the repo see the repo [global-assets](https://github.com/malmostad/global-assets).

For more information about the services, contact webbteamet@malmo.se.

## Dependencies
* Wordpress >= 4.1
* Wordpress compatible database
* LDAP server for authentication
* [Assets service](https://github.com/malmostad/global-assets).
* [Avatar service](https://github.com/malmostad/intranet-dashboard/wiki/Avatar-Service-API-v1).
* Sass for development and build.
* Wordpress plugins used:
  * auto-hyperlink-urls
  * content-scheduler
  * valideratext
  * wpdirauth
  * Force Login for Reading (included in source)
  * Force SSL In Content (included in source)
  * Portwise Authentication (included in source)

## Setup
* Copy and edit the following files from this code base (do __not__ check in config files in the repository):
  * `wp-config-example.php` to `wp-config.php`
  * `.htaccess-example` to `.htaccess`
* Perform a regular Wordpress installation.
* Install and activate one of the themes.
* Install the plugins listed above.
* Edit `themes/<theme_name>/functions/theme-config.php`

Use Sass to generate CSS for the child theme. This will include both the master and the child theme Sass files (if any).

During development:

    $ cd wp-content/themes
    $ sass --watch --style expanded <child-theme>stylesheets/application.scss

Build for deploy:

    $ cd wp-content/themes
    $ sass --style compressed  <child-theme>stylesheets/application.scss > <child-theme>stylesheets/application.css

## Licence
Released under AGPL version 3.

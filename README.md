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
* Sass.
* Capistrano 2.x for build and deployment.
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

Use Sass to generate CSS for the child theme during development. This will include both the master and the child themes Sass files.

    $ cd wp-content/themes
    $ sass --watch --style expanded <child-theme-directory>stylesheets/application.scss

## Build & Deployment
Capistrano 2 is used for build and deployment of the themes. Deployed themes are symlinked on the server. Sass files are compiled during the build process. The Wordpress application and plugins are deployed manually.

The stages defined in the Capistrano build files are found in `config/deployment`. Stages are defined to contain both the application name, i.e. `internal-news`, `internal-blog` or `external-blog` as well as the actual stage name, i.e. `staging` or `production`. The application name and the stage is separated by a dash. To build and deploy the internal news themes for the production environment, run:

    $ bundle exec cap internal-news-production deploy

## Licence
Released under AGPL version 3.

# Wordpress Themes and Plugins

Wordpress themes and plugins for the following publishing services at Malmö stad:
* External Blog
* Intranet Blog
* Intranet News

## Dependencies
* Wordpress >= 4.1
* Wordpress compatible database
* LDAP server for authentication
* Nexus Hybrid Access Gateway for SSO authentication
* [Global Assets](https://github.com/malmostad/global-assets).
* [Avatar service](https://github.com/malmostad/intranet-dashboard/wiki/Avatar-Service-API-v1).


## Editing Sass files

Each child themes `stylesheets` directory contains theme specific Sass files and are using Sass files from the `master` theme. Sass will listen for changes to files when you edit them with this command:

    $ cd themes
    $ sass --watch --style expanded <child-theme-directory-name>/stylesheets/application.scss

## Build & Deployment

Capistrano 2 is for build and deployment. It uses your *local copy* of this repo, it *does not* check out from the repo.

The `app_runner` user must be used for all deployment tasks (see Server Provisioning above).

Each theme, `internal_news`, `internal_blog` and `external_blog`, is a child theme of the `master` theme. Two stages for each are defined in `config/deployment`: `staging` (test server) and `production`.

The build and deployment process:

* Compiles asset files from the master and child themes
* Deploys both the master and child theme to the server
* Installs custom plugins to the server as defined as `:custom_plugins` in `config/deploy.rb`
* Installs third-party plugins to the server as defined as `:remote_plugins` in `config/deploy.rb`

The deployment command defines the stage as the theme name and it's stage separated by underscore. Example: to build and deploy the internal news themes to the production server, run the following command in the projects root:

    $ bundle exec cap internal_news_production deploy

Rollback to the previous version:

    $ bundle exec cap internal_news_production deploy

Both themes and plugins are rolled back.

## Update Wordpress core

To update Wordpress core to the version specified in `config/deploy.rb` with `:wordpress_url` (defaults to latest):

    $ bundle exec cap internal_news_production update_wordpress

###

## Licence
Released under AGPL version 3.

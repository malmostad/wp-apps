SAML 2.0 Single Sign-On
=======================

SAML 2.0 Single Sign-On allows you to use a SAML 2.0-compliant Identity Provider for Single Sign-On to your blog. This plugin is a fork of the plugin found at http://wordpress.org/plugins/saml-20-single-sign-on.

Changes made from the original plugin:
* Doesn't use wordpress password once authenticated by IDP.
* Idp group role permissions not used for new users, user role always set to wordpress author
* wp-blog-header.php include adapted to Malmö Stad server settings

## Dependencies
* Wordpress >= 3.3
* Wordpress compatible database
* Identity provider (IP) for authentication

## Setup
* Place plugin code in the `/wp-content/plugins/' directory
* Activate the plugin through the 'Plugins' menu in WordPress
* Configure the "Identity Provider" and "Service Provider" sections of the plugin in the Settings > Single Sign-On menu.
* Enable the plugin to do authentication on the "General" section of the plugin.


## Licence
Released under GPLv2 or later.
License URI: http://www.gnu.org/licenses/gpl-2.0.html
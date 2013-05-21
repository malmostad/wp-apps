== SAML 2.0 Single Sign-On - Fork ==

This plugin is a fork of the plugin described in section 'SAML 2.0 Single Sign-On' below.

Fork contributors: Mattias Andersson
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Changes made from the original plugin:
- Doesn't use wordpress password once authenticated by IDP.
- Idp group role permissions not used for new users, user role always set to wordpress author
- wp-blog-header.php include adapted to Malmö Stad server settings

=== SAML 2.0 Single Sign-On ===
Contributors: ktbartholomew
Tags: sso, saml, single sign-on, simplesamlphp, onelogin, ssocircle
Requires at least: 3.3
Tested up to: 3.5.1
Stable tag: 0.8.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

SAML 2.0 Single Sign-On allows you to use a SAML 2.0-compliant Identity Provider for Single Sign-On to your blog.

== Description ==

SAML 2.0 Single Sign-On allows you to use any SAML 2.0-compliant Identity Provider for Single Sign-On to your blog or network of blogs.  The plugin will replace the standard WordPress login screen and can automatically redirect login/logout requests to your SSO portal. Group membership from the Identity Provider (such as Active Directory) can be used to determine what privileges the user will have on your blog, such as Administrator, Editor, or Subscriber. This plugin uses a modified version of the SimpleSAMLPHP library for all SAML assertions, and can be configured exclusively from the WordPress Admin menu.

== Installation ==

1. Upload `samlauth.zip` to the `/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the "Identity Provider" and "Service Provider" sections of the plugin in the Settings > Single Sign-On menu.
4. Enable the plugin to do authentication on the "General" section of the plugin.

== Frequently asked questions ==

= What does this plugin do with my passwords? =

Because of the way SAML SSO systems work, this plugin is never aware of your password. When activated, you will always enter your password into your company's SSO portal website, which will then pass an authentication token--not a real password--to the WordPress site.

= Do I really need an SSL certificate to use this plugin? =

You may have noticed the fields that ask you to upload an SSL certificate and private key. This is only necessary if you want users to initiate their login from your website, that is, by visiting the `/wp-admin` URL on your site. Logins that originate from the SSO portal will work fine without this certificate. Because exchanging the certificate with your Identity Provider is part of the initial setup process, it is not necessary to have a publicly-signed (paid for) certificate. You can generate a self-signed certificate for free and use that.

= Can I have some users use single sign-on and others use the standard WordPress login method? =

This is not currently possible. You should make sure that all necessary administrators have SSO-ready user accounts before enabling the plugin.
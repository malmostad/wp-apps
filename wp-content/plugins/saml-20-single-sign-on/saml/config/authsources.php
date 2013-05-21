<?php

$wp_opt = get_option('saml_authentication_options');
$blog_id = (string)get_current_blog_id();


$config = array(

	// This is a authentication source which handles admin authentication.
	'admin' => array(
		// The default is to use core:AdminPassword, but it can be replaced with
		// any authentication source.

		'core:AdminPassword',
	),


	// An authentication source which can authenticate against both SAML 2.0
	// and Shibboleth 1.3 IdPs.
	
	$blog_id => array(
		'saml:SP',
		'NameIDPolicy' => $wp_opt['nameidpolicy'],
		// The entity ID of this SP.
		// Can be NULL/unset, in which case an entity ID is generated based on the metadata URL.
		'entityID' => NULL,
		'certificate' => constant('SAMLAUTH_ROOT') . '/etc/certs/' . $blog_id . '/' . $blog_id . '.cer',
		'privatekey' => constant('SAMLAUTH_ROOT') . '/etc/certs/' . $blog_id . '/' . $blog_id . '.key',
		'sign.authnrequest' => TRUE,
		'sign.logout' => TRUE,
		'redirect.sign' => TRUE,
		// The entity ID of the IdP this should SP should contact.
		// Can be NULL/unset, in which case the user will be shown a list of available IdPs.
		'idp' => $wp_opt['idp']
	)
);

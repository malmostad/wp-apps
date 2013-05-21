<?php
  // Setup Default Options Array
  global $saml_opts;
  
  if (isset($_POST['submit']) ) 
  {    
    
	  if( ( isset($_FILES['certificate']) && isset($_FILES['privatekey']) ) && ( $_FILES['certificate']['error'] == 0 && $_FILES['privatekey']['error'] == 0 ) )
		{
			$cert = file_get_contents($_FILES['certificate']['tmp_name']);
			$key = file_get_contents($_FILES['privatekey']['tmp_name']);
			if(openssl_x509_check_private_key($cert,$key))
			{
				$upload_dir = constant('SAMLAUTH_ROOT') . '/etc/certs/' . get_current_blog_id();
				if(! is_dir($upload_dir))
				{
					mkdir($upload_dir, 0775);
				}
				$cert_uploaded = ( file_put_contents($upload_dir . '/' . get_current_blog_id() . '.cer', $cert) ) ? true : false ;
				$key_uploaded = ( file_put_contents($upload_dir . '/' . get_current_blog_id() . '.key', $key) ) ? true : false ;
			}
			else
			{
				echo '<div class="error below-h2"><p>The certificate and private key you provided do not correspond to one another. They were not uploaded.</p></div>'."\n";
			}
		}
		if(get_option('saml_authentication_options'))
  		$saml_opts = get_option('saml_authentication_options');

		// Options Array Update
			$saml_opts['idp'] = $_POST['idp'];
			$saml_opts['nameidpolicy'] = $_POST['nameidpolicy'];
      $saml_opts['username_attribute'] = $_POST['username_attribute'];
      $saml_opts['firstname_attribute'] = $_POST['firstname_attribute'];
      $saml_opts['lastname_attribute'] = $_POST['lastname_attribute'];
      $saml_opts['email_attribute'] = $_POST['email_attribute'];
      $saml_opts['groups_attribute'] = $_POST['groups_attribute'];
      $saml_opts['admin_group'] = $_POST['admin_group'];
      $saml_opts['editor_group'] = $_POST['editor_group'];
      $saml_opts['author_group'] = $_POST['author_group'];
      $saml_opts['contributor_group'] = $_POST['contributor_group'];
      $saml_opts['subscriber_group'] = $_POST['subscriber_group'];
      $saml_opts['allow_unlisted_users'] = ($_POST['allow_unlisted_users'] == 'allow') ? true : false;

     update_option('saml_authentication_options', $saml_opts);
  }
  
  // Get Options
  if(get_option('saml_authentication_options'))
		$saml_opts = get_option('saml_authentication_options');

?>
<div class="wrap">
<?php
	$idp = parse_ini_file( constant('SAMLAUTH_ROOT') . '/etc/config/saml20-idp-remote.ini',true);
	if($idp === FALSE)
	{
		echo '<div class="error below-h2"><p>No Identity Providers have been configured. You will not be able to configure SAML for Single Sign-On until this is set up.</p></div>'."\n";
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?page=' . basename(__FILE__); ?>&updated=true" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="4194304" /> 
<fieldset class="options">


<h3>Authentication</h3>
<table class="form-table">
  <tr valign="top">
    <th scope="row"><label for="idp">Identity Provider</label></th> 
    <td>
    <select name="idp" id="idp">
      <?php foreach($idp as $key => $array) {
			$selected = ($key == $saml_opts['idp']) ? ' selected="selected"' : '';
    	echo '<option value="' . $key . '"' . $selected . '>' . $array['name'] . '</option>'."\n";
      } ?>
    </select>
    </td>
  </tr>
  <tr valign="top">
    <th scope="row"><label for="nameidpolicy">NameID Policy: </label></th> 
    <td>
    	<select name="nameidpolicy">
      <?php
				$policies = array(
				  'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
					'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',
					'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent'
				);
				foreach($policies as $policy)
				{
					$selected = ( $saml_opts['nameidpolicy'] == $policy ) ? ' selected="selected"' : '';
					echo '<option value="' . $policy . '"' . $selected . '>' . $policy . '</option>'."\n";
				}
			?>
      </select><br/>
      <span class="setting-description">Your site will require a NameID in this format, and fail otherwise. Default: emailAddress</span>
    </td>
  </tr>
  <tr valign="top">
    <th scope="row"><label for="certificate">Signing Certificate</label></th> 
    <?php
			$certificate = file_get_contents( constant('SAMLAUTH_ROOT') . '/etc/certs/' . get_current_blog_id() . '/' . get_current_blog_id() . '.cer' );
			$certificate_cn = openssl_x509_parse($certificate);
			$certificate_cn = $certificate_cn['subject']['CN'];
			$privatekey = file_get_contents( constant('SAMLAUTH_ROOT') . '/etc/certs/' . get_current_blog_id() . '/' . get_current_blog_id() . '.key' );
			$privatekey_match = openssl_x509_check_private_key($certificate,$privatekey);
		?>
    <td><input type="file" name="certificate" id="certificate" /><?php if($certificate !== false ) {echo '&nbsp;<span class="green">Using certificate for: <strong>' . $certificate_cn . '</strong>.</span>';}?>
    <br/>
    <span class="setting-description">This doesn't have to be the certificate used to secure your website, it can just be self-signed.</span> 
    </td>
  </tr>
   <tr valign="top">
    <th scope="row"><label for="privatekey">Signing Private Key</label></th> 
    <td><input type="file" name="privatekey" id="privatekey" /><?php if($privatekey_match){echo '&nbsp;<span class="green">Your private key matches the certificate.</span>';}?>
    <br/>
    <span class="setting-description">The key is used to sign login requests. This is created when you create your certificate.</span> 
    </td>
  </tr> 
</table> 
<h3>Authorization</h3>
<table class="form-table">
  <tr valign="top">
    <th scope="row"><label for="username_attribute">Attribute to be used as username</label></th> 
    <td><input type="text" name="username_attribute" id="username_attribute_inp" value="<?php echo $saml_opts['username_attribute']; ?>" size="40" /><br/>
    <span class="setting-description">Default is "http://schemas.microsoft.com/ws/2008/06/identity/claims/windowsaccountname".</span> 
    </td>
  </tr>

    <tr valign="top">
    <th scope="row"><label for="firstname_attribute">Attribute to be used as First Name</label></th> 
    <td><input type="text" name="firstname_attribute" id="firstname_attribute_inp" value="<?php echo $saml_opts['firstname_attribute']; ?>" size="40" /><br/>
    <span class="setting-description">Default is "http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname".</span> 
    </td>
  </tr>

    <tr valign="top">
    <th scope="row"><label for="lastname_attribute">Attribute to be used as Last Name</label></th> 
    <td><input type="text" name="lastname_attribute" id="lastname_attribute_inp" value="<?php echo $saml_opts['lastname_attribute']; ?>" size="40" /><br/>
    <span class="setting-description">Default is "http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname".</span> 
    </td>
  </tr>

    <tr valign="top">
    <th scope="row"><label for="email_attribute">Attribute to be used as E-mail</label></th> 
    <td><input type="text" name="email_attribute" id="email_attribute_inp" value="<?php echo $saml_opts['email_attribute']; ?>" size="40" /><br/>
    <span class="setting-description">Default is "http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress".</span> 
    </td>
  </tr>
  <tr valign="top">
    <th scope="row"><label for="groups_attribute">Attribute to be used as Groups</label></th> 
    <td><input type="text" name="groups_attribute" id="groups_attribute_inp" value="<?php echo $saml_opts['groups_attribute']; ?>" size="40" /><br/>
    <span class="setting-description">Default is "http://schemas.xmlsoap.org/claims/Group".</span> 
    </td>
  </tr>
  </table>
  <h3>Permissions</h3>
  <p>You don't have to fill in all of these, but you should have at least one. Users will get their WordPress permissions based on the highest-ranking group they are members of.</p>
  <table class="form-table">
  <tr>
    <th><label for="admin_entitlement">Administrators Group Name</label></th>
    <td><input type="text" name="admin_group" id="admin_group" value="<?php echo $saml_opts['admin_group']; ?>" size="40" /><br/>
    <span class="setting-description">Users in this group will be assigned the role of &ldquo;Administrator&rdquo;</span>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="editor_group">Editors Group Name</label></th>
    <td><input type="text" name="editor_group" id="editor_group" value="<?php echo $saml_opts['editor_group']; ?>" size="40" /><br/>
    <span class="setting-description">Users in this group will be assigned the role of &ldquo;Editor&rdquo;</span>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="editor_group">Authors Group Name</label></th>
    <td><input type="text" name="author_group" id="author_group" value="<?php echo $saml_opts['author_group']; ?>" size="40" /><br/>
    <span class="setting-description">Users in this group will be assigned the role of &ldquo;Author&rdquo;</span>
    </td>
  </tr>
  <tr>
    <th><label for="editor_group">Contributors Group Name</label></th>
    <td><input type="text" name="contributor_group" id="contributor_group" value="<?php echo $saml_opts['contributor_group']; ?>" size="40" /><br/>
    <span class="setting-description">Users in this group will be assigned the role of &ldquo;Contributor&rdquo;</span>
    </td>
  </tr>
  <tr>
    <th><label for="editor_group">Subscribers Group Name</label></th>
    <td><input type="text" name="subscriber_group" id="subscriber_group" value="<?php echo $saml_opts['subscriber_group']; ?>" size="40" /><br/>
    <span class="setting-description">Users in this group will be assigned the role of &ldquo;Subscriber&rdquo;</span>
    </td>
  </tr>
  <tr>
    <th><label for="allow_unlisted_users">Allow Unlisted Users</label></th>
    <td><input type="checkbox" name="allow_unlisted_users" id="allow_unlisted_users" value="allow" <?php echo ($saml_opts['allow_unlisted_users']) ? 'checked="checked"' : ''; ?> /><br/>
    <span class="setting-description">Users in this group will be assigned the role of &ldquo;Subscriber&rdquo;</span>
    </td>
  </tr>
</table>
</fieldset>
<div class="submit">
  <input type="submit" name="submit" class="button button-primary" value="Update Options" />
</div>
</form>
</div>

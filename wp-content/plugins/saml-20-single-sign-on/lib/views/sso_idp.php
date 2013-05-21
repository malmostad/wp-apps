<?php
	/*  IdP Options
	 *
	 *  This function reads the IdP configuration file used by SimpleSAMLPHP and parses the configured IdPs.
	 *  It then presents the user with an interface to modify the IdP details.
	 *
	 */
	 
	 if (isset($_POST['submit']) ) 
  {
		$contents =  '[' . $_POST['idp_identifier'] . ']'."\n";
		$contents .= '  name = "' . $_POST['idp_name'] . '"'."\n";
		$contents .= '  SingleSignOnService = "' . $_POST['idp_signon'] . '"'."\n";
		$contents .= '  SingleLogoutService = "' . $_POST['idp_logout'] . '"'."\n";
		$contents .= '  certFingerprint = "' . str_replace(':','',$_POST['idp_fingerprint']) . '"'."\n";

		$save_status = file_put_contents( constant('SAMLAUTH_ROOT') . '/etc/config/saml20-idp-remote.ini', $contents ); 
	}
	
	  $metadata = array(); // the variable used in the idp file.
	  require( constant('SAMLAUTH_ROOT') . '/saml/metadata/saml20-idp-remote.php' );
	?>
<div class="wrap">
	<h2>SAML Identity Provider Settings</h2>
  <?php 
	  // Check some config setttings.
		$etc_dir = constant('SAMLAUTH_ROOT') . '/etc';
		$etc_writable = is_writable($etc_dir);
		$idp_ini_present = 	file_exists(constant('SAMLAUTH_ROOT') . '/etc/config/saml20-idp-remote.ini');
	
		if( !$etc_writable )
		{
			echo '<div class="error below-h2"><p>I\'m not able to write to the folder <code>' . $etc_dir . '</code> which means you won\'t be able to change any settings! Please ensure that the web server has permission to make changes to this folder.</p></div>'."\n";
		}
		
		if( $save_status === FALSE )
		{
			echo '<div class="error below-h2"><p>Your changes couldn&rsquo;t be saved. Is the file writable by the server?</p></div>'."\n";
		}
	?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?page=' . basename(__FILE__); ?>&updated=true">
    <fieldset class="options">
    
    <p><strong>Note:</strong> A Valid Identity Provider (IdP) must be declared before <?php if( is_multisite()){ echo 'any sites in the network';} else{ echo 'the site.';}?> can use Single-Sign On.<?php if( is_multisite()){ echo ' These settings affect all sites in your network.';}?></p>
    
    <table class="form-table">
    	<?php
			foreach($metadata as $key => $idp)
			{
?>
<tr valign="top">
  <th scope="row"><label for="idp_name">IdP name</label></th> 
  <td><input type="text" name="idp_name" id="sp_auth_inp" value="<?php echo $idp['name']['en']; ?>" size="40" />
  <span class="setting-description">The name that will appear when setting up a service provider.</span> 
  </td>
</tr>
<tr valign="top">
  <th scope="row"><label for="idp_identifier">URL Identifier</label></th> 
  <td><input type="text" name="idp_identifier" id="idp_identifier" value="<?php echo $key; ?>" size="40" />
  <span class="setting-description">The URL that identifies this particular IdP.</span> 
  </td>
</tr>
<tr valign="top">
  <th scope="row"><label for="idp_signon">Single Sign-On URL</label></th> 
  <td><input type="text" name="idp_signon" id="idp_signon" value="<?php echo $idp['SingleSignOnService']; ?>" size="40" />
  <span class="setting-description">Tthe URL where sign-on assertions are sent.</span> 
  </td>
</tr>
<tr valign="top">
  <th scope="row"><label for="idp_logout">Single Logout URL</label></th> 
  <td><input type="text" name="idp_logout" id="idp_logout" value="<?php echo $idp['SingleLogoutService']; ?>" size="40" />
  <span class="setting-description">The URL where logout assertions are sent.</span> 
  </td>
</tr>
<tr valign="top">
  <th scope="row"><label for="idp_fingerprint">Certificate Fingerprint</label></th> 
  <td><input type="text" name="idp_fingerprint" id="idp_fingerprint" value="<?php echo implode(":",str_split($idp['certFingerprint'],2)); ?>" size="40" style="font-family: monospace;"/>
  <span class="setting-description">The fingerprint of the certificate that the IdP uses to sign assertions.</span> 
  </td>
</tr>
<?php	
			}
			?>
    </table>
    </fieldset>
    <div class="submit">
      <input type="submit" name="submit" class="button button-primary" value="Update Options" />
    </div>
  </form>
  
 
</div>
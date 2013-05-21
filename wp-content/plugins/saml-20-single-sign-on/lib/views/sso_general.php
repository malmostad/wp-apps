<?php
  // Setup Default Options Array
  global $saml_opts;
  
  if (isset($_POST['submit']) ) 
  { 
    if(get_option('saml_authentication_options'))
    		$saml_opts = get_option('saml_authentication_options');
    		
    switch($_POST['config_path'])
    {
      case 'upload':
        $upload = wp_upload_dir();
        $config_path = $upload['basedir'] . '/etc';
      break;
      case 'plugin':
      default:
        $config_path = constant('SAMLAUTH_ROOT') . '/etc';
      break; 
    }
    $saml_opts['enabled'] = ($_POST['enabled'] == 'enabled') ? true : false;
    
    if($config_path != $saml_opts['config_path'])
    {
      $old = $saml_opts['config_path'];
      $new = $config_path;
      if(is_writable( dirname($new) ) )
      {
        if(file_exists($new))
        {
          
        }
      }
      // We need to do several things: 
      // 1. Make sure the new path exists/is writable
      // 2. Copy all the stuff from the current path to the new one
      // 3. Remove the old stuff (if possible?)
    }
    
    $saml_opts['config_path'] = $config_path; 
    
    update_option('saml_authentication_options', $saml_opts);
  }
  
  if(get_option('saml_authentication_options'))
    		$saml_opts = get_option('saml_authentication_options');

?>

<div class="wrap">
<p><em>Note:</em> Once you enable SAML authentication, WordPress authentication will happen through the Single Sign-On plugin, even if you misconfigure it. To avoid being locked out of WordPress, use a second browser to check your settings before you end this session as Administrator. If you get an error in the other browser, correct your settings here. If you can not resolve the issue, disable this plug-in.</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?page=' . basename(__FILE__); ?>&updated=true">
<table class="form-table">
	<tr valign="top">
    <th scope="row"><label for="enabled">Enable SAML authentication</label></th> 
    <?php
			$checked = ($saml_opts['enabled']) ? ' checked="checked"' : '';
		?><td><input type="checkbox" name="enabled" id="enabled" value="enabled" <?php echo $checked;?> />
    </td>
  </tr>
  <tr valign="top">
    <th scope="row">Store configuration files: </label></th>
    <td>
    <?php
    if($saml_opts['config_path'] == constant('SAMLAUTH_ROOT') . '/etc' || !isset($saml_opts['config_path']))
      $current_path = 'plugin';
    else
      $current_path = 'upload';
    ?>
    <input type="radio" name="config_path" value="plugin" <?php if($current_path == 'plugin'){echo 'checked="checked"';}?> />&nbsp;&nbsp;<label for="config_path">With the plugin files</label><br/>
    <input type="radio" name="config_path" value="upload"<?php if($current_path == 'upload'){echo 'checked="checked"';}?> />&nbsp;&nbsp;<label for="config_path">In the uploads folder</label><br/>
    <span class="setting-description">Some servers may not let you save files in the plugin directory, so you may want to put them in your uploads folder instead.<br/> CURRENT: <?php echo constant('SAMLAUTH_CONFIG_PATH');?></span>
    </td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" class="button button-primary" value="Update Options" /></td>
  </tr>
</table>
</form>

<h3>Service Provider Info</h3>
<p>You will need to supply your identity provider with this information. If you want your users to be able to log in directly from WordPress (as opposed to logging in from a separate SSO portal), then you will also need to supply your IdP with the <strong>signing certificate</strong> used above.</p>
  <?php
    //print constant('SAMLAUTH_URL');
    //die;
	  $c = curl_init(constant('SAMLAUTH_URL') . '/saml/www/module.php/saml/sp/metadata.php/' . get_current_blog_id());
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		$o = curl_exec($c);
		print constant('SAMLAUTH_URL') . '/saml/www/module.php/saml/sp/metadata.php/' . get_current_blog_id();
    //var_dump( $o );

  	preg_match('/(entityID="(?P<entityID>.*)")/',$o,$entityID);
		preg_match('/(<md:SingleLogoutService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect" Location="(?P<Logout>.*)")/',$o,$Logout);
		preg_match('/(<md:AssertionConsumerService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" Location="(?P<Consumer>.*)" index)/',$o,$Consumer);
		
		$metadata['entityID'] = $entityID['entityID'];
		$metadata['Logout'] = $Logout['Logout'];
		$metadata['Consumer'] = $Consumer['Consumer'];
	?>
  <p>
    <strong>Your Entity ID:</strong><br/>
    <pre class="metadata-box">
    <?php echo $metadata['entityID'];?>
    </pre>
  </p>
  <p>
    <strong>Your Single Logout URL:</strong><br/>
    <pre class="metadata-box">
    <?php echo $metadata['Logout'];?>
    </pre>
  </p>
  <p>
    <strong>Your SAML Assertion Consumer URL:</strong><br/>
    <pre class="metadata-box">
    <?php echo $metadata['Consumer'];?>
    </pre>
  </p>
</div>
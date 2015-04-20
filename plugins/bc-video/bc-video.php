<?php
/*
  Plugin Name: BC Video
  Plugin URI: https://github.com/malmostad/wp-apps
  Description: Simple shortcode support to add videos from the Brightcove Cloud in Wordpress posts. Usage: [bc id="123123123"]
  Version: 0.0.1
  Author: Malmö stad
  Author URI: https://github.com/malmostad

  Instructions:
    In a Wordpress post, insert the shortcode with the `id`
    for the video you want to display. You get the id when
    you manage the video in Brightcove:

    [bc id="123123123"]
*/

add_shortcode('bc','addBrightcoveVideo');

function addBrightcoveVideo($attrs) {
	return "
<div class='bc-video-box'>
  <script language='JavaScript' type='text/javascript' src='https://sadmin.brightcove.com/js/BrightcoveExperiences.js'></script>
  <object id='myExperience4162254067001' class='BrightcoveExperience'>
    <param name='bgcolor' value='#f0f0f0'/>
    <param name='playerID' value='2810881920001'/>
    <param name='playerKey' value='AQ~~,AAAArZCmTQE~,w5iz83926flwNgeVE8x1_ZgoF5t7oTGp'/>
    <param name='isVid' value='true'/>
    <param name='isUI' value='true'/>
    <param name='dynamicStreaming' value='true'/>
    <param name='wmode' value='opaque'/>
    <param name='htmlFallback' value='true'/>
    <param name='includeAPI' value='true'/>
    <param name='templateLoadHandler' value='onTemplateLoad'/>
    <param name='templateReadyHandler' value='onTemplateReady'/>
    <param name='secureConnections' value='true'/>
    <param name='secureHTMLConnections' value='true'/>
    <param name='@videoPlayer' value='{$attrs["id"]}'/>
  </object>
  <script type='text/javascript'>brightcove.createExperiences();</script>
  <script type='text/javascript' src='https://sadmin.brightcove.com/js/api/SmartPlayerAPI.js'></script>
</div>
";
}

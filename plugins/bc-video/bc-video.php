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
	<video id='bc-video'
	  data-account='745456160001'
	  data-player='ac887454-ec8b-4ffc-a530-4af5c1c8e8c7'
		data-video-id='{$attrs["id"]}'
	  data-embed='default'
	  class='video-js bc-video' controls></video>

		<script src='//players.brightcove.net/745456160001/ac887454-ec8b-4ffc-a530-4af5c1c8e8c7_default/index.min.js'></script>
		<link href='//players.brightcove.net/videojs-social/dist/videojs-social.css' rel='stylesheet'>
		<script src='//players.brightcove.net/videojs-social/dist/videojs-social.min.js'></script>
		<script>
		videojs('bc-video').ready(function () {
		  //Kolla komin:
		  this.on('loadedmetadata', function (evt) {
		    if (!eval(this.mediainfo.custom_fields.targetgroup === 'Komin')) {
		      var options = {
		        'title': this.mediainfo.name,
		        'description': this.mediainfo.description,
		        'url': 'http://video.malmo.se?bctid=' + this.mediainfo.id,
		        'displayAfterVideo': false,
		        'deeplinking': false,
		        'offset': '00:00:00',
		        'services': {
		          'facebook': true,
		          'google': true,
		          'twitter': true,
		          'tumblr': true,
		          'pinterest': true,
		          'linkedin': true
		        }
		      };
		      this.social(options);
		    }
		  });
		});
		</script>
</div>
";
}

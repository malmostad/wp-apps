<?php if (is_single()): ?>
<meta name='twitter:card' content='summary'/>
<meta name='twitter:site' content='@malmostad‎'/>
<meta name='twitter:domain' content='malmo.se'/>
<meta name='twitter:title' content='<?php the_title(); ?>'/>
<meta name='twitter:url' content='<?php echo urlencode(the_guid()) ?>'/>
<meta name='twitter:description' content='<?php echo truncate_excerpt_chars($post->post_content, 200) ?>'/>
<meta name='twitter:image:src' content='<?php echo get_gravatar_url(get_the_author_meta("user_email", $post->post_author)) ?>'/>
<meta property="og:type" content="blog"/>
<meta property='og:title' content='<?php the_title(); ?>'/>
<meta property='og:url' content='<?php echo urlencode(the_guid()) ?>'/>
<meta property='og:description' content='<?php echo truncate_excerpt_chars($post->post_content, 200) ?>'/>
<meta property='og:image' content='<?php echo get_gravatar_url(get_the_author_meta("user_email", $post->post_author)) ?>'/>
<?php endif ?>

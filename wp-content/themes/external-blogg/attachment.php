<?php
/**
 * The template for displaying attachments.
 */
get_header(); ?>

<div id="container" class="single-attachment">
	<div id="content" role="main">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
				the_post();
			?>
				<?php if ( ! empty( $post->post_parent ) ) : ?>
					<p>
						<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Tillbaka till <?php esc_attr(get_the_title( $post->post_parent ) ) ?>" rel="gallery">
							<span class="meta-nav">&larr;</span> <?php echo get_the_title( $post->post_parent ) ?>
						</a>
					</p>
				<?php endif; ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><?php the_title(); ?></h2>

					<div class="entry-meta">
						<span class="meta-prep meta-prep-author">Av </span>
						<span class="author vcard">
							<a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author() ?></a>
						</span>

						<span class="meta-sep">|</span>
						<span class="meta-prep meta-prep-entry-date">Publicerad </span>
						<span class="entry-date"><abbr class="published"><?php echo get_the_time() . ' ' . get_the_date() ?></abbr></span>

						<?php if ( wp_attachment_is_image() ) : ?>
							<span class="meta-sep">|</span>
							<?php $metadata = wp_get_attachment_metadata() ?>
							<a href="<?php echo wp_get_attachment_url() ?>">Full storlek är <?php echo $metadata['width'] . '&times;' . $metadata['width'] ?> pixlar</a>
							<span class="meta-sep">|</span>
							<?php edit_post_link('Redigera'); ?>
						<?php endif; ?>
					</div>

					<div class="entry-content">
						<div class="entry-attachment">
							<?php
								if ( wp_attachment_is_image() ) :
									$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
									foreach ( $attachments as $k => $attachment ) {
										if ( $attachment->ID == $post->ID )
											break;
									}
									$k++;
									// If there is more than 1 image attachment in a gallery
									if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[ $k ] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
									} else {
										// or, if there's only 1 image attachment, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
								?>
								<p class="attachment">
									<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
										<?php
											$attachment_size = apply_filters( 'malmo_attachment_size', 900 );
											echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
										?>
									</a>
								</p>

								<div id="nav-below" class="navigation">
									<div class="nav-previous"><?php previous_image_link( false ); ?></div>
									<div class="nav-next"><?php next_image_link( false ); ?></div>
								</div>
							<?php else : ?>
								<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
							<?php endif; ?>
						</div>
						<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' .'Sidor', 'after' => '</div>' ) ); ?>
					</div>
				</div>

			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>

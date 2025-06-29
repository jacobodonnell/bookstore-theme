<?php

get_header(); ?>

<?php if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>
        <div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="image-wrapper">
				<?php the_post_thumbnail( 'medium' ) ?>
            </div>
			<?php the_excerpt(); ?>
        </div>
	<?php }
}

get_footer();
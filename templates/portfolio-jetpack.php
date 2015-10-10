<?php
/**
 * The template for displaying portfolio.
 *
 * Template Name: Portfolio – Jetpack
 *
 * @package Maker
 */

get_header(); ?>

<div id="main" class="site-main" role="main">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">

			<?php if ( get_theme_mod( 'maker_display_portfolio_text' ) ) : ?>
			
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php endwhile;?>

			<?php endif ?>

			<?php
				// Check if we have pagination.
				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = 1;
				endif;

				// Default posts per page option.
				$posts_per_page = get_option( 'posts_per_page', 9 );

				// Check if Jetpack Portfolio is activated.
				if ( post_type_exists( 'jetpack-portfolio' ) ) :

					$args = array(
						'post_type'      => 'jetpack-portfolio',
						'order'          => 'DESC',
						'orderby'        => 'date',
						'paged'          => $paged,
						'posts_per_page' => $posts_per_page,
					);

					$portfolio_query = new WP_Query( $args );

					// Pagination fix.
					$temp_query = $wp_query;
					$wp_query   = null;
					$wp_query   = $portfolio_query;

					if ( $portfolio_query -> have_posts() ) :

						printf(
							'<div class="portfolio-grid %s">',
							sanitize_html_class( maker_portfolio_grid_class() )
						);

							while ( $portfolio_query -> have_posts() ) : $portfolio_query -> the_post();

								get_template_part( 'template-parts/content', 'portfolio-jetpack' );

							endwhile;

						echo '</div>';

						wp_reset_postdata();

						maker_posts_pagination();

					endif;

					// Restore original query.
					$wp_query = null;
					$wp_query = $temp_query;

				endif;
			?>

		</div>
	</div><!-- #content -->
</div><!-- #main -->

<?php get_footer(); ?>

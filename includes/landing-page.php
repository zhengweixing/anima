<?php
/**
 * Landing page functions
 * Used in front-page.php
 *
 * @package Anima
 */

/**
 * slider builder
 */
if ( ! function_exists('anima_lpslider' ) ):
function anima_lpslider() {
	$options = cryout_get_option( array( 'anima_lpslider', 'anima_lpsliderimage', 'anima_lpslidertitle', 'anima_lpslidertext', 'anima_lpslidershortcode', 'anima_lpsliderserious', 'anima_lpslidercta1text', 'anima_lpslidercta1link', 'anima_lpslidercta2text', 'anima_lpslidercta2link' ) );

	// output cta area before slider
	anima_lpslider_cta_output( array(
		'title' => $options['anima_lpslidertitle'],
		'content' => $options['anima_lpslidertext'],
		'lpslidercta1text' => $options['anima_lpslidercta1text'],
		'lpslidercta1link' => $options['anima_lpslidercta1link'],
		'lpslidercta2text' => $options['anima_lpslidercta2text'],
		'lpslidercta2link' => $options['anima_lpslidercta2link'],
	) );

	if ( $options['anima_lpslider'] )
		switch ( $options['anima_lpslider'] ):
			case 1:
				if ( is_string( $options['anima_lpsliderimage'] ) ) {
					$image = $options['anima_lpsliderimage'];
				}
				else {
					list( $image, ) = wp_get_attachment_image_src( $options['anima_lpsliderimage'], 'full' );
				}
				anima_lpslider_output( array(
					'image' => $image,
					'title' => $options['anima_lpslidertitle'],
					'content' => $options['anima_lpslidertext'],
				) );
			break;
			case 2:
				?> <div class="lp-slider-wrapper"> <section class="lp-dynamic-slider"> <?php
				echo do_shortcode( $options['anima_lpslidershortcode'] );
				?> </section> <!-- lp-dynamic-slider --> </div> <?php
			break;
			case 3:
				// header image
			break;
			case 4:
				?> <div class="lp-slider-wrapper"> <section class="lp-dynamic-slider"> <?php
					if ( ! empty( $options['anima_lpsliderserious'] ) ) {
						echo do_shortcode( '[serious-slider id="' . $options['anima_lpsliderserious'] . '"]' );
					}
				?> </section> <!-- lp-dynamic-slider --> </div> <?php
			break;

			default:
			break;
		endswitch;
} //  anima_lpslider()
endif;

/**
 * slider cta output
 */
if ( ! function_exists( 'anima_lpslider_cta_output' ) ):
function anima_lpslider_cta_output( $data ){
	extract($data);
 	if ( empty( $title ) && empty( $content ) && empty( $lpslidercta1text ) && empty( $lpslidercta2text ) ) return; ?>

	<?php
} // anima_lpslider_cta_output()
endif;

/**
 * slider output
 */
if ( ! function_exists( 'anima_lpslider_output' ) ):
function anima_lpslider_output( $data ){
	extract($data);
	if ( empty( $image ) ) return; ?>

	<div class="lp-slider-wrapper"> 
		<section class="lp-staticslider">
			<?php if ( ! empty( $image ) ) { ?>
				<img class="lp-staticslider-image" alt="<?php echo esc_attr( $title ) ?>" src="<?php echo esc_url( $image ); ?>">
			<?php } ?>
		</section><!-- .lp-staticslider -->
	</div>

<?php
} // anima_lpslider_output()
endif;


/**
 * blocks builder
 */
if ( ! function_exists( 'anima_lpblocks' ) ):
function anima_lpblocks( $sid = 1 ) {
	$maintitle = cryout_get_option( 'anima_lpblockmaintitle'.$sid );
	$maindesc = cryout_get_option( 'anima_lpblockmaindesc'.$sid );
	$pageids = cryout_get_option( apply_filters('anima_blocks_ids', array( 'anima_lpblockone'.$sid, 'anima_lpblocktwo'.$sid, 'anima_lpblockthree'.$sid, 'anima_lpblockfour'.$sid), $sid ) );
	$icon = cryout_get_option( apply_filters('anima_blocks_icons', array( 'anima_lpblockoneicon'.$sid, 'anima_lpblocktwoicon'.$sid, 'anima_lpblockthreeicon'.$sid, 'anima_lpblockfouricon'.$sid ), $sid ) );
	$blockscontent = cryout_get_option( 'anima_lpblockscontent'.$sid );
	$blocksclick = cryout_get_option( 'anima_lpblocksclick'.$sid );
	$blocksreadmore = cryout_get_option( 'anima_lpblocksreadmore'.$sid );
	$count = 1;
	$pagecount = count( array_filter( $pageids, function ($v) { return $v > 0; } ) );
	if ( empty( $pagecount ) ) return;
	if ( -1 == $blockscontent ) return;
	?>

<?php
wp_reset_postdata();
} //anima_lpblocks()
endif;

/**
 * blocks output
 */
if ( ! function_exists( 'anima_lpblock_output' ) ):
function anima_lpblock_output( $data ) { ?>
	<?php extract($data) ?>
			<div class="lp-block block<?php echo absint( $id ); ?>">
				<?php if ( $click ) { ?><a href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr( $title ); ?>"<?php echo $target ?>><?php } ?>
					<?php if ( ! empty ( $icon ) )	{ ?> <i class="blicon-<?php echo esc_attr( $icon ); ?>"></i><?php } ?>
				<?php if ( $click ) { ?></a> <?php } ?>
					<div class="lp-block-content">
						<?php if ( ! empty ( $title ) ) { ?><h4 class="lp-block-title"><?php echo do_shortcode( $title ) ?></h4><?php } ?>
						<?php if ( ! empty ( $text ) ) { ?><div class="lp-block-text"><?php echo do_shortcode( $text ) ?></div><?php } ?>
						<?php if ( ! empty ( $readmore ) ) { ?><a class="lp-block-readmore" href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); ?>> <?php echo do_shortcode( wp_kses_post( $readmore ) ); ?> <em class="screen-reader-text">"<?php echo esc_attr( $title ) ?>"</em> </a><?php } ?>
					</div>
			</div><!-- lp-block -->
	<?php
} // anima_lpblock_output()
endif;


/**
 * boxes builder
 */
if ( ! function_exists( 'anima_lpboxes' ) ):
function anima_lpboxes( $sid = 1 ) {
	$options = cryout_get_option(
				array(
					 'anima_lpboxmaintitle' . $sid,
					 'anima_lpboxmaindesc' . $sid,
					 'anima_lpboxcat' . $sid,
					 'anima_lpboxrow' . $sid,
					 'anima_lpboxcount' . $sid,
					 'anima_lpboxlayout' . $sid,
					 'anima_lpboxmargins' . $sid,
					 'anima_lpboxanimation' . $sid,
					 'anima_lpboxreadmore' . $sid,
					 'anima_lpboxlength' . $sid,
				 )
			 );

	if ( ( $options['anima_lpboxcount' . $sid] <= 0 ) || ( $options['anima_lpboxcat' . $sid] == '-1' ) ) return;

 	$box_counter = 1;
	$animated_class = "";
	if ( $options['anima_lpboxanimation' . $sid] == 1 ) $animated_class = 'lp-boxes-animated';
	if ( $options['anima_lpboxanimation' . $sid] == 2 ) $animated_class = 'lp-boxes-static';
	if ( $options['anima_lpboxanimation' . $sid] == 3 ) $animated_class = 'lp-boxes-animated lp-boxes-animated2';
	if ( $options['anima_lpboxanimation' . $sid] == 4 ) $animated_class = 'lp-boxes-static lp-boxes-static2';

	$custom_query = new WP_query();
    if ( ! empty( $options['anima_lpboxcat' . $sid] ) ) $cat = $options['anima_lpboxcat' . $sid]; else $cat = '';

	$args = apply_filters( 'anima_boxes_query_args', array(
		'showposts' => $options['anima_lpboxcount' . $sid],
		'cat' => cryout_localize_cat( $cat ),
		'ignore_sticky_posts' => 1,
		'lang' => cryout_localize_code()
	), $options['anima_lpboxcat' . $sid], $sid );

    $custom_query->query( $args );

    if ( $custom_query->have_posts() ) : ?>
	
<?php endif;
	wp_reset_postdata();
} //  anima_lpboxes()
endif;

/**
 * boxes output
 */
if ( ! function_exists( 'anima_lpbox_output' ) ):
function anima_lpbox_output( $data ) {
	$randomness = array ( 6, 8, 1, 5, 2, 7, 3, 4 );
	extract($data); ?>
			<div class="lp-box box<?php echo absint( $colno ); ?> ">
					<div class="lp-box-image lpbox-rnd<?php echo $randomness[$colno%8]; ?>">
						<?php if( ! empty( $image ) ) { ?> <img alt="<?php echo esc_attr( $title ) ?>" src="<?php echo esc_url( $image ) ?>" /> <?php } ?>

						<div class="lp-box-overlay">
							<a class="lp-box-link" <?php if( ! empty( $link ) ) { ?> href="<?php echo esc_url( $link ); ?>"<?php } ?> aria-label="<?php echo esc_attr( $title ); ?>" <?php echo esc_attr( $target ); ?>> <?php echo do_shortcode( wp_kses_post( $readmore ) ) ?> <i class="icon-continue-reading"></i></a>
						</div>
					</div>
					<div class="lp-box-content">
						<?php if ( ! empty( $title ) ) { ?><h5 class="lp-box-title">
							<?php if ( !empty( $readmore ) && !empty( $link ) ) { ?> <a href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); ?>><?php } ?>
								<?php echo do_shortcode( $title ); ?>
							<?php if ( !empty( $readmore ) && !empty( $link ) ) { ?> </a> <?php } ?>
						</h5><?php } ?>
						<div class="lp-box-text">
							<?php if ( ! empty( $content ) ) { ?>
								<div class="lp-box-text-inside"> <?php echo do_shortcode( $content ) ?> </div>
							<?php } ?>
							<?php if( ! empty( $readmore ) ) { ?>
								<a class="lp-box-readmore" href="<?php if( ! empty( $link ) ) { echo esc_url( $link ); } ?>" <?php echo esc_attr( $target ); ?>> <?php echo do_shortcode( wp_kses_post( $readmore ) ) ?> <em class="screen-reader-text">"<?php echo esc_attr( $title ) ?>"</em> <i class="icon-continue-reading"></i></a>
							<?php } ?>
						</div>
					</div>
			</div><!-- lp-box -->
	<?php
} // anima_lpbox_output()
endif;


/**
 * text area builder
 */
if ( ! function_exists( 'anima_lptext' ) ):
function anima_lptext( $what = 'one' ) {
	$pageid = cryout_get_option( 'anima_lptext' . $what );
	$pageid = cryout_localize_id( $pageid );
	if ( intval( $pageid ) > 0 ) {
		$page = get_post( $pageid );
		$data = array(
			'title' => apply_filters( 'anima_text_title', get_the_title( $pageid ), $pageid ),
			'text'	=> apply_filters( 'the_content', get_post_field( 'post_content', $pageid ) ),
			'class' => apply_filters( 'anima_text_class', '', $pageid ),
			'id' 	=> $what,
		);
		list( $data['image'], ) = wp_get_attachment_image_src( get_post_thumbnail_id( $pageid ), 'full' );
		anima_lptext_output( $data );
	}
} // anima_lptext()
endif;

/**
 * text area output
 */
if ( ! function_exists( 'anima_lptext_output' ) ):
function anima_lptext_output( $data ){ ?>
	<section class="lp-text" id="lp-text-<?php echo esc_attr( $data['id'] ); ?>"<?php if( ! empty( $data['image'] ) ) { ?> style="background-image: url( <?php echo esc_url( $data['image'] ); ?>);" <?php } ?> >
			<div class="lp-text-inside">
				<?php if( ! empty( $data['title'] ) ) { ?><h2 class="lp-text-title"><?php echo do_shortcode( $data['title'] ) ?></h2><?php } ?>
				<?php if( ! empty( $data['text'] ) ) { ?><div class="lp-text-content"><?php echo do_shortcode( $data['text'] ) ?></div><?php } ?>
			</div>

	</section><!-- .lp-text-<?php echo esc_attr( $data['id'] ); ?> -->
<?php
} // anima_lptext_output()
endif;

/**
 * page or posts output, also used when landing page is disabled
 */
if ( ! function_exists( 'anima_lpindex' ) ):
function anima_lpindex() {

	$anima_lpposts = cryout_get_option('anima_lpposts');

	switch ($anima_lpposts) {

		case 2: // static page

			if ( have_posts() ) :
					?><section id="lp-page"> <div class="lp-page-inside"><?php
					get_template_part( 'content/content', 'page' );
					?></div> </section><!-- #lp-page --><?php
			endif;

		break;

		case 1: // posts

			if ( get_query_var('paged') ) $paged = get_query_var('paged');
			elseif ( get_query_var('page') ) $paged = get_query_var('page');
			else $paged = 1;
			$custom_query = new WP_query( array('posts_per_page'=>get_option('posts_per_page'),'paged'=>$paged) );

			if ( $custom_query->have_posts() ) :  ?>
				<section id="lp-posts"> <div class="lp-posts-inside">
				<div id="content-masonry" class="content-masonry" <?php cryout_schema_microdata( 'blog' ); ?>> <?php
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
						get_template_part( 'content/content', get_post_format() );
					endwhile; ?>
				</div> <!-- content-masonry -->
				</div> </section><!-- #lp-posts -->
				<?php anima_pagination();
				wp_reset_postdata();
			else :
				//get_template_part( 'content/content', 'notfound' );
			endif;

		break;

		case 0: // disabled
		default: break;
	}

} // anima_lpindex()
endif;

// FIN

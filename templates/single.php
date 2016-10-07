<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	
	
	<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>

	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	
	.comment {
		/*width: 600px;*/
		width: auto;
	}
	.comment.depth-1, .comment.depth-2 {
		display: none;
	}
	.comment-content p {
    white-space: initial;
	}
	
	/* Unicode-based stars and half-star credit: amoniker, https://coderwall.com/p/iml9ka/star-ratings-in-css-utf8 */
	 .star-icon {
		 color: #ddd;
		 font-size: 34px;
		 position: relative;
	 }

	 .star-icon.full:before {
		 color: #FDE16D;
		 content: '\2605'; /* Full star in UTF8 */
		 position: absolute;
		 left: 0;
		 text-shadow: 0 0 2px rgba(0,0,0,0.7);
	 }

	 .star-icon.half:before {
		 color: #FDE16D;
		 content: '\2605'; /* Full star in UTF8 */
		 position: absolute;
		 left: 0;
		 width: 50%;
		 overflow: hidden;
		 text-shadow: 0 0 2px rgba(0,0,0,0.7);
	 }
	
	</style>
</head>
<body class="single-post">
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>


	<div class="amp-wp-content post-title-meta">
		<?php if($redux_builder_amp['enable-single-post-meta'] == true) { ?>
			<ul class="amp-wp-meta">
				<?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-author') ) ); ?>

				<li> <?php _e(' on ','ampforwp'); the_time( get_option( 'date_format' ) ) ?></li> 

				<?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array('meta-taxonomy' ) ) ); ?>

				<li class="cb"></li>
			</ul>
		<?php } ?>
		<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
	</div>
	<div class="amp-wp-content featured-image-content">
    <?php if($redux_builder_amp['enable-single-featured-img'] == true) {
        if ( has_post_thumbnail() ) { ?>
        <?php
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
        $thumb_url = $thumb_url_array[0];            
        ?> 
        <div class="post-featured-img"><amp-img src=<?php echo $thumb_url ?> width=512 height=300 layout=responsive></amp-img></div>
    <?php } } ?>
	</div>
	<div class="amp-wp-content the_content">

        <?php do_action( 'ampforwp_before_post_content', $this ); ?>
		
		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
		<?php do_action( 'ampforwp_after_post_content', $this ); ?>
	</div>

	<div class="amp-wp-content post-pagination-meta">
		<?php $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) ); ?> 


    <?php if($redux_builder_amp['enable-next-previous-pagination'] == true) { ?>
		<div id="pagination">
			<div class="next"><?php next_post_link(); ?></div>
			<div class="prev"><?php previous_post_link(); ?></div>
			<div class="clearfix"></div>
		</div>
    <?php } ?>
	</div>

	<?php if($redux_builder_amp['enable-single-social-icons'] == true)  { ?>
		<div class="sticky_social">          
			<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
		    	<amp-social-share type="facebook"    data-param-app_id="<?php echo $redux_builder_amp['amp-facebook-app-id']; ?>" width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  { ?>
		    	<amp-social-share type="twitter"    width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-gplus-share'] == true)  { ?>
		    	<amp-social-share type="gplus"      width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
		    	<amp-social-share type="email"      width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
		    	<amp-social-share type="pinterest"  width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
		    	<amp-social-share type="linkedin"   width="50" height="28"></amp-social-share>
		  	<?php } ?>
		</div>
	<?php } ?>
	
<?php 
		// $comments_meta = 2.50;
		// $whole = floor($comments_meta);     
		// $fraction = $comments_meta - $whole;
		// echo 'Rating: '.$comments_meta . '<br />' ;
		
	//  for ($i=0; $i < $whole; $i++) 
	//  { ?>
		<span class="star-icon full"> &#9734; </span>
		<?php // } 
	// if ($fraction) { ?> 
	 	 <span class="star-icon half"> &#9734; </span>
	 <?php // }
?>
	
	<amp-carousel width="600"
	      height="300"
	      layout="responsive"
	      type="carousel">
			<?php
				//Gather comments for a specific page/post 
				//  $postID = get_the_ID();
				// $comments = get_comments(array(
				// 	'post_id' => $postID,
				// 	'status' => 'approve' //Change this to the type of comments to be displayed
				// ));
				//Display the list of comments
				// wp_list_comments( array(
				// 	'per_page' 					=> 10, //Allow comment pagination
				// 	'style' 						=> 'div',
				// 	'type'							=> 'comment',
				// 	'max_depth'   			=> 0,
				// 	'avatar_size'				=> 0,
				// 	'reverse_top_level' => false //Show the latest comments at the top of the list
				// ), $comments);
			?>
	</amp-carousel>

	<?php
// $args = array(
//   'meta_key' => 'ERRating',
// 	'value' 	 => '1'
// );
 
// $args = array(
//     'post__in' => $postID,
// 		'meta_query' => array(
//         'relation' => 'AND',
//         array(
//             'key' => 'ERRating',
//             'value' => '4',
//             'type' => 'numeric',
//             'compare' => '>='
//         ),
//         array(
//             'key' => 'ERRating',
//             'value' => '4',
//             'type' => 'numeric',
//             'compare' => '>='
//         )
//     )
// );
// 
// // The Query
// $comments_query = new WP_Comment_Query;
// $comments = $comments_query->query( $args );
// 
// 
// $commentsId = $comments;
// 
// $reviewsNumber = get_comment_meta( $comments->comment_ID, 'ERRating' );

// var_dump($commentsId);

// Comment Loop
// if ( $comments ) {
// 	foreach ( $comments as $comment ) {
// 		echo '<p>' . $comment->comment_content . '</p>';
// 	}
// } else {
// 	echo 'No comments found.';
// }
?>
	
	
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>

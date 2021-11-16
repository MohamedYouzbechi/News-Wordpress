<?php 
	get_header();
	include(get_template_directory() . '/includes/breadcrumb.php');
?>

<div class="container post-page">
  <?php
	if (have_posts()) {
		while (have_posts()) {
			the_post(); ?>
				<div class="main-post single-post">
					<?php edit_post_link('Edit <i class="fas fa-pencil-alt"></i>') ?>
					<h3 class='post-title'>
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h3>	
					<span class="post-date">
						<i class="fa fa-calendar fa-fw"></i> <?php the_time('F j, Y'); ?>
					</span>
					<span class="post-comments">
						<i class="fa fa-comments-o fa-fw"></i>
						<?php comments_popup_link('0 comments','one comment', '% comments', 'comment-url', 'comments Disabled'); ?>
					</span>
					<?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
					<hr>
					<p class="post-categories">
						<i class="fa fa-tags fa-fw"></i>
						<?php the_category(', '); ?>
					</p>
					<p class="post-tags">
						<?php 
							if(has_tag()){
								the_tags();
							}else{
							 	echo 'Tags: There\'s No Tags';
							}
						?>
					</p>
				</div>
		<?php
		}
	}

	//echo '<div class="clearfix"></div>'; 
	//wp_get_post_categories(get_queried_object_id());
	$random_posts_arguments = array(
		'posts_per_page'	=> 5,
		'orderby'			=> 'rand',
		'category__in'		=> wp_get_post_categories(get_queried_object_id()),
		'post__not_in'		=> array(get_queried_object_id())
	);
	$random_posts = new wp_query($random_posts_arguments); ?>

	<div class="random-posts">
		<h3>Random Posts From The Same Categories</h3>
		<hr>
  <?php
	if ($random_posts->have_posts()) { 
		while ($random_posts->have_posts()) {
			$random_posts->the_post(); ?>		
				<h4 class='random-post-title'>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h4>			
			<?php
		}
	}
	echo '</div>';
	wp_reset_postdata();
  ?>
	<div class="author-area">
		<div class="row">
			<div class="col-md-2">
			  <?php
				$avatar_arguments = array(
					'class'	=>	'img-thumbnail img-responsive center-block'
				);

				echo get_avatar(get_the_author_meta('ID'), 128, '', 'User Avatar', $avatar_arguments);
			  ?>
			</div>

			<div class="col-md-10 author-info">
				<h4>
					<?php the_author_meta('first_name'); ?>
					<?php the_author_meta('last_name'); ?>
					( <span class="nickname"> <?php the_author_meta('nickname'); ?> </span> )
				</h4>
			
				<?php if(get_the_author_meta('description')){ ?>
						 <p><?php the_author_meta('description') ?></p>				
				<?php }else{echo 'there is No Biography';} ?>
			</div>
		</div>
	   <hr>
		<div class="author-stats">
			<p>
				<i class="fas fa-tags"></i> Nomber Of Posts Created By User Is: 
				<span class="posts-count"><?php echo count_user_posts(get_the_author_meta('ID')) ?></span>
			</p>
			<p>
				<i class="fas fa-home"></i> User Profile Link: <?php the_author_posts_link() ?>
			</p>
		</div>
	</div>

  <?php
	echo '<hr class="comment-separator">';
	echo '<div class="post-pagination">';
		if (get_previous_post_link()) {
			previous_post_link('%link','<i class="fa fa-chevron-left fa-lg" aria-hidden="true"></i>Previous Article: %title ');
		}else{
			echo '<span class="previous-span">Previous Article: None</span>';
		}
		if (get_next_post_link()) {
			next_post_link('%link','Next Article: %title <i class="fa fa-chevron-right fa-lg" aria-hidden="true"></i>');
		}else{
			echo '<span class="next-span">Next Article: None</span>';
		}
	echo '</div>';
	comments_template();
  ?>

</div>

<?php get_footer(); ?>
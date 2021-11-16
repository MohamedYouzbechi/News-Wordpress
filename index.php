<?php get_header(); ?>

<div class="container home-page">
	<div class="row">
	  <?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();
	  ?>
				<div class="col-sm-6">
					<div class="main-post">
						<h3 class='post-title'>
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<span class="post-author">
							<i class="fa fa-user fa-fw"></i> <?php the_author_posts_link(); ?>
						</span>	
						<span class="post-date">
							<i class="fa fa-calendar fa-fw"></i> <?php the_time('F j, Y'); ?>
						</span>
						<span class="post-comments">
							<i class="far fa-comments fa-fw"></i>
							<?php comments_popup_link('0 comments','one comment', '% comments', 'comment-url', 'comments Disabled'); ?>
						</span>
						<?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
						<div class="post-content">
							<?php the_excerpt(); ?>
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
				</div>
	  <?php
			}
		}
		echo '<div class="clearfix"></div>';
		echo '<div class="post-pagination">';
			if (get_previous_posts_link()) {
				previous_posts_link('<i class="fa fa-chevron-left fa-lg" aria-hidden="true"></i> Prev');
			}else{
				echo '<span class="previous-span">No Previous Page</span>';
			}

			if (get_next_posts_link()) {
				next_posts_link('Next <i class="fa fa-chevron-right fa-lg" aria-hidden="true"></i>');
			}else{
				echo '<span class="next-span">No Next Page</span>';
			}
		echo '</div>'; 
	  ?>
		<div class="pagination-numbers">
			<?php echo numbering_pagination(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
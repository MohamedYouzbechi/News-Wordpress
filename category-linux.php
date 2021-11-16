<?php get_header(); ?>

<div class="container home-page linux-category">
	<div class="row">
		<div class="category-information text-center">
			<div class="col-md-4">
				<h1 class="catrgory-title"><?php single_cat_title() ?></h1>
			</div>
			<div class="col-md-4">
				<div class="category-description"><?php echo category_description() ?></div>
			</div>
			<div class="col-md-4">
				<div class="cat-stats">
					<span>This Is Special Layout</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="col-md-9">
			<?php
				if (have_posts()) {

					while (have_posts()) {

						the_post(); ?>

						<div class="main-post">
							
							<div class="row">
								<div class="col-md-6">
									<?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
								</div>
								<div class="col-md-6">
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
										<i class="fa fa-comments-o fa-fw"></i>
										<?php comments_popup_link('0 comments','one comment', '% comments', 'comment-url', 'comments Disabled'); ?>
									</span>
									<div class="post-content">
										<?php the_excerpt(); ?>
									</div>
								</div>
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
					} // End While Loop
				} // End If Condition
			?>

		</div> <!-- End Col-Md-9 -->

		<div class="col-md-3">
			<div class="linux-sidebar">
				<?php
					/*if (is_active_sidebar('main-sidebar')) {
						dynamic_sidebar('main-sidebar');
					}*/
					get_sidebar('linux');
				?>
			</div>
		</div>

	</div> <!-- End Row -->

	<div class="pagination-numbers">
		<?php echo numbering_pagination(); ?>
	</div>

</div>

<?php get_footer(); ?>
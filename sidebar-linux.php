<?php
	$comments_args = array('status'	=> 'approve');

	$comments_count = 0;
	$all_comments = get_comments($comments_args);

	foreach ($all_comments as $comment) {
		$post_id = $comment->comment_post_ID;
		if (! in_category( 'linux', $post_id )) { // Chek if post not in linux category
			continue; // continue loop
		}
		$comments_count++;
	}

	// get Category Posts Count
	$cat = get_queried_object(); // get full object Properties
	$posts_count = $cat->count; // get posts Count
	/*echo '<pre>'; print_r($cat); echo '</pre>';*/
?>

<div class="sidebar-linux">
	<div class="widget">
		<h3 class="widget-title"><?php single_cat_title() ?> Statistics</h3>
		<div class="widget-content">
			<ul>
				<li>
					<span>Comments Count:</span> <?php echo $comments_count; ?>
				</li>
				<li>
					<span>Posts Count:</span> <?php echo $posts_count; ?>
				</li>
			</ul>
		</div>
	</div>
	<div class="widget">
		<h3 class="widget-title">Latest PHP Posts</h3>
		<div class="widget-content">
			<ul>
			  <?php
				$posts_args = array(
					'posts_per_page' => 5,
					'cat'			 => 8
				);
				$query = new wp_query($posts_args);

				if ($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post();
						echo '<li>';
							echo '<a target="_blank" href="';the_permalink();echo '">';
									the_title();
							echo '</a>';
						echo '</li>';
					}
				}
			  ?>
			</ul>
		</div>
	</div>
	<div class="widget">
		<h3 class="widget-title">Hot Post By Comment</h3>
		<div class="widget-content">
			<ul>
			  <?php
				$hotpost_args = array(
					'posts_per_page' 	=> 1,
					'orderby'			=> 'comment_count'
				);
				$hotquery = new wp_query($hotpost_args);

				if ($hotquery->have_posts()) {
					while ($hotquery->have_posts()) {
						$hotquery->the_post();
						echo '<li>';
							echo '<a target="_blank" href="';the_permalink();echo '">';
									the_title();
							echo '</a>';
							echo '<hr>This Post Has: ';
							comments_popup_link('0 comments','one comment', '% comments', 'comment-url', 'comments Disabled'); 
						echo '</li>';
					}
				}
			  ?>
			</ul>
		</div>
	</div>
</div>
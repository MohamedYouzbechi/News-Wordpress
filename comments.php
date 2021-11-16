<?php

if(comments_open()){ ?>
    <h3 class="comments-count"><?php comments_number('0 Comments','one Comment','% Comments') ?></h3>

  <?php
	echo '<ul class="list-unstyled comments-list">';
		$comments_arguments = array(
			'max_depth' => 3,
			'type'		=> 'comment',
			'avatar_size'	=> 64
		);
		wp_list_comments($comments_arguments);
	echo '</ul>';
	echo '<hr class="comment-separator">';

	/*$commentform_arguments = array(
		'fields'  => array(
			'author' => '<div class="form-group"><label>Your Name</label> <input class="form-control" /></div>',
			'email'  => '<div class="form-group"><label>Email</label> This Is Email Field</div>',
			'url' 	 => '<div class="form-group"><label>Url</label> This Is Url Field</div>',
		),
		'comment_field' => '<div class="form-group">Textarea</div>'		
	);*/  /***** For Customize comment_form ******/

	$commentform_arguments = array(
		'title_reply'			=> 'Add Your Comment',
		'title_reply_to'		=> 'Add A Replay To [%s]',
		'class_submit'			=> 'btn btn-primary btn-md',
		'comment_notes_before'	=> ''
	);

	comment_form($commentform_arguments);
}else{
	echo 'Sorry Comments Are Disabled';
}
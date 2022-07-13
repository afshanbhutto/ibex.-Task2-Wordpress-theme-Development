<?php if(have_posts()): while(have_posts()): the_post(); ?>
	

	<?php the_content();?>

<!-- for tags -->

	<?php
	$tags = get_the_tags();
	if($tags):
	foreach($tags as $tag):?>

		<a href="<?php echo get_tag_link($tag->term_id);?>" class="badge bg-dark">
			<?php echo $tag->name;?>
		</a>
	<?php endforeach; endif;?>


<!-- for categories --> 

	<?php
	$categories = get_the_category();
	foreach($categories as $cat):?>

		<a href="<?php echo get_category_link($cat->term_id);?>" >
			<?php echo $cat->name;?>
		</a>
	<?php endforeach;?>



<p><?php echo get_the_date('l jS F, Y');?></p>


<?php endwhile; else: endif; ?>
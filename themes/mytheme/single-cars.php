<?php get_header();?>


<section class="page-wrap">
<div class="container">

	<h3><?php the_title();?></h3>

	<?php if(has_post_thumbnail()): ?>
		<img src="<?php the_post_thumbnail_url('blog-large');?>" alt="<?php the_title();?>" class="img-fluid mb-3 img-thumbnail">
	<?php endif;?>
	
	<div class="row">
		<div class="col-lg-6">
			<?php get_template_part('includes/section', 'custompost') ?>

			<?php wp_link_pages();?>
		</div>
		<div class="col-lg-6">
			<?php get_template_part('includes/form', 'enquiry');?>
			<ul>
				<li>
					Color: <?php the_field('color');?>
				</li>
				<li>
					Registration: <?php the_field('registration');?>
			</li>
			</ul>
		</div>
	</div>
	
	
</div>
</section>
<?php get_footer();?>
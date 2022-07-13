<?php 
// Template Name: About Us

?>
<?php get_header();?>
<section class="page-wrap">
<div class="container">
	
	<h1><?php the_title();?></h1>

	<div class="row">
        <?php get_template_part('includes/section' ,'about');?>
	</div>
	
</div>
</section>
<?php get_footer();?>
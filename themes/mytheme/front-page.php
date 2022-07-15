<?php get_header();?>


<section class="page-wrap">
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<h1><?php the_title();?></h1>
		</div>
		<div class="col-lg-4">
			<?php get_search_form();?>
		</div>
	</div>

	<?php get_template_part('includes/section' ,'content');?>
	
	<?php get_template_part('includes/latest' ,'cars');?>
</div>
</section>
<?php get_footer();?>
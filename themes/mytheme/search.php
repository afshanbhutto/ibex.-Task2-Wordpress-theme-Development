 <!--it only results for search  -->
<?php get_header();?>


<section class="page-wrap">
<div class="container">

				<h1>Search Results for '<?php the_search_query(); ?>'</h1>
		
				<?php get_template_part('includes/section', 'searchresults') ?>
				
				<!-- pagination for blog posts -->
				
				<?php previous_posts_link();?>
				<!-- Implementing search functionality in website -->
				<?php next_posts_link();?>
			
</div>
</section>
<?php get_footer();?>
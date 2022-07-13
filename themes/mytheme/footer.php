
<footer>
	<div class="container footer-content">
		<?php 
		wp_nav_menu(
				array(
					'theme_location' => 'footer-menu',
					'menu_class' => 'footer-bar'
				)
		);
		?>
	</div>
</footer>


<?php wp_footer();?>

</body>
</html>
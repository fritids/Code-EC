<?php require(ghostpool_inc . 'options.php'); ?>
			
			<div class="clear"></div>
	
		</div>
		<!--End Content Wrapper-->
		
		<!--Begin Footer-->
		<div id="footer">
		
			<?php if(is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4')) { ?>
			
				<div id="footer-widgets">
					
					<?php
					if(is_active_sidebar('footer-1') && is_active_sidebar('footer-2') && is_active_sidebar('footer-3') && is_active_sidebar('footer-4')) { $footer_widgets = "footer-fourth"; }
					elseif(is_active_sidebar('footer-1') && is_active_sidebar('footer-2') && is_active_sidebar('footer-3')) { $footer_widgets = "footer-third"; }
					elseif(is_active_sidebar('footer-1') && is_active_sidebar('footer-2')) {
					$footer_widgets = "footer-half"; }	
					elseif(is_active_sidebar('footer-1')) { $footer_widgets = "footer-whole"; }
					?>
				
					<?php if(is_active_sidebar('footer-1')) { ?>
						<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
							<?php dynamic_sidebar('footer-1'); ?>
						</div>
					<?php } ?>
				
					<?php if(is_active_sidebar('footer-2')) { ?>
						<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
							<?php dynamic_sidebar('footer-2'); ?>
						</div>
					<?php } ?>
					
					<?php if(is_active_sidebar('footer-3')) { ?>
						<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
							<?php dynamic_sidebar('footer-3'); ?>
						</div>
					<?php } ?>
					
					<?php if(is_active_sidebar('footer-4')) { ?>
						<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
							<?php dynamic_sidebar('footer-4'); ?>
						</div>
					<?php } ?>
			
				</div>
				
			<?php } ?>
			
		</div>
		<!--End Footer-->
		
	</div>
	<!--End Page Inner-->	

</div>
<!--End Page Outer-->	

<?php wp_footer(); ?>

</body>
</html>
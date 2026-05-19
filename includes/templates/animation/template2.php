<div id="sqb-celebration-main-wrapper" class="animation_container" style="background-color:<?php echo $background_color ?>;">
<?php echo $audio_content; ?>
<div class="sqb-celebration-type-2">
	<div class="sqb-modal-animation">
		<span class="sqb-modal-animation-emoji">🏆</span>
		<div class="sqb-modal-animation-text">
			<?php echo $animation_text; ?>
		</div>
		<!-- <a href="#" class="sqb-modal-animation-btn">Celebrate</a> -->
	</div>
	<div id="sqb-modal-animation-confetti-wrapper"></div>
</div>
<script>
	jQuery(document).ready(function () {
		sqb_confetti_animation();
	});
</script>
</div>


<?php
/**
 * Smart Quiz Builder - GamiPress Integration
 *
 * Registers activity triggers for GamiPress based on quiz completion events.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ─── Register triggers with GamiPress ────────────────────────────────

add_filter( 'gamipress_activity_triggers', 'sqb_gamipress_activity_triggers' );

function sqb_gamipress_activity_triggers( $triggers ) {

	$triggers['Smart Quiz Builder'] = array(

		// Complete triggers
		'sqb_gamipress_complete_quiz'                      => __( 'Complete any quiz', 'smart-quiz-builder' ),
		'sqb_gamipress_complete_specific_quiz'              => __( 'Complete a specific quiz', 'smart-quiz-builder' ),
		'sqb_gamipress_complete_quiz_type'                  => __( 'Complete a quiz of a specific type', 'smart-quiz-builder' ),

		// Score range triggers
		'sqb_gamipress_complete_quiz_score_range'           => __( 'Complete any quiz within a score range', 'smart-quiz-builder' ),
		'sqb_gamipress_complete_specific_quiz_score_range'  => __( 'Complete a specific quiz within a score range', 'smart-quiz-builder' ),
		'sqb_gamipress_complete_quiz_type_score_range'      => __( 'Complete a specific type of quiz within a score range', 'smart-quiz-builder' ),

		// Minimum score triggers
		'sqb_gamipress_complete_quiz_min_score'             => __( 'Complete any quiz with a minimum score', 'smart-quiz-builder' ),
		'sqb_gamipress_complete_specific_quiz_min_score'    => __( 'Complete a specific quiz with a minimum score', 'smart-quiz-builder' ),
		'sqb_gamipress_complete_quiz_type_min_score'        => __( 'Complete a quiz of a specific type with a minimum score', 'smart-quiz-builder' ),

		// Pass triggers
		'sqb_gamipress_pass_quiz'                          => __( 'Pass any quiz', 'smart-quiz-builder' ),
		'sqb_gamipress_pass_specific_quiz'                  => __( 'Pass a specific quiz', 'smart-quiz-builder' ),
		'sqb_gamipress_pass_quiz_type'                      => __( 'Pass a quiz of a specific type', 'smart-quiz-builder' ),

		// Fail triggers
		'sqb_gamipress_fail_quiz'                          => __( 'Fail any quiz', 'smart-quiz-builder' ),
		'sqb_gamipress_fail_specific_quiz'                  => __( 'Fail a specific quiz', 'smart-quiz-builder' ),
		'sqb_gamipress_fail_quiz_type'                      => __( 'Fail a quiz of a specific type', 'smart-quiz-builder' ),
	);

	return $triggers;
}

// ─── Register specific activity triggers (triggers tied to a specific quiz) ──

add_filter( 'gamipress_specific_activity_triggers', 'sqb_gamipress_specific_activity_triggers' );

function sqb_gamipress_specific_activity_triggers( $specific_triggers ) {

	$specific_triggers['sqb_gamipress_complete_specific_quiz']             = array( 'sqb_quiz' );
	$specific_triggers['sqb_gamipress_complete_specific_quiz_score_range'] = array( 'sqb_quiz' );
	$specific_triggers['sqb_gamipress_complete_specific_quiz_min_score']   = array( 'sqb_quiz' );
	$specific_triggers['sqb_gamipress_pass_specific_quiz']                 = array( 'sqb_quiz' );
	$specific_triggers['sqb_gamipress_fail_specific_quiz']                 = array( 'sqb_quiz' );

	return $specific_triggers;
}

// ─── Specific activity trigger label ─────────────────────────────────

add_filter( 'gamipress_specific_activity_trigger_label', 'sqb_gamipress_specific_trigger_label' );

function sqb_gamipress_specific_trigger_label( $label ) {
	global $wpdb;

	$requirement_id = isset( $GLOBALS['gamipress_current_requirement_id'] ) ? $GLOBALS['gamipress_current_requirement_id'] : 0;
	if ( $requirement_id > 0 ) {
		$quiz_id = get_post_meta( $requirement_id, '_sqb_quiz_id', true );
		if ( $quiz_id ) {
			$table     = $wpdb->prefix . 'sqb_quiz';
			$quiz_name = $wpdb->get_var( $wpdb->prepare( "SELECT quiz_name FROM {$table} WHERE id = %d", $quiz_id ) );
			if ( $quiz_name ) {
				$label = str_replace( '%specific_post%', $quiz_name, $label );
			}
		}
	}

	return $label;
}

// ─── Quiz selector dropdown (from custom sqb_quiz table) ─────────────

add_action( 'gamipress_requirement_ui_html_after_achievement_post', 'sqb_gamipress_quiz_selector_ui', 10, 2 );

function sqb_gamipress_quiz_selector_ui( $requirement_id, $requirement ) {
	global $wpdb;

	$sqb_triggers = array(
		'sqb_gamipress_complete_specific_quiz',
		'sqb_gamipress_complete_specific_quiz_score_range',
		'sqb_gamipress_complete_specific_quiz_min_score',
		'sqb_gamipress_pass_specific_quiz',
		'sqb_gamipress_fail_specific_quiz',
	);

	// Read directly from post_meta — most reliable source
	$selected_quiz = get_post_meta( $requirement_id, '_sqb_quiz_id', true );

	$table = $wpdb->prefix . 'sqb_quiz';
	$quizzes = $wpdb->get_results( "SELECT id, quiz_name, quiz_type FROM {$table} ORDER BY quiz_name ASC" );

	?>
	<span class="sqb-quiz-select-wrap" data-sqb-triggers="<?php echo esc_attr( implode( ',', $sqb_triggers ) ); ?>">
		<select class="sqb-quiz-selector" style="min-width:200px">
			<option value=""><?php _e( 'Select a Quiz', 'smart-quiz-builder' ); ?></option>
			<?php if ( $quizzes ) : foreach ( $quizzes as $quiz ) : ?>
				<option value="<?php echo esc_attr( $quiz->id ); ?>" data-quiz-type="<?php echo esc_attr( $quiz->quiz_type ); ?>" <?php selected( $selected_quiz, $quiz->id ); ?>>
					<?php echo esc_html( $quiz->quiz_name ); ?> (ID:<?php echo esc_html( $quiz->id ); ?>)
				</option>
			<?php endforeach; endif; ?>
		</select>
	</span>
	<?php
}

// ─── Quiz type selector UI ──────────────────────────────────────────

add_action( 'gamipress_requirement_ui_html_after_achievement_post', 'sqb_gamipress_quiz_type_selector_ui', 10, 2 );

function sqb_gamipress_quiz_type_selector_ui( $requirement_id, $requirement ) {

	$type_triggers = array(
		'sqb_gamipress_complete_quiz_type',
		'sqb_gamipress_complete_quiz_type_score_range',
		'sqb_gamipress_complete_quiz_type_min_score',
		'sqb_gamipress_pass_quiz_type',
		'sqb_gamipress_fail_quiz_type',
	);

	// Read directly from post_meta
	$selected_type = get_post_meta( $requirement_id, '_sqb_quiz_type', true );

	// Quiz types with has_scoring flag — only scoring & assessment have points
	$quiz_types = array(
		'assessment'  => array( 'label' => __( 'Assessment', 'smart-quiz-builder' ), 'scoring' => true ),
		'scoring'     => array( 'label' => __( 'Scoring', 'smart-quiz-builder' ),    'scoring' => true ),
		'survey'      => array( 'label' => __( 'Survey', 'smart-quiz-builder' ),      'scoring' => false ),
		'personality' => array( 'label' => __( 'Personality', 'smart-quiz-builder' ), 'scoring' => false ),
		'poll'        => array( 'label' => __( 'Poll', 'smart-quiz-builder' ),        'scoring' => false ),
		'calculator'  => array( 'label' => __( 'Calculator', 'smart-quiz-builder' ), 'scoring' => false ),
		'form'        => array( 'label' => __( 'Form', 'smart-quiz-builder' ),        'scoring' => false ),
	);

	?>
	<select class="sqb-quiz-type-selector" data-sqb-triggers="<?php echo esc_attr( implode( ',', $type_triggers ) ); ?>">
		<option value=""><?php _e( 'Select a Quiz Type', 'smart-quiz-builder' ); ?></option>
		<?php foreach ( $quiz_types as $value => $info ) : ?>
			<option value="<?php echo esc_attr( $value ); ?>" data-has-scoring="<?php echo $info['scoring'] ? '1' : '0'; ?>" <?php selected( $selected_type, $value ); ?>>
				<?php echo esc_html( $info['label'] ); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<?php
}

// ─── Score range / minimum score UI fields ───────────────────────────

add_action( 'gamipress_requirement_ui_html_after_achievement_post', 'sqb_gamipress_score_fields_ui', 10, 2 );

function sqb_gamipress_score_fields_ui( $requirement_id, $requirement ) {

	$range_triggers = array(
		'sqb_gamipress_complete_quiz_score_range',
		'sqb_gamipress_complete_specific_quiz_score_range',
		'sqb_gamipress_complete_quiz_type_score_range',
	);

	$min_triggers = array(
		'sqb_gamipress_complete_quiz_min_score',
		'sqb_gamipress_complete_specific_quiz_min_score',
		'sqb_gamipress_complete_quiz_type_min_score',
	);

	// Read directly from post_meta
	$min_score = get_post_meta( $requirement_id, '_sqb_min_score', true );
	$max_score = get_post_meta( $requirement_id, '_sqb_max_score', true );

	?>
	<span class="sqb-score-range-fields" data-sqb-triggers="<?php echo esc_attr( implode( ',', $range_triggers ) ); ?>">
		<input type="number" class="sqb-min-score" value="<?php echo esc_attr( $min_score ); ?>" placeholder="<?php _e( 'Min Score %', 'smart-quiz-builder' ); ?>" min="0" max="100" step="1" style="width:100px" />
		<span> &ndash; </span>
		<input type="number" class="sqb-max-score" value="<?php echo esc_attr( $max_score ); ?>" placeholder="<?php _e( 'Max Score %', 'smart-quiz-builder' ); ?>" min="0" max="100" step="1" style="width:100px" />
		<span>%</span>
	</span>

	<span class="sqb-min-score-fields" data-sqb-triggers="<?php echo esc_attr( implode( ',', $min_triggers ) ); ?>">
		<input type="number" class="sqb-min-score-only" value="<?php echo esc_attr( $min_score ); ?>" placeholder="<?php _e( 'Min Score %', 'smart-quiz-builder' ); ?>" min="0" max="100" step="1" style="width:100px" />
		<span>%</span>
	</span>
	<?php
}

// ─── Load custom fields into requirement object ──────────────────────

add_filter( 'gamipress_requirement_object', 'sqb_gamipress_requirement_object', 10, 2 );

function sqb_gamipress_requirement_object( $requirement, $requirement_id ) {

	$requirement['sqb_quiz_id']   = get_post_meta( $requirement_id, '_sqb_quiz_id', true );
	$requirement['sqb_quiz_type'] = get_post_meta( $requirement_id, '_sqb_quiz_type', true );
	$requirement['sqb_min_score'] = get_post_meta( $requirement_id, '_sqb_min_score', true );
	$requirement['sqb_max_score'] = get_post_meta( $requirement_id, '_sqb_max_score', true );

	return $requirement;
}

// ─── Save custom fields when GamiPress updates a requirement ─────────

// Method 1: GamiPress action hook (works in some versions)
add_action( 'gamipress_ajax_update_requirement', 'sqb_gamipress_ajax_update_requirement', 10, 2 );

function sqb_gamipress_ajax_update_requirement( $requirement_id, $requirement ) {

	if ( isset( $requirement['sqb_quiz_id'] ) ) {
		update_post_meta( $requirement_id, '_sqb_quiz_id', sanitize_text_field( $requirement['sqb_quiz_id'] ) );
	}
	if ( isset( $requirement['sqb_quiz_type'] ) ) {
		update_post_meta( $requirement_id, '_sqb_quiz_type', sanitize_text_field( $requirement['sqb_quiz_type'] ) );
	}
	if ( isset( $requirement['sqb_min_score'] ) ) {
		update_post_meta( $requirement_id, '_sqb_min_score', sanitize_text_field( $requirement['sqb_min_score'] ) );
	}
	if ( isset( $requirement['sqb_max_score'] ) ) {
		update_post_meta( $requirement_id, '_sqb_max_score', sanitize_text_field( $requirement['sqb_max_score'] ) );
	}
}

// Method 2: Custom AJAX endpoint — direct save that bypasses GamiPress save system
add_action( 'wp_ajax_sqb_gamipress_save_field', 'sqb_gamipress_save_field_ajax' );

function sqb_gamipress_save_field_ajax() {

	// Verify nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'sqb_gamipress_save' ) ) {
		wp_send_json_error( 'Invalid nonce' );
	}

	$requirement_id = intval( $_POST['requirement_id'] );
	$field          = sanitize_text_field( $_POST['field'] );
	$value          = sanitize_text_field( $_POST['value'] );

	// Whitelist allowed fields
	$allowed = array( '_sqb_quiz_id', '_sqb_quiz_type', '_sqb_min_score', '_sqb_max_score' );
	if ( ! in_array( $field, $allowed ) ) {
		wp_send_json_error( 'Invalid field' );
	}

	if ( $requirement_id > 0 ) {
		update_post_meta( $requirement_id, $field, $value );
		wp_send_json_success( array( 'saved' => $field, 'value' => $value, 'requirement_id' => $requirement_id ) );
	}

	wp_send_json_error( 'Invalid requirement ID' );
}

// ─── Activity trigger label (shown in logs) ──────────────────────────

add_filter( 'gamipress_activity_trigger_label', 'sqb_gamipress_activity_trigger_label', 10, 3 );

function sqb_gamipress_activity_trigger_label( $label, $requirement_id, $requirement ) {

	global $wpdb;

	$trigger = '';
	if ( is_array( $requirement ) && isset( $requirement['trigger_type'] ) ) {
		$trigger = $requirement['trigger_type'];
	} elseif ( is_string( $requirement ) ) {
		$trigger = $requirement;
	}

	if ( empty( $trigger ) || strpos( $trigger, 'sqb_gamipress_' ) !== 0 ) {
		return $label;
	}

	$quiz_id   = get_post_meta( $requirement_id, '_sqb_quiz_id', true );
	$quiz_type = get_post_meta( $requirement_id, '_sqb_quiz_type', true );
	$min_score = get_post_meta( $requirement_id, '_sqb_min_score', true );
	$max_score = get_post_meta( $requirement_id, '_sqb_max_score', true );

	if ( $quiz_id ) {
		$table = $wpdb->prefix . 'sqb_quiz';
		$quiz_name = $wpdb->get_var( $wpdb->prepare( "SELECT quiz_name FROM {$table} WHERE id = %d", $quiz_id ) );
		if ( $quiz_name ) {
			$label .= sprintf( ' "%s"', $quiz_name );
		}
	}

	if ( $quiz_type ) {
		$label .= sprintf( ' (Type: %s)', ucfirst( $quiz_type ) );
	}

	if ( $min_score !== '' && $max_score !== '' && strpos( $trigger, 'score_range' ) !== false ) {
		$label .= sprintf( ' [Score: %s%% - %s%%]', $min_score, $max_score );
	} elseif ( $min_score !== '' && strpos( $trigger, 'min_score' ) !== false ) {
		$label .= sprintf( ' [Min Score: %s%%]', $min_score );
	}

	return $label;
}

// ─── Enqueue Select2 for quiz selector ───────────────────────────────

add_action( 'admin_enqueue_scripts', 'sqb_gamipress_enqueue_select2' );

function sqb_gamipress_enqueue_select2() {
	$screen = get_current_screen();
	if ( ! $screen || empty( $screen->post_type ) ) return;

	wp_enqueue_style( 'sqb-select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0' );
	wp_enqueue_script( 'sqb-select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ), '4.1.0', true );

	// Custom CSS to match the native WP admin select next to it
	wp_add_inline_style( 'sqb-select2-css', '
		.sqb-quiz-select-wrap { display: inline-block; vertical-align: middle; }
		.sqb-quiz-select-wrap .select2-container { vertical-align: middle; }
		.sqb-quiz-select-wrap .select2-container--default .select2-selection--single {
			height: 32px;
			border: 1px solid #8c8f94;
			border-radius: 4px;
			background-color: #fff;
			padding: 0 4px;
		}
		.sqb-quiz-select-wrap .select2-container--default .select2-selection--single .select2-selection__rendered {
			line-height: 30px;
			padding-left: 6px;
			padding-right: 26px;
			color: #2c3338;
			font-size: 14px;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		}
		.sqb-quiz-select-wrap .select2-container--default .select2-selection--single .select2-selection__arrow {
			height: 30px;
			right: 4px;
		}
		.sqb-quiz-select-wrap .select2-container--default .select2-selection--single .select2-selection__placeholder {
			color: #50575e;
		}
		.sqb-quiz-select-wrap .select2-container--default .select2-selection--single .select2-selection__clear {
			margin-right: 4px;
			font-size: 16px;
			font-weight: normal;
		}
		.sqb-quiz-select-wrap .select2-container--default.select2-container--focus .select2-selection--single,
		.sqb-quiz-select-wrap .select2-container--default.select2-container--open .select2-selection--single {
			border-color: #2271b1;
			box-shadow: 0 0 0 1px #2271b1;
			outline: none;
		}
		.select2-container--default .select2-results__option--disabled {
			display: none;
		}
	');
}

// ─── Admin JS ────────────────────────────────────────────────────────

add_action( 'admin_footer', 'sqb_gamipress_admin_js' );

function sqb_gamipress_admin_js() {

	$screen = get_current_screen();
	if ( ! $screen ) return;

	// Check if we're on any GamiPress-related admin page
	$dominated = false;

	if ( ! empty( $screen->id ) && strpos( $screen->id, 'gamipress' ) !== false ) {
		$dominated = true;
	}

	if ( ! empty( $screen->post_type ) ) {
		// Check using GamiPress helper functions if available
		$all_types = array();

		if ( function_exists( 'gamipress_get_points_types_slugs' ) ) {
			$all_types = array_merge( $all_types, gamipress_get_points_types_slugs() );
		}
		if ( function_exists( 'gamipress_get_achievement_types_slugs' ) ) {
			$all_types = array_merge( $all_types, gamipress_get_achievement_types_slugs() );
		}
		if ( function_exists( 'gamipress_get_rank_types_slugs' ) ) {
			$all_types = array_merge( $all_types, gamipress_get_rank_types_slugs() );
		}

		// Fallback: check if post type is registered by GamiPress
		if ( empty( $all_types ) ) {
			$post_type_obj = get_post_type_object( $screen->post_type );
			if ( $post_type_obj && isset( $post_type_obj->gamipress ) ) {
				$dominated = true;
			}
		}

		if ( in_array( $screen->post_type, $all_types ) ) {
			$dominated = true;
		}
	}

	// Broad fallback: load on any post edit screen when GamiPress is active
	if ( ! $dominated && ! empty( $screen->post_type ) ) {
		$dominated = true;
	}

	if ( ! $dominated ) {
		return;
	}

	?>
	<script type="text/javascript">
	(function($){

		var sqb_ajax_url = '<?php echo esc_js( admin_url( "admin-ajax.php" ) ); ?>';
		var sqb_nonce    = '<?php echo esc_js( wp_create_nonce( "sqb_gamipress_save" ) ); ?>';

		// Direct AJAX save — saves field immediately on change
		function sqb_direct_save( requirement_id, field, value ) {
			if( ! requirement_id || parseInt(requirement_id) <= 0 ) {
				return;
			}
			$.post( sqb_ajax_url, {
				action: 'sqb_gamipress_save_field',
				nonce: sqb_nonce,
				requirement_id: requirement_id,
				field: field,
				value: value
			});
		}

		// Get requirement ID from the closest row element
		function sqb_get_requirement_id( $row ) {
			if( !$row || !$row.length ) return 0;
			// data-requirement-id attribute
			var id = $row.attr('data-requirement-id');
			if( id && parseInt(id) > 0 ) return id;
			// hidden input variations used by different GamiPress versions
			var selectors = [
				'input[name="requirement_id"]',
				'input[name="post_id"]',
				'input.requirement-id',
				'input[name="requirement-id"]',
				'input[name="step_id"]',
				'input[name="award_id"]',
				'input[name="deduct_id"]',
				'input[name="rank_requirement_id"]'
			];
			for(var i = 0; i < selectors.length; i++){
				var $input = $row.find(selectors[i]);
				if( $input.length && parseInt($input.val()) > 0 ) return $input.val();
			}
			// Parse from li id attribute (e.g. "step-123", "points-award-123")
			var rowId = $row.attr('id') || '';
			var match = rowId.match(/(\d+)$/);
			if( match && parseInt(match[1]) > 0 ) return match[1];
			return 0;
		}

		// Triggers that require scoring quiz types only
		var sqb_scoring_triggers = [
			'sqb_gamipress_complete_quiz_score_range',
			'sqb_gamipress_complete_specific_quiz_score_range',
			'sqb_gamipress_complete_quiz_type_score_range',
			'sqb_gamipress_complete_quiz_min_score',
			'sqb_gamipress_complete_specific_quiz_min_score',
			'sqb_gamipress_complete_quiz_type_min_score',
			'sqb_gamipress_pass_quiz',
			'sqb_gamipress_pass_specific_quiz',
			'sqb_gamipress_pass_quiz_type',
			'sqb_gamipress_fail_quiz',
			'sqb_gamipress_fail_specific_quiz',
			'sqb_gamipress_fail_quiz_type'
		];
		// Scoring quiz types
		var sqb_scoring_quiz_types = ['scoring', 'assessment'];

		// Initialize Select2 on a quiz selector
		function sqb_init_select2( $select ) {
			if( !$select.length || !$.fn.select2 ) return;
			// Destroy existing Select2 instance if any
			if( $select.hasClass('select2-hidden-accessible') ){
				$select.select2('destroy');
			}
			$select.select2({
				placeholder: 'Select a Quiz',
				allowClear: true,
				width: '300px'
			});
		}

		// Show/hide SQB fields based on selected trigger type
		function sqb_toggle_fields( container ) {
			var $el = $(container);
			var trigger = $el.find('.select-trigger-type').val() || '';
			var needsScoring = (sqb_scoring_triggers.indexOf(trigger) !== -1);

			// Show/hide wrapper elements (sqb-quiz-select-wrap contains Select2 + original select)
			$el.find('.sqb-quiz-select-wrap, .sqb-quiz-type-selector, .sqb-score-range-fields, .sqb-min-score-fields').each(function(){
				var triggers = $(this).data('sqb-triggers');
				if(!triggers) return;
				var triggerList = triggers.split(',');
				$(this).toggle( triggerList.indexOf(trigger) !== -1 );
			});

			// Filter quiz dropdown — disable non-scoring quizzes for score/pass/fail triggers
			var $quizSelect = $el.find('.sqb-quiz-selector');
			var quizResetNeeded = false;
			$quizSelect.find('option').each(function(){
				var quizType = $(this).data('quiz-type');
				if(!quizType) return; // skip placeholder
				if(needsScoring && sqb_scoring_quiz_types.indexOf(quizType) === -1){
					$(this).prop('disabled', true);
					if($(this).is(':selected')){
						quizResetNeeded = true;
					}
				} else {
					$(this).prop('disabled', false);
				}
			});
			if(quizResetNeeded){
				$quizSelect.val('');
			}
			// Reinit Select2 to reflect filtered options
			sqb_init_select2( $quizSelect );

			// Filter quiz type dropdown — hide non-scoring types for score/pass/fail triggers
			var typeResetNeeded = false;
			$el.find('.sqb-quiz-type-selector option').each(function(){
				var hasScoring = $(this).data('has-scoring');
				if(typeof hasScoring === 'undefined') return; // skip placeholder
				if(needsScoring && hasScoring != 1){
					$(this).prop('disabled', true).hide();
					if($(this).is(':selected')){
						typeResetNeeded = true;
					}
				} else {
					$(this).prop('disabled', false).show();
				}
			});
			if(typeResetNeeded){
				$el.find('.sqb-quiz-type-selector').val('');
			}
		}

		// Find closest requirement row
		function sqb_find_row( el ) {
			var $row = $(el).closest('li[data-requirement-id]');
			if ( $row.length ) return $row;
			$row = $(el).closest('.requirement-row, .step-row, .points-award-row, .points-deduct-row, .rank-requirement-row, .award-row, .deduct-row');
			if ( $row.length ) return $row;
			return $(el).closest('li');
		}

		// Trigger type changed — toggle field visibility
		$(document).on('change', '.select-trigger-type', function(){
			sqb_toggle_fields( sqb_find_row(this) );
		});

		// Save on change for each SQB field (Select2 fires 'change' on the original select)
		$(document).on('change', '.sqb-quiz-selector', function(){
			sqb_direct_save( sqb_get_requirement_id(sqb_find_row(this)), '_sqb_quiz_id', $(this).val() || '' );
		});
		$(document).on('change', '.sqb-quiz-type-selector', function(){
			sqb_direct_save( sqb_get_requirement_id(sqb_find_row(this)), '_sqb_quiz_type', $(this).val() || '' );
		});
		$(document).on('change input', '.sqb-min-score, .sqb-min-score-only', function(){
			sqb_direct_save( sqb_get_requirement_id(sqb_find_row(this)), '_sqb_min_score', $(this).val() || '' );
		});
		$(document).on('change input', '.sqb-max-score', function(){
			sqb_direct_save( sqb_get_requirement_id(sqb_find_row(this)), '_sqb_max_score', $(this).val() || '' );
		});

		// Init: toggle fields on all rows and init Select2
		function sqb_init_all_rows() {
			$('.select-trigger-type').each(function(){
				sqb_toggle_fields( sqb_find_row(this) );
			});
		}

		$(document).on('gamipress_requirement_ui_html_after', sqb_init_all_rows);
		$(function(){
			// Wait for Select2 to be loaded before initializing
			function sqb_wait_and_init() {
				if( $.fn.select2 ) {
					sqb_init_all_rows();
				} else {
					setTimeout( sqb_wait_and_init, 200 );
				}
			}
			sqb_wait_and_init();
			setTimeout( sqb_init_all_rows, 1500 );
		});

		// Backup: also inject into GamiPress save data
		$(document).on('update_requirement_data', function( e, requirement_details ){
			var $row = $(e.target);
			requirement_details.sqb_quiz_id   = $row.find('select.sqb-quiz-selector').val() || '';
			requirement_details.sqb_quiz_type = $row.find('select.sqb-quiz-type-selector').val() || '';
			// Use visible min-score field only — range and min-only fields share the same meta key
			var $visibleMin = $row.find('.sqb-min-score-fields:visible .sqb-min-score-only');
			var $visibleRangeMin = $row.find('.sqb-score-range-fields:visible .sqb-min-score');
			if( $visibleMin.length ) {
				requirement_details.sqb_min_score = $visibleMin.val() || '';
			} else if( $visibleRangeMin.length ) {
				requirement_details.sqb_min_score = $visibleRangeMin.val() || '';
			} else {
				requirement_details.sqb_min_score = $row.find('.sqb-min-score-only').val() || $row.find('.sqb-min-score').val() || '';
			}
			requirement_details.sqb_max_score = $row.find('.sqb-max-score').val() || '';
		});

	})(jQuery);
	</script>
	<?php
}

<?php
/*
Plugin Name: Ad Rotator
Description: Like the Text widget, but it will take several chunks of HTML text separated with &lt;!&#45;&#45;more&#45;&#45;&gt;. In each page request new chunk will be displayed. Up to 9 instances of this widget may exist. Heavily derived from the Text widget code included with the widget plugin by Automattic, Inc.
Plugin URI: http://kpumuk.info/projects/wordpress-plugins/ad-rotator/
Author: Kpumuk
Version: 1.0.1
Author URI: http://kpumuk.info
*/

function widget_adrotator_init()
{
	// Check for the required API functions
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;

	function widget_adrotator($args, $number = 1) {
		extract($args);
		$options = get_option('widget_adrotator');
		$title = $options[$number]['title'];
		$text = $options[$number]['text'];
    $chunks = explode('<!--more-->', $text);
    $chunkno = mt_rand(0, sizeof($chunks) - 1);
	?>
			<?php echo $before_widget; ?>
				<?php $title ? print($before_title . __($title) . $after_title) : null; ?>
				<div class="adrotatorwidget"><?php echo $chunks[$chunkno] ?></div>
			<?php echo $after_widget; ?>
	<?php
	}
	
	function widget_adrotator_control($number) {
		$options = $newoptions = get_option('widget_adrotator');
		if ( $_POST["adrotator-submit-$number"] ) {
			$newoptions[$number]['title'] = strip_tags(stripslashes($_POST["adrotator-title-$number"]));
			$newoptions[$number]['text'] = stripslashes($_POST["adrotator-text-$number"]);
			if ( !current_user_can('unfiltered_html') )
				$newoptions[$number]['text'] = stripslashes(wp_filter_post_kses($newoptions[$number]['text']));
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('widget_adrotator', $options);
		}
		$title = htmlspecialchars($options[$number]['title'], ENT_QUOTES);
		$text = htmlspecialchars($options[$number]['text'], ENT_QUOTES);
	?>
				<input style="width: 450px;" id="adrotator-title-<?php echo "$number"; ?>" name="adrotator-title-<?php echo "$number"; ?>" type="text" value="<?php echo $title; ?>" />
				<p>Text (chunks are separated with &lt;!--more--&gt;):</p>
				<textarea style="width: 450px; height: 230px;" id="adrotator-text-<?php echo "$number"; ?>" name="adrotator-text-<?php echo "$number"; ?>"><?php echo $text; ?></textarea>
				<input type="hidden" id="adrotator-submit-<?php echo "$number"; ?>" name="adrotator-submit-<?php echo "$number"; ?>" value="1" />
	<?php
	}
	
	function widget_adrotator_setup() {
		$options = $newoptions = get_option('widget_adrotator');
		if ( isset($_POST['adrotator-number-submit']) ) {
			$number = (int) $_POST['adrotator-number'];
			if ( $number > 9 ) $number = 9;
			if ( $number < 1 ) $number = 1;
			$newoptions['number'] = $number;
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('widget_adrotator', $options);
			widget_adrotator_register($options['number']);
		}
	}
	
	function widget_adrotator_page() {
		$options = $newoptions = get_option('widget_adrotator');
	?>
		<div class="wrap">
			<form method="POST">
				<h2>Ad Rotator widgets</h2>
				<p style="line-height: 30px;"><?php _e('How many Ad Rotator widgets would you like?'); ?>
				<select id="adrotator-number" name="adrotator-number" value="<?php echo $options['number']; ?>">
	<?php for ( $i = 1; $i < 10; ++$i ) echo "<option value='$i' ".($options['number']==$i ? "selected='selected'" : '').">$i</option>"; ?>
				</select>
				<span class="submit"><input type="submit" name="adrotator-number-submit" id="adrotator-number-submit" value="<?php _e('Save'); ?>" /></span></p>
			</form>
		</div>
	<?php
	}
	
	function widget_adrotator_register() {
		$options = get_option('widget_adrotator');
		$number = $options['number'];
		if ( $number < 1 ) $number = 1;
		if ( $number > 9 ) $number = 9;
		for ($i = 1; $i <= 9; $i++) {
			$name = array('Ad Rotator %s', null, $i);
			register_sidebar_widget($name, $i <= $number ? 'widget_adrotator' : /* unregister */ '', $i);
			register_widget_control($name, $i <= $number ? 'widget_adrotator_control' : /* unregister */ '', 460, 350, $i);
		}
		add_action('sidebar_admin_setup', 'widget_adrotator_setup');
		add_action('sidebar_admin_page', 'widget_adrotator_page');
	}
	// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
	widget_adrotator_register();
}

	
// Tell Dynamic Sidebar about our new widget and its control
add_action('plugins_loaded', 'widget_adrotator_init');

?>
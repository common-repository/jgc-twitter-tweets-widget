<?php
/**
 * Widget to display Twitter Timeline.
 *
 * Author: GalussoThemes
 * Author URI: https://galussothemes.com
 */

function jgcwtt_sanitize_height_field( $input ) {

	$output = ( is_numeric( $input ) && $input >= 200 && $input <= 1000 ) ? round( $input ) : 450;

	return $output;
}

// Register widget.
add_action( 'widgets_init', 'jgcwtt_twitter_tweets' );
function jgcwtt_twitter_tweets() {

	register_widget( 'Jgcwtt_Widget_Twitter_Tweets' );

}

// Widget.
class Jgcwtt_Widget_Twitter_Tweets extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname'   => 'Jgcwtt_Widget_Twitter_Tweets',
			'description' => __( 'Display Twitter Timeline.', 'jgc-twitter-tweets-widget' ),
		);

		parent::__construct( 'Jgcwtt_Widget_Twitter_Tweets', __( '(JGC) Twitter Tweets Widget', 'jgc-twitter-tweets-widget' ), $widget_ops );
	}

	public function form( $instance ) {

		$defaults = array(
			'title'      => '',
			'href'       => 'https://twitter.com/galussothemes',
			'theme'      => 'light',
			'height'     => '450',
			'link_color' => '#3B94D9',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title       = $instance ['title'];
		$href        = $instance ['href'];
		$theme       = $instance ['theme'];
		$height      = $instance ['height'];
		$link_color  = $instance ['link_color'];
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'jgc-twitter-tweets-widget' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'href' ); ?>"><?php esc_html_e( 'Twitter URL', 'jgc-twitter-tweets-widget' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'href' ); ?>" name="<?php echo $this->get_field_name( 'href' ); ?>" type="text" value="<?php echo esc_attr( $href ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'theme' ); ?>"><?php esc_html_e( 'Theme', 'jgc-twitter-tweets-widget' ); ?></label>
		<select
		id="<?php echo $this->get_field_id( 'theme' ); ?>"
		name="<?php echo $this->get_field_name( 'theme' ); ?>">
			<option value="light" <?php echo selected( $theme, 'light', false ); ?>><?php _e( 'Light', 'jgc-twitter-tweets-widget' ); ?></option>
			<option value="dark" <?php echo selected( $theme, 'dark', false ); ?>><?php _e( 'Dark', 'jgc-twitter-tweets-widget' ); ?></option>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php esc_html_e( 'Height', 'jgc-twitter-tweets-widget' ); ?> (200px - 1000px)</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="number" min="200" max="1000" step="2" value="<?php echo esc_attr( $height ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'link_color' ); ?>"><?php _e( 'Link Color', 'jgc-twitter-tweets-widget' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'link_color' ); ?>" name="<?php echo $this->get_field_name( 'link_color' ); ?>"
		type="text" value="<?php echo esc_attr( $link_color ); ?>" class="widefat" />
		</p>

		<p><a style="font-style: italic; color:#919191; text-decoration: none;" href="https://galussothemes.com/wordpress-themes" target="_blank"><?php esc_html_e( 'Take a look to our Themes', 'jgc-twitter-tweets-widget' ); ?> &raquo;</a></p><hr>

	<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']       = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['href']        = ! empty( $new_instance['href'] ) ? esc_url( $new_instance['href'] ) : 'https://twitter.com/galussothemes';
		$instance['theme']       = ! empty( $new_instance['theme'] ) ? strip_tags( $new_instance['theme'] ) : 'light';
		$instance['height']      = ! empty( $new_instance['height'] ) ? jgcwtt_sanitize_height_field( $new_instance['height'] ) : '450';
		$instance['link_color']  = ! empty( $new_instance['link_color'] ) ? sanitize_text_field( $new_instance['link_color'] ) : '#3B94D9';

		return $instance;
	}

	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		echo $args['before_widget'];

		$title       = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$href        = ! empty( $instance['href'] ) ? esc_url( $instance['href'] ) : 'https://twitter.com/galussothemes';
		$theme       = ! empty( $instance['theme'] ) ? $instance['theme'] : '';
		$height      = ! empty( $instance['height'] ) ? $instance['height'] : '400';
		$link_color  = ! empty( $instance['link_color'] ) ? $instance['link_color'] : '#3B94D9';

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		?>

		<a class="twitter-timeline" data-height="<?php echo $height; ?>" data-theme="<?php echo $theme; ?>" data-link-color="<?php echo $link_color; ?>" href="<?php echo $href; ?>"></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

		<?php

		echo $args['after_widget'];
	}

}

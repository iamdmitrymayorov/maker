<?php
/**
 * Customize for textarea, extend the WP customizer.
 *
 * @package Maker
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Extends the Customizer with the textarea control.
 */
class Textarea_Custom_Control extends WP_Customize_Control {
	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
				<?php echo esc_textarea( $this->value() ); ?>
			</textarea>
			<?php if ( $this->description ) : ?>
				<p class="description"><?php echo esc_html( $this->description ); ?></p>
			<?php endif; ?>
		</label>
		<?php
	}
}

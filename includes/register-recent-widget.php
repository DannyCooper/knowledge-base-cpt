<?php
/**
 * Build Articles Widget.
 *
 * @package     knowledge-base-cpt
 * @copyright   Copyright (c) 2015, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Adds Knowledge Base Articles widget.
 */
class Ot_Knowledge_Articles_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {

		$id_base        = 'ot_knowledge_articles_widget';
		$name           = esc_html__( 'Knowledge Base Articles', 'ot-knowledge' );
		$widget_options = array(
			'description'                 => esc_html__( 'Displays the most recent articles.', 'ot-knowledge' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( $id_base, $name, $widget_options );

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		global $post;

		$title            = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts' );
		$number           = ( ! empty( $instance['number'] ) ) ? $instance['number'] : 5;
		$section_checkbox = ( ! empty( $instance['section_checkbox'] ) ) ? $instance['section_checkbox'] : '';

		echo $args['before_widget']; // WPCS: XSS ok.

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title']; // WPCS: XSS ok.
		}

		$query_args = array(
			'posts_per_page' => absint( $number ),
			'post_status'    => 'publish',
			'post_type'      => 'knowledge_base',
		);

		if ( is_single() ) {
			$post_id[] = $post->ID;
			$query_args['post__not_in'] = $post_id;
		}

		$terms = get_the_terms( $post->ID, 'section' );

		if ( $terms && 1 === $section_checkbox ) {

			$section_terms = array();

			foreach ( $terms as $term ) {
				$section_terms[] = $term->slug;
			}

			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'section',
					'field'    => 'slug',
					'terms'    => $section_terms,
				),
			);
		}

		$ot_query = new WP_Query( $query_args );

		if ( $ot_query->have_posts() ) :

			while ( $ot_query->have_posts() ) :
				$ot_query->the_post();
				?>

				<li class="widget-article">
					<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
				</li>

				<?php
			endwhile;

		else :

			echo '<p>' . esc_html__( 'No articles found.', 'ot-knowledge' ) . '</p>';

		endif;

		$ot_query->reset_postdata();

		echo $args['after_widget']; // WPCS: XSS ok.

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title            = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Latest Articles', 'ot-knowledge' );
		$number           = ! empty( $instance['number'] ) ? $instance['number'] : 5;
		$section_checkbox = ! empty( $instance['section_checkbox'] ) ? $instance['section_checkbox'] : '';
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_attr_e( 'Title:', 'ot-knowledge' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of articles to show:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint( $number ); ?>" size="3" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'section_checkbox' ); ?>" name="<?php echo $this->get_field_name( 'section_checkbox' ); ?>" type="checkbox" value="1" <?php checked( '1', $section_checkbox ); ?> />
			<label for="<?php echo $this->get_field_id( 'section_checkbox' ); ?>">
				<?php _e( 'Show only articles from current section? <a href="https://wordpress.org/plugins/knowledge-base-cpt/faq/" target=_blank>(learn more)</a>', 'ot-knowledge' ); ?>
			</label>
		</p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                     = array();
		$instance['title']            = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['number']           = ( ! empty( $new_instance['number'] ) ) ? absint( $new_instance['number'] ) : '5';
		$instance['section_checkbox'] = ( ! empty( $new_instance['section_checkbox'] ) ) ? absint( $new_instance['section_checkbox'] ) : '';
		return $instance;
	}

}

/**
 * Register articles widget on widgets_init.
 */
function register_ot_knowledge_articles_widget() {
	register_widget( 'Ot_Knowledge_Articles_Widget' );
}
add_action( 'widgets_init', 'register_ot_knowledge_articles_widget' );

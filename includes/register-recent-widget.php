<?php
/**
 * Build Articles Widget.
 *
 * @package     knowledge-base-cpt
 * @copyright   Copyright (c) 2015, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

/**
 * Adds Knowledge Base Articles widget.
 */
class Ot_Knowledge_Articles_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ot_knowledge_articles_widget',
			__( 'Knowledge Base Articles', 'ot-knowledge' ),
			array( 'description' => __( 'Displays the most recent articles.', 'ot-knowledge' ) )
		);
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

			extract( $args );

			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

			echo $before_widget;

		if ( ! empty( $instance['title'] ) ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'] ). $after_title;
		}

			 $ot_query = new WP_Query( array( 'posts_per_page' => 5, 'post_status' => 'publish', 'post_type' => 'knowledge_base' ) );

		if ( $ot_query->have_posts() ) :

			while ( $ot_query->have_posts() ) : $ot_query->the_post(); ?>
                    <li class="widget-article">
						<a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) { the_title();
} else { the_ID(); } ?></a>
                    </li>
                
				<?php endwhile;

			endif;

			$ot_query->reset_postdata();

			echo $after_widget;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Latest Articles', 'ot-knowledge' );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		?>

        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of articles to show:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
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
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? absint( $new_instance['number'] ) : '5';

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

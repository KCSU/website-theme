<?php
/**
 * KCSU website widgets
 *
 * @package KCSU
 * @file custom_widgets.php
 * @author Conor Burgess <Burgess.Conor@gmail.com>
 * @license BSD 3-Clause
 *
 */
    
    /**
     * Adds Events widget.
     */
    class KCSU_Events_Widget extends WP_Widget {

        /**
         * Register widget with WordPress.
         */
        function __construct()
        {
            parent::__construct(
                'kcsu_events_widget', // Base ID
                'Coming Up', // Name
                array( 'description' => 'KCSU Events Widget', ) // Args
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
        public function widget( $args, $instance )
        {
            ?>
                <!-- Events -->
                <div id="EventsColumn">
                    <h2>Coming Up</h2>
                    <ul class="posts-list events">
            <?php
                $events = kcsu_get_upcoming_events(date('Ymd', strtotime($instance['timelimit'])));
                
                foreach ($events as $event)
                {
                    echo string_format(
                                       '<li><!-- {id} --><a href="{link}" title="{title}">{title}</a> <span class="aux date">{date}</span><span class="aux"> - </span><span class="aux location">{location}</span></li>',
                                       $event
                                       );
                }
            ?>
                    </ul>
                </div>
            <?php
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form( $instance ) {
            $timelimit = !empty( $instance['timelimit'] ) ? $instance['timelimit'] : '+2 months';
            ?>
            <p>
            <label for="<?php echo $this->get_field_id( 'timelimit' ); ?>">Time Limit:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'timelimit' ); ?>" name="<?php echo $this->get_field_name( 'timelimit' ); ?>" type="text" value="<?php echo esc_attr( $timelimit ); ?>">
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
            $instance['timelimit'] = ( ! empty( $new_instance['timelimit'] ) ) ? strip_tags( $new_instance['timelimit'] ) : '+2 months';
            
            return $instance;
        }

    } // class KCSU_Events_Widget
    
    function kcsu_register_widgets()
    {
        register_widget('KCSU_Events_Widget');
    }
    add_action( 'widgets_init', 'kcsu_register_widgets' );
?>
<?php
/**
 * Widget Product for font home page
 */
class SShop_Widget_Products extends SShop_Widget_Base {

    public $layout = 1;
    public $tax = 'product_cat';
    public $post_type = 'product';

    public function __construct() {
        parent::__construct(
            'sshop_products',
            esc_html__( 'FRONT PAGE: Products', 'sshop' ),
            array(
                'description'   => esc_html__( 'Display products, recommended for front page', 'sshop' )
            )
        );
    }

    function get_configs( ){
        $fields = array(
            array(
                'type' =>'text',
                'name' => 'title',
                'label' => esc_html__( 'Title', 'sshop' ),
            ),

            array(
                'type' =>'text',
                'name' => 'number',
                'default' => 4,
                'label' => esc_html__( 'No. of products', 'sshop' ),
            ),

            array(
                'type' =>'text',
                'name' => 'layout',
                'default' => 4,
                'label' => esc_html__( 'Items per row', 'sshop' ),
            ),

            array(
                'type' =>'select',
                'name' => 'show',
                'options' => array(
                    'all'         => esc_html__( 'All products', 'sshop' ),
                    'featured' => esc_html__( 'Featured products', 'sshop' ),
                    'onsale'   => esc_html__( 'On-sale products', 'sshop' ),
                ),
                'label' => esc_html__( 'Show', 'sshop' ),
            ),

            array(
                'type' =>'select',
                'name' => 'order',
                'options' => array(
                    'date'   => esc_html__( 'Date', 'sshop' ),
                    'price'  => esc_html__( 'Price', 'sshop' ),
                    'rand'   => esc_html__( 'Random', 'sshop' ),
                    'sales'  => esc_html__( 'Sales', 'sshop' ),
                ),
                'label' => esc_html__( 'Order', 'sshop' ),
            ),

            array(
                'type' =>'orderby',
                'name' => 'orderby',
                'label' => esc_html__( 'Order by', 'sshop' ),
            ),

        );

        return $fields;

    }


    public function widget( $args, $instance )
    {

        if ( ! isset( $instance['__setup_data'] ) || ! $instance['__setup_data'] === false ){
            $instance = $this->setup_instance( $instance );
        }

        $title = $instance['title'];
        unset($instance['title']);

        echo $args['before_widget'];
        $title = apply_filters( 'widget_title', $title );

        $query = $this->get_products( $instance );

        if ( $title ) {
            echo $args['before_title'].$title.$args['after_title'];
        }

        $col = $instance['layout'];
        if ( ! $col || $col > 12 ) {
            $col = 5;
        }
        ?>
        <div class="grid-products">
            <ul class="products eq-row-col-<?php echo esc_attr( $col ); ?>">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    wc_get_template_part('content', 'product');
                }
                wp_reset_postdata();
                ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }


}
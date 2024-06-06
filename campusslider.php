<?php
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

//if (!defined('ABSPMXMH')) exit; // Exit if accessed directly
class ATCampusSliderAddon extends \Elementor\Widget_Base
{

    public function __construct($data = array() , $args = null)
    {
        parent::__construct($data, $args);

    }

    /**
     * Get widget name.
     *
     * Retrieve ATCampusSliderAddon widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'ATCampusSliderAddon';
    }

    /**
     * Get widget title.
     *
     * Retrieve ATCampusSliderAddon widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('AT Campus Slider', 'mxm-customization');
    }

    /**
     * Get widget icon.
     *
     * Retrieve ATCampusSliderAddon widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-posts-carousel';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the ATCampusSliderAddon widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['theme-elements-archive'];
    }

    /**
     * Register MXMPostCarouselAddon widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        

        $this->start_controls_section('content_section', ['label' => __('Campus Tab') , 'tab' => \Elementor\Controls_Manager::TAB_CONTENT, ]);
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'campus_title',
            [
                'label' => esc_html__( 'Title', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Title' , 'textdomain' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'campus_image',
            [
                'label' => esc_html__( 'Image', 'atu' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'campus_url',
            [
                'label' => esc_html__( 'Link', 'atu' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://www.iihtsalem.edu.in/', 'atu' ),
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'campus_list',
            [
                'label' => esc_html__( 'Campus List', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ campus_title }}}',
                'show_label'=>false,
                'separator' => 'after',
                'prevent_empty'=> true
            ]
        );

        
        $this->end_controls_section();

    }

    /**
     * Render MXMPostCarouselAddon widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render()
    {

        nocache_headers();
        $settings = $this->get_settings_for_display();
        $html = '';
        ob_start();  
        
        if ( $settings['campus_list'] ) {  
        ?>
        <div class="slider-container">
            <div class="carousel-accordion owl-carousel">
                <!--   if you add more than 5 slides, then they active carousel navigations -->
                <?php 
                $c = 01;
                foreach($settings['campus_list'] as $campus_list){ 
                    if($campus_list['campus_url']['is_external'] == 1){
                        $linktype = '_blank';
                    } else {
                        $linktype = '_self';
                    }

                ?>
                <div class="accordion_li">
                    <a href="<?php echo $campus_list['campus_url']['url']; ?>" target="<?php echo $linktype; ?>">
                        <div class="bg-image">
                            <img src="<?php echo $campus_list['campus_image']['url']; ?>" class="accordion_img" alt="<?php echo $campus_list['campus_image']['alt']; ?>">
                        </div>
                        <div class="pv-content">
                            <p><span><?php echo $c; ?></span> <?php echo $campus_list['campus_title']; ?></p>
                        </div>
                    </a>
                </div>
                <?php $c++; } ?>
            </div>
        </div>
        <?php 
        }
        $html = ob_get_contents();
        ob_end_clean();
        echo '<div class="ATCampusSliderAddon-elementor-widget">';
        echo ($html) ? $html : '';
        echo '</div>';
    }

}


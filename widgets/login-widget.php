<?php
if (!defined('ABSPATH')) {
    exit;
}

class login_Widget extends \Elementor\Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

		wp_register_style('login-style', plugin_dir_url(__FILE__) . '../assets/login-css/custom_login_style.css');

    }
    public function get_style_depends()
    {
        return ['login-style'];
    }
    public function get_name()
    {
        return 'login_widget';
    }

    public function get_title()
    {
        return __('Login Widget', 'login-widget');
    }

    public function get_icon()
    {
        return 'eicon-lock-user';
    }

    public function get_categories()
    {
        return ['general', 'First Category'];
    }

    public function get_keywords()
    {
        return ['login', 'form', 'custom'];
    }
    protected function _register_controls()
    {
        $this->start_controls_section(
            'register_controls_section',
            [
                'label' => __('Editing', 'login-widget'),
            ]
        );
        $this->add_control(
			'log_image',
			[
				'label' => __('Login Image', 'login-widget'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					 'url' => "https://imgs.search.brave.com/39ZmUJDZJ7B5yJAXCNdYL32eUq4C2W2JKIm9nIuxH_Y/rs:fit:820:942:1/g:ce/aHR0cHM6Ly93d3cu/c2Vla3BuZy5jb20v/cG5nL2RldGFpbC8x/MTUtMTE1MDA1M19h/dmF0YXItcG5nLnBu/Zw"
				],
			]
		);
        $this->add_control(
			'color',
			[
				'label' => esc_html__( 'Color of heading', 'login-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} p' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
            'text-color',
            [
                'label' => esc_html__( 'Button Text Color', 'login-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'antiquewhite',
                'selectors' => [
                    '{{WRAPPER}} .submit' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'background-color',
            [
                'label' => esc_html__( 'Button Background Color', 'login-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2e7aff',
                'selectors' => [
                    '{{WRAPPER}} .submit' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();    
                    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $log_image = $settings['log_image']['url'];      
        ?>
        <div class="container">
            <div class="Main">
                <!-- Login Form -->
               
                <form method="post">
                <img src="<?php echo $log_image; ?>" class="logimg" alt="Customer Image"><br>
                  
                    <p style="text-align:center; font-size:30px">LOGIN</p>
                    <input class="logsize" type="text" name="login_username" placeholder="Phone number, username, or email"
                        value="">
                    <input class="logsize" type="password" name="login_password" placeholder="Password" value="">
                    <br><br>
                    <input class="submit" type="submit" name="login_submit" value="Log in"><br>
    
                </form>
            </div>
        </div>
        <?php
    } 
                  
                
}
<?php
if (!defined('ABSPATH')) {
	exit;
}
class Card_Widget extends \Elementor\Widget_Base
{
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		wp_register_style('card-style', plugin_dir_url(__FILE__) . '../assets/card-css/custom_card_style.css');
	}
	public function get_style_depends()
	{
		return ['card-style'];
	}
	public function get_name()
	{
		return 'custom_card';
	}
	public function get_title()
	{
		return esc_html__('Custom Card', 'elementor-custom-widget');
	}
	public function get_icon()
	{
		return 'eicon-cart-solid';
	}
	public function get_categories()
	{
		return ['general'];
	}
	public function get_keywords()
	{
		return ['card', 'widget', 'custom'];
	}
	protected function register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'elementor-custom-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'date_time',
			[
				'label' => esc_html__('Date-Time', 'elementor-custom-widget'),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'card_title',
			[
				'label' => esc_html__('Card Title', 'elementor-custom-widget'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Title', 'elementor-custom-widget'),
			]
		);

		$repeater->add_control(
			'card_sub_title',
			[
				'label' => esc_html__('Card Subtitle', 'elementor-custom-widget'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Sub-title', 'elementor-custom-widget'),
			]
		);

		$repeater->add_control(
			'switcher',
			[
				'label' => esc_html__('Gender', 'elementor-custom-widget'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'Male' => 'Male',
					'Female' => 'Female',
					'Other' => 'Other',
				],
			]
		);

		$repeater->add_control(
			'card_image',
			[
				'label' => esc_html__('Card Image', 'elementor-custom-widget'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__('Repeater', 'elementor-custom-widget'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Your Repeat description here', 'elementor-custom-widget'),
				'label_block' => true,
				'default' => esc_html__('Description', 'elementor-custom-widget'),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__('Repeat List', 'elementor-custom-widget'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'card_title' => esc_html__('Title 1', 'elementor-custom-widget'),
						'card_sub_title' => esc_html__('Sub-title 1', 'elementor-custom-widget'),
						'switcher' => esc_html__('Select anyone', 'elementor-custom-widget'),
						'description' => esc_html__('Description 1', 'elementor-custom-widget'),
					],
					[
						'card_title' => esc_html__('Title 2', 'elementor-custom-widget'),
						'card_sub_title' => esc_html__('Sub-title 2', 'elementor-custom-widget'),
						'switcher' => esc_html__('Select anyone', 'elementor-custom-widget'),
						'description' => esc_html__('Description 2', 'elementor-custom-widget'),
					],
				],
			]
		);

		$this->end_controls_section();
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$list = $settings['list'];
		$date_time = $settings['date_time'];
		?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget_card">
						<h2>
							<?php echo esc_html($date_time); ?>
						</h2>
						<div class="widget_card_content">
							<?php
							if ($list) {
								foreach ($list as $item) {
									?>
									<div class="row">
										<div class="col-md-6">
											<img src="<?php echo esc_url($item['card_image']['url']); ?>" class="widget_card_image"
												alt="Customer Image">
										</div>
										<div class="col-md-6">
											<h2 class="widget_card_title">
												<?php echo esc_html($item['card_title']); ?>
											</h2>
											<h3 class="widget_card_sub_title">
												<?php echo esc_html($item['card_sub_title']); ?>
											</h3>
											<div class="popover_content">
												<p>Gender:
													<?php echo esc_html($item['switcher']); ?>
												</p>
											</div>
											<p class="widget_card_description">
												<?php echo esc_html($item['description']); ?>
											</p>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
<?php

class RocketChatLivechat_Admin {

	/**
	 * The ID of this plugin.
	 *
	 
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}


	public function register_settings() {
		register_setting(
			'rocketchat-livechat-options', 'rocketchat-livechat-url', array(
			$this,
			'sanitize_url'
		)
		);
		add_settings_section( 'rocketchat-livechat-options-head', __('Livechat settings', 'rocketchat-livechat'), '', 'rocketchat-livechat-options' );
		add_settings_field(
			'rocketchat-livechat-url', __('URL of LiveChat', 'rocketchat-livechat'), array(
			$this,
			'settings_text'
		), 'rocketchat-livechat-options', 'rocketchat-livechat-options-head', array(
			'id'   => 'rocketchat-livechat-url',
			'desc' => __( 'Please enter the URL to your Rocket.Chat instance (e.g. https://chat.domain.tld/)', 'rocketchat-livechat' ),
			'size' => 100
		)
		);
	}

	public function menu() {
		add_menu_page('Rocket.Chat LiveChat', 'Rocket.Chat LiveChat', 'administrator', __FILE__,  array(
			$this,
			'options'
		) , plugins_url('../public/icon.svg', __FILE__) );

	}

	public function options() {
		?>
		<div class="wrap" >
			<div style="margin-top: 15px;margin-bottom:15px">
				<img width="300px" src="https://assets-global.website-files.com/611a19b9853b7414a0f6b3f6/611bbb87319adfd903b90f24_logoRC.svg" />
			</div>
			
			<?php
			if ( isset( $_POST['option_page'] ) && $_POST['option_page'] == 'rocketchat-livechat-options' ) {
				// we will only save URL and username, password will be asked only initially for getting auth token
				if ( isset( $_POST['rocketchat-livechat-url'] ) && $_POST['rocketchat-livechat-url'] ) {
					update_option( 'rocketchat-livechat-url', esc_url( $_POST['rocketchat-livechat-url'] ) );
				}
				if ( isset( $_POST['rocketchat-livechat-username'] ) && $_POST['rocketchat-livechat-username'] ) {
					update_option( 'rocketchat-livechat-username', sanitize_text_field( $_POST['rocketchat-livechat-username'] ) );
				}
			}
			?>
			<div style="display:flex">
				<form method="POST"><?php
					settings_fields( 'rocketchat-livechat-options' );
					do_settings_sections( 'rocketchat-livechat-options' );
					submit_button();
					?>
				</form>
			</div>
		</div>
		<?php
	}

	public function sanitize_url( $url ) {
		return esc_url_raw( sanitize_text_field( $url ) );
	}

	public function sanitize_text( $text ) {
		return sanitize_text_field( $text );
	}

	/**
	 * Custom method for generating input field
	 *
	 * @param array $args
	 */
	public function settings_text( $args ) {
		$id = $args['id'];
		if ( ! $id ) {
			return;
		}
		$default_options = array(
			'type'  => 'text',
			'size'  => 20,
			'class' => '',
			'desc'  => ''
		);
		$args            = wp_parse_args( $args, $default_options );
		$option          = '';
		if ( 'password' != $args['type'] ) {
			$option = get_option( $id );
		}
		?><input type="<?php echo esc_attr( $args['type'] ) ?>"
		         name="<?php echo esc_attr( $id ) ?>"
		         value="<?php echo esc_attr( $option ) ?>"
		         id="<?php echo esc_attr( $id ) ?>"
		         size="<?php echo esc_attr( $args['size'] ) ?>"
		         class="<?php echo esc_attr( $args['class'] ) ?>" ><?php
		if ( $args['desc'] ) {
			?><p
				class="description"><?php echo esc_html( $args['desc'] ); ?></p><?php
		}
	}
}

<?php

class RocketChatLivechat_Public {

	/**
	 * The ID of this plugin.
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Display the LiveChat tag
	 */
	public function livechat_tag() {
		$livechat_url = get_option('rocketchat-livechat-url');
		if ( $livechat_url ) {
			$livechat_url = trailingslashit( $livechat_url );
			?>
            <!-- Start of Rocket.Chat Livechat Script -->
            <script type="text/javascript">
                (function(w, d, s, u) {
                    w.RocketChat = function(c) { w.RocketChat._.push(c) }; w.RocketChat._ = []; w.RocketChat.url = u;
                    var h = d.getElementsByTagName(s)[0], j = d.createElement(s);
                    j.async = true; j.src = '<?php echo esc_url( trailingslashit( $livechat_url ) ) ?>livechat/rocketchat-livechat.min.js?_=201912110000';
                    h.parentNode.insertBefore(j, h);
                })(window, document, 'script', '<?php echo esc_url( trailingslashit( $livechat_url ) ) ?>livechat');
            </script>
            <!-- End of Rocket.Chat Livechat Script -->
			<?php
		}
	}

}

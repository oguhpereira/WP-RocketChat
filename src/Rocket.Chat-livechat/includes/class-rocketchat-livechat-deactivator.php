<?php

class RocketChatLivechat_Deactivator {

	public static function deactivate() {
		delete_option('rocketchat-livechat-url');
	}

}

<?php

class RocketChatLivechat_Deactivator {

	public static function deactivate() {
		//currently do nothing
		delete_option('rocketchat-livechat-url');
	}

}

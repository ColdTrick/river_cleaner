<?php 

	function river_cleaner_init(){
		elgg_register_admin_menu_item('administer', 'river_cleaner', 'administer_utilities');
	}
	
	// Initialization functions
	elgg_register_event_handler('init', 'system', 'river_cleaner_init');
	
	elgg_register_action("river_cleaner/clean_river", dirname(__FILE__) . "/actions/clean_river.php", "admin");
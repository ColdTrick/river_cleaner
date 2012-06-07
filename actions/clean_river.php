<?php
$view = get_input("river_view");
if(!empty($view)){
	elgg_delete_river(array("views" => array($view), "site_guid" => false)); // be aware with multi site setup.
}

forward(REFERER);
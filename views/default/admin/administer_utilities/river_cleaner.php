<?php

	$dbprefix = elgg_get_config("dbprefix");
	$query = "SELECT DISTINCT rv.view, count(*) as count FROM " . $dbprefix . "river rv GROUP BY rv.view";

	$views = get_data($query);
	if($views){
		
		$content = "<table class='elgg-table'>";
		$content .= "<tr>";
		$content .= "<th>View</th>";
		$content .= "<th>Usage count</th>";
		$content .= "<th>View active</th>";
		$content .= "<th>View installed</th>";
		$content .= "<th>&nbsp;</th>";
		$content .= "</tr>";
		
		$class = "";
		
		$plugins = elgg_get_plugin_ids_in_dir();
				
		foreach($views as $row){
			$view = $row->view;
			
			$view_exists = elgg_view_exists($view);
			$view_installed = "&nbsp;";
			if(!$view_exists){
				$view_installed = "<span style='color:red; font-weight: bold;'>" . elgg_echo("option:no") . "</span>";
				foreach($plugins as $plugin){
					
					if(file_exists(elgg_get_plugins_path() . $plugin . "/views/default/" . $view . ".php")){
						$view_installed = elgg_echo("option:yes");
						break;
					}
				}
			}
			
			if($view_exists){
				$view_exists = elgg_echo("option:yes");
			} else {
				$view_exists = "<span style='color:orange; font-weight: bold;'>" . elgg_echo("option:no") . "</span>";
			}
			
			$delete_link = "&nbsp;";
			if($view_exists !== elgg_echo("option:yes")){
				$delete_link = elgg_view("output/confirmlink", array("href" => "action/river_cleaner/clean_river?river_view=" . urlencode($view), "text" => elgg_view_icon("delete")));
			}
			
			$content .= "<tr" . $class . "><td>" . $view . "</td><td>" . $row->count . "</td><td>" . $view_exists . "</td><td>" . $view_installed . "</td><td>" . $delete_link . "</td></tr>";
			if(empty($class)){
				$class = " class='alt'";
			} else {
				$class = "";
			}
		}
		$content .= "</table>";
		echo $content;
	}

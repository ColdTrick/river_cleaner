<?php

	$dbprefix = elgg_get_config("dbprefix");
	$query = "SELECT DISTINCT rv.view, count(*) as count FROM " . $dbprefix . "river rv GROUP BY rv.view";

	$views = get_data($query);
	if($views){
		
		$content = "<table class='elgg-table'>";
		$class = "";
		foreach($views as $row){
			
			$content .= "<tr" . $class . "><td>" . $row->view . "</td><td>" . $row->count . "</td><td>" . elgg_view_exists($row->view) . "</td></tr>";
			if(empty($class)){
				$class = " class='alt'";
			} else {
				$class = "";
			}
		}
		$content .= "</table>";
		echo $content;
	}

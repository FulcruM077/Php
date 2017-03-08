<?php

# Bootstrap Navigation Class
# Can AYDIN : https://github.com/FulcruM077
# bcan34@hotmail.com
# MIT Licence

class Navigation {

	# Get main menu items that are not child menus
	function getMenu()
	{
		global $db;
		$stmt = $db->prepare("SELECT id, title, parent, slug FROM menu WHERE parent = '0' ORDER by sort ASC");
		$stmt->execute();
		$stmt->bind_result($id, $title, $parent, $slug);
			while ($stmt->fetch()){
			$row[] = array('id' => $id, 'title' => $title, 'parent' => $parent, 'slug' => $slug);
		}
		$stmt->close();
		if(!empty($row)) {
			return($row);
		} 
	}

	# Check if main item has child menus
	function checkSub($id)
	{
		global $db;
		$stmt = $db->prepare("SELECT 
			id,
			title,
			slug 
			FROM menu WHERE parent = ?
			ORDER BY sort ASC");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->store_result();
		$count = $stmt->num_rows;
			if($count > 0){
				return TRUE;
			} else {
				return FALSE;
			}
	}

	# Get subs if exists
	function getSub($id)
	{
		global $db;
		$stmt = $db->prepare("SELECT 
			id,
			title,
			parent,
			slug 
			FROM menu WHERE parent = ?
			ORDER BY sort ASC");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($id, $title, $parent, $slug);
			while ($stmt->fetch()){
			$row[] = array('id' => $id, 'title' => $title, 'parent' => $parent, 'slug' => $slug);
		}
		$stmt->close();
		if(!empty($row)) {
			return($row);
		} 
	}

	function renderMenu()
	{
		global $db;
		$items = getMenu();
		if(empty($items)) { 
			echo lang("CORE_MENU_EMPTY"); 
		} else {
			foreach( $items as $item ) {
		?>
			<li<?php if($this->checkSub($item['id'])): ?> class="dropdown"<?php endif ?>>
			<a href="<?=$item['slug']?>"<?php if($this->checkSub($item['id'])): ?> class="dropdown-toggle" data-toggle="dropdown"<?php endif ?>>
			 <?=$item['title']?></a>
				<?php if($this->checkSub($item['id'])): ?>
					<ul class="dropdown-menu">
					<? $subItems = $this->getSub($item['id']);
						foreach($subItems as $sub) { ?>
						<li><a href="<?=$sub['slug']?>"><?=$sub['title']?></a></li>
						<? } ?>
					</ul> 
			<?php endif ?>
			</li>
		<?php
		} }
	}

}

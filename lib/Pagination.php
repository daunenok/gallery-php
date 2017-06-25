<?php
class Pagination {
	public $current;
	public $items;
	public $per_page = 2;
	public $pages;

	public function __construct() {
		$this->current = 1;
		$x = new Dbobject("photos");
		$this->items = $x->count_all();
		$this->pages = (int)ceil($this->items/$this->per_page);
	}

	public function next_page() {
		return $this->current + 1; 
	}

	public function prev_page() {
		return $this->current - 1; 
	}

	public function has_next_page() {
		return $this->next_page() <= $this->pages; 
	}

	public function has_prev_page() {
		return $this->prev_page() > 0; 
	}

	public function get_photos() {
		$offset = $this->per_page * ($this->current - 1);
		$sql = "LIMIT " . $this->per_page . " OFFSET " . $offset;
		$ph = new Dbobject("photos");
		$result = $ph->query_sql($sql);
		return $result;
	}
}
?>
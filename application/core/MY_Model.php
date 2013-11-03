<?php

class MY_Model extends CI_Model {

	protected $class;

	protected $table;

	protected $primary_key = 'id';

	protected $belongs_to = array();

	protected $has_many = array();

	protected $with = array();

	public function __construct() {
		parent::__construct();

		self::$class = get_called_class();
		self::$table = strtolower(preg_replace('/_model$/', '', self::$class));

	}

	public function get($primary_value) {
		return $this -> get_by($this -> primary_key, $primary_value);
	}

	public function get_by() {
		$where = func_get_args();

		$this -> _set_where($where);

		$row = $this -> db -> get($this -> _table);

		return $row;
	}

	public function get_many($values) {

		$this -> db -> where_in($this -> primary_key, $values);

		return $this -> get_all();
	}

	public function get_many_by() {
		$where = func_get_args();

		$this -> _set_where($where);

		return $this -> get_all();
	}

	public function get_all() {
		return $this -> db -> get($this -> _table);
	}

	public function insert($data) {
		if (!is_array($data) || empty($data)) {
			return FALSE;
		}
		$result = $this -> db -> insert($this -> table, $data);
		return (!$result) ? $result : $this -> db -> insert_id();
	}

	public function insert_many($data, $skip_validation = FALSE) {
		return $this -> db -> insert_batch($this -> table, $data);
	}

	public function update($primary_value, $data, $skip_validation = FALSE) {
		if (empty($data)) {
			return FALSE;
		}

		$result = $this -> db -> where($this -> primary_key, $primary_value) -> set($data) -> update($this -> table);

		return $result;
	}

	public function update_many($primary_values, $data, $skip_validation = FALSE) {
		$result = $this -> db -> where_in($this -> primary_key, $primary_values) -> set($data) -> update($this -> _table);
		return $result;
	}

	public function update_by() {
		$args = func_get_args();
		$data = array_pop($args);

		$this -> _set_where($args);
		$result = $this -> db -> set($data) -> update($this -> _table);
		$this -> trigger('after_update', array($data, $result));

		return $result;
	}

	public function update_all($data) {
		$result = $this -> db -> set($data) -> update($this -> _table);
		return $result;
	}

	public function delete($id) {
		$this -> db -> where($this -> primary_key, $id);

		$result = $this -> db -> delete($this -> _table);

		return $result;
	}

	public function delete_by() {
		$where = func_get_args();

		$this -> _set_where($where);

		$result = $this -> db -> delete($this -> _table);

		return $result;
	}

	public function delete_many($primary_values) {
		$this -> db -> where_in($this -> primary_key, $primary_values);

		$result = $this -> db -> delete($this -> _table);

		return $result;
	}

	public function count_by() {
		$where = func_get_args();
		$this -> _set_where($where);

		return $this -> db -> count_all_results($this -> _table);
	}

	public function count_all() {
		return $this -> db -> count_all($this -> _table);
	}

	/**
	 * Return the next auto increment of the table. Only tested on MySQL.
	 */
	public function get_next_id() {
		return (int)$this -> db -> select('AUTO_INCREMENT') -> from('information_schema.TABLES') -> where('TABLE_NAME', $this -> _table) -> where('TABLE_SCHEMA', $this -> db -> database) -> get() -> row() -> AUTO_INCREMENT;
	}

	/**
	 * Serialises data for you automatically, allowing you to pass
	 * through objects and let it handle the serialisation in the background
	 */
	public function serialize($row) {
		foreach ($this->callback_parameters as $column) {
			$row[$column] = serialize($row[$column]);
		}

		return $row;
	}

	public function unserialize($row) {
		foreach ($this->callback_parameters as $column) {
			if (is_array($row)) {
				$row[$column] = unserialize($row[$column]);
			} else {
				$row -> $column = unserialize($row -> $column);
			}
		}

		return $row;
	}

	/* --------------------------------------------------------------
	 * QUERY BUILDER DIRECT ACCESS METHODS
	 * ------------------------------------------------------------ */

	/**
	 * A wrapper to $this->db->order_by()
	 */
	public function order_by($criteria, $order = 'ASC') {
		if (is_array($criteria)) {
			foreach ($criteria as $key => $value) {
				$this -> db -> order_by($key, $value);
			}
		} else {
			$this -> db -> order_by($criteria, $order);
		}
		return $this;
	}

	/**
	 * A wrapper to $this->db->limit()
	 */
	public function limit($limit, $offset = 0) {
		$this -> db -> limit($limit, $offset);
		return $this;
	}

	public function select($columns) {
		$this -> db -> select($columns);
		return $this;
	}

	public function where_in($key, $values) {
		$this -> db -> where_in($key, $values);
		return $this;
	}

	/**
	 * Set WHERE parameters, cleverly
	 */
	protected function _set_where($params) {
		if (count($params) == 1) {
			$this -> db -> where($params[0]);
		} else if (count($params) == 2) {
			$this -> db -> where($params[0], $params[1]);
		} else if (count($params) == 3) {
			$this -> db -> where($params[0], $params[1], $params[2]);
		} else {
			$this -> db -> where($params);
		}

		return $this;
	}

}

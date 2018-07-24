<?php
	class SQL_connection {
		private $connection;
		private $result;
		function __construct($host = 'localhost', $user = 'root', $pwd = '', $db_name = 'employees') {
			$this->connection = new mysqli($host, $user, $pwd, $db_name);
			if($this->connection->connect_error) die('FATAL ERROR: '.$this->connection->connect_error);
		}

		public function query($query) {
			$this->result = $this->connection->query($query);
			// if($this->result === false) die('There was an error in getting the requested data.');
			return $this->result;
		}

		/**
		 * @func create_table - creates an employees table only if it doesn't exist.
		 */
		public function create_table($table_name, $table_query) {
			if(!$this->connection->query("select 1 from `$table_name` LIMIT 1"))
				if($this->connection->query($table_query))
					return true;
			return false;
		}
		function get_result() {
			if($this->result) return $this->result->fetch_assoc();
		}
		public function get_2d_array_result() {
			$array_out = [];
			while($row = $this->result->fetch_assoc()) $array_out[] = $row;
			return $array_out;
		}

		function __destruct() {
			$this->connection->close();
			if(gettype($this->result) === 'object') $this->result->free();
		}
	}
?>

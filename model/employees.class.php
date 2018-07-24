<?php
	class Employees {
		private $table_name;
		private $db;
		function __construct($table_name = 'employee') {
			$this->table_name = $table_name;
			$this->db = new SQL_connection();
			$this->create_epmloyees_table();
		}

		private function create_epmloyees_table() {
			$this->db->create_table(
				$this->table_name,
				"CREATE TABLE `employees`.`$this->table_name` (
					`id` INT NOT NULL ,
					`name` VARCHAR(128) NOT NULL ,
					`start_date` DATE NULL ,
					PRIMARY KEY (`id`)
				) ENGINE = InnoDB;"
			);
		}

		public function get_all_employees() {
			$this->db->query("SELECT * FROM $this->table_name");
			return $this->db->get_2d_array_result();
		}
		public function get_employee($id) {
			if(!isset($id) || $id === '') die();
			$id = intval($id);
			$this->db->query(
				"SELECT * FROM `$this->table_name`
					WHERE `$this->table_name`.`id` = $id
						LIMIT 1"
			);
			return $this->db->get_result();
		}
		public function add_employee($id = '', $name = '', $start_date = '') {
			if($id === '' || $name === '') die();
			if($this->get_employee($id)) die('Sorry, this ID is already taken.');

			if($start_date === '0000-00-00' || $start_date === '') {
				date_default_timezone_set('UTC');
				$start_date = date('Y-m-d');
			}
			else $start_date = date('Y-m-d', strtotime($start_date));

			$this->db->query(
				"INSERT INTO `$this->table_name` (`id`, `name`, `start_date`)
					VALUES ('$id', '$name', $start_date)"
			);
			return $this->get_employee($id);
		}
		public function update_employee($id = '', $new_name = '', $new_date = '') {
			if($id === '' || $new_name === '') return;
			$this->db->query(
				"UPDATE `$this->table_name`
				SET `name` = '$new_name', `start_date` = '$new_date'
				WHERE `$this->table_name`.`id` = $id"
			);
			return $this->get_employee($id);
		}
		public function delete_employee($id = '') {
			if($id === '') return;
			$this->db->query("DELETE FROM `$this->table_name` WHERE `$this->table_name`.`id` = $id");
			return $this->get_employee($id);
		}
	}
?>

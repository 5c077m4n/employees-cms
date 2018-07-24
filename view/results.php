<table>
	<?php
		function arr_to_table_row($arr_to_str) {
			if($arr_to_str['start_date'] !== '0000-00-00') {
				return "
					<tr>
						<td>".$arr_to_str['id']."</td>
						<td>".$arr_to_str['name']."</td>
						<td>".$arr_to_str['start_date']."</td>
					</tr>
				";
			}
			else {
				return "
					<tr>
						<td>".$arr_to_str['id']."</td>
						<td>".$arr_to_str['name']."</td>
						<td></td>
					</tr>
				";
			}

		}
		function create_table_rows() {
			if(!isset($_POST['formFunc']) || $_POST['formFunc'] === '')
				return 'Please choose an option.';

			global $employee_table;
			$str_out = "
				<th>ID</th>
				<th>Name</th>
				<th>Starting Date</th>
			";
			if($_POST['formFunc'] === 'get') {
				if($_POST['id'] === '') return 'An ID is required.';
				$str_out .= arr_to_table_row($employee_table->get_employee(intval($_POST['id'])));
			}
			if($_POST['formFunc'] === 'add') {
				if($_POST['id'] === '' || $_POST['name'] === '') return 'An ID and the name are required.';
				$str_out .= arr_to_table_row($employee_table->add_employee(
					intval($_POST['id']), $_POST['name'], $_POST['startDate']
				));
			}
			if($_POST['formFunc'] === 'update') {
				if($_POST['id'] === '' || $_POST['name'] === '') return 'An ID and the name are required.';
				$str_out .= arr_to_table_row($employee_table->update_employee(
					intval($_POST['id']), $_POST['name'], $_POST['startDate']
				));
			}
			if($_POST['formFunc'] === 'delete') {
				if($_POST['id'] === '') return 'An ID is required.';
				$str_out .= arr_to_table_row($employee_table->delete_employee(intval($_POST['id'])));
			}
			if($_POST['formFunc'] === 'getAll') {
				$result = $employee_table->get_all_employees();
				if(!count($result)) return 'Nothing to show yet.';
				foreach($result as $key => $value) $str_out .= arr_to_table_row($value);
			}
			if($_POST['formFunc'] === 'clear') {
				$_POST = [];
				return;
			}
			return $str_out;
		}
		echo create_table_rows();
	?>
</table>

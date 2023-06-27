<?php

	require_once __DAL			. 'base.php';
	require_once __ENTITIES		. 'city.php';

	class CitiesBase extends Base {

		public function get($conditions, $orders, $limits) {
			$stmt = $this->conn->prepare('SELECT * FROM cities' . parent::conditions($conditions) . parent::orders($orders) . parent::limits($limits));
			$stmt->execute();
			return parent::set($stmt, true, 'cityInfo');
		}

		public function add(cityInfo $data) {
			$stmt = $this->conn->prepare('INSERT INTO cities ( NameCity, Route, Status ) VALUES ( ' . parent::quote(isset($data->nameCity) ? $data->nameCity : NULL) . ', ' . parent::quote(isset($data->route) ? $data->route : NULL) . ', ' . parent::value(isset($data->status) ? $data->status : NULL) . ' )');
			$stmt->execute();
			return array('id' => $this->conn->lastInsertId());
		}

		public function update(cityInfo $data, $conditions) {
			$this->conn->prepare('UPDATE cities SET ' . parent::updates($data) . parent::conditions($conditions))->execute();
		}

		public function delete($conditions) {
			$this->conn->prepare('DELETE FROM cities' . parent::conditions($conditions))->execute();
		}

	}

	require_once 'ext/cities.php';

?>
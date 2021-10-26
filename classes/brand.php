<?php 
	include_once '../lib/database.php';
	include_once '../helpers/format.php';
 ?>
<?php 
	/**
	 * 
	 */
	class brand
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($brandName){
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			if ($brandName == "") {
				$alert = "Brand must be not empty";
				return $alert;
			}else{
				$query = "INSERT INTO tbl_brand(brandName) VALUES ('$brandName')";
				$result = $this->db->insert($query);
				if ($result == true) {
					$alert = "<span class='success'>Insert brand Successfully<span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Insert brand Failed<span>";
					return $alert;
				}
			}
		}

		public function show_brand(){
			$query = "SELECT * FROM tbl_brand ORDER BY brandID desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function getbrandbyId($id){
			$query = "SELECT * FROM tbl_brand WHERE brandId = $id";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($brandName, $id){
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if ($brandName == "") {
				$alert = "brand must be not empty";
				return $alert;
			}else{
				$query = "UPDATE `tbl_brand` SET `brandName`='$brandName' WHERE brandId = $id";
				$result = $this->db->update($query);
				if ($result == true) {
					$alert = "<span class='success'>Update brand Successfully<span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Update brand Failed<span>";
					return $alert;
				}
			}
		}
		public function del_brand($id){
			$query = "DELETE FROM `tbl_brand` WHERE brandId = $id";
			$result = $this->db->delete($query);
			if ($result) {
				$alert = "<span class='success'>Deleted brand Successfully<span>";
					return $alert;
			}else{
				$alert = "<span class='success'>Deleted brand Failed<span>";
					return $alert;
			}
		}
	}
 ?>
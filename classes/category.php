<?php 
	include '../lib/database.php';
	include '../helpers/format.php';
 ?>
<?php 
	/**
	 * 
	 */
	class category
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_category($catName){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			if ($catName == "") {
				$alert = "Category must be not empty";
				return $alert;
			}else{
				$query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
				$result = $this->db->insert($query);
				if ($result == true) {
					$alert = "<span class='success'>Insert Category Successfully<span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Insert Category Failed<span>";
					return $alert;
				}
			}
		}

		public function show_category(){
			$query = "SELECT * FROM tbl_category ORDER BY catID desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function getcatbyId($id){
			$query = "SELECT * FROM tbl_category WHERE catId = $id";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_category($catName, $id){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if ($catName == "") {
				$alert = "Category must be not empty";
				return $alert;
			}else{
				$query = "UPDATE `tbl_category` SET `catName`='$catName' WHERE catId = $id";
				$result = $this->db->update($query);
				if ($result == true) {
					$alert = "<span class='success'>Update Category Successfully<span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Update Category Failed<span>";
					return $alert;
				}
			}
		}
		public function del_category($id){
			$query = "DELETE FROM `tbl_category` WHERE catId = $id";
			$result = $this->db->delete($query);
			if ($result) {
				$alert = "<span class='success'>Deleted Category Successfully<span>";
					return $alert;
			}else{
				$alert = "<span class='success'>Deleted Category Failed<span>";
					return $alert;
			}
		}
	}
 ?>
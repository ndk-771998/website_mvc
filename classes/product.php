<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';
?>
<?php
/**
 *
 */
class product {
	private $db;
	private $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insert_product($data, $files) {
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$desciption = mysqli_real_escape_string($this->db->link, $data['desciption']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);

		$permited = array('jpg', 'jpng', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "upload/" . $unique_image;

		if ($productName == "" || $brand == "" || $category == "" || $desciption == "" || $type == "" || $price == "") {
			$alert = "Fields must be not empty";
			return $alert;
		} else {
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO `tbl_product`(`productName`, `catId`, `brandId`, `desciption`, `type`, `price`, `image`) VALUES ('$productName','$category','$brand','$desciption','$type','$price','$unique_image')";
			$result = $this->db->insert($query);
			if ($result == true) {
				$alert = "<span class='success'>Insert Product Successfully<span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Insert Product Failed<span>";
				return $alert;
			}
		}
	}

	public function show_product() {
		// $query = "SELECT tbl_product.* , tbl_brand.brandName, tbl_category.catName
		// FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
		// INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
		// ORDER BY tbl_product.productId desc";
		$query = "SELECT p.*, c.catName, b.brandName
		FROM tbl_product as p, tbl_category as c, tbl_brand as b
		WHERE p.catId = c.catId and p.brandId = b.brandId
		ORDER BY p.productId desc";
		$result = $this->db->select($query);
		return $result;
	}

	// public function getcatbyId($id){
	// 	$query = "SELECT * FROM tbl_category WHERE catId = $id";
	// 	$result = $this->db->select($query);
	// 	return $result;
	// }

	// public function update_category($catName, $id){
	// 	$catName = $this->fm->validation($catName);
	// 	$catName = mysqli_real_escape_string($this->db->link, $catName);
	// 	$id = mysqli_real_escape_string($this->db->link, $id);
	// 	if ($catName == "") {
	// 		$alert = "Category must be not empty";
	// 		return $alert;
	// 	}else{
	// 		$query = "UPDATE `tbl_category` SET `catName`='$catName' WHERE catId = $id";
	// 		$result = $this->db->update($query);
	// 		if ($result == true) {
	// 			$alert = "<span class='success'>Update Category Successfully<span>";
	// 			return $alert;
	// 		}else{
	// 			$alert = "<span class='error'>Update Category Failed<span>";
	// 			return $alert;
	// 		}
	// 	}
	// }
	// public function del_category($id){
	// 	$query = "DELETE FROM `tbl_category` WHERE catId = $id";
	// 	$result = $this->db->delete($query);
	// 	if ($result) {
	// 		$alert = "<span class='success'>Deleted Category Successfully<span>";
	// 			return $alert;
	// 	}else{
	// 		$alert = "<span class='success'>Deleted Category Failed<span>";
	// 			return $alert;
	// 	}
	// }
}
?>
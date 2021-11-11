<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Id</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Image</th>
					<th>Desciption</th>
					<th>Type</th>
					<th>Brand</th>
					<th>Category</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
$product = new product();
$product_list = $product->show_product();
$fm = new Format();
if ($product_list) {
	$i = 0;
	while ($result = $product_list->fetch_assoc()) {
		$i++;
		?>
	<tr class="odd gradeX">
		<td><?php echo $i ?></td>
		<td><?php echo $result['productName'] ?>/td>
		<td><?php echo $result['price'] ?></td>
		<td class="center"><img style="width: 160px; height: auto; padding-top: 20px;" src="upload/<?php echo $result['image'] ?>" alt=""></td>
		<td class="center"><?php echo $fm->textShorten($result['desciption'], 70) ?></td>
		<td class="center"><?php
if ($result['type'] == '1') {
			echo "Feathered";
		} else {
			echo "None Feathered";
		}
		?></td>
		<td class="center"><?php echo $result['brandName'] ?></td>
		<td class="center"><?php echo $result['catName'] ?></td>
		<td><a href="">Edit</a> || <a href="">Delete</a></td>
	</tr>
	<?php
}
}
?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php
 $brand= new Brand();
 
 if (isset($_GET['delbrand'])) {//for delete brand name 

 	$id = $_GET['delbrand'];
 	$delBrand = $brand->delBrandById($id);
 }
 
 
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block"> 
                <?php
                
                	if (isset($delBrand)) {
                		echo "$delBrand";
                	}
                	
                ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$getBrand=$brand->getAllBrand(); //we are calling a function name getAllBrand();
						if($getBrand){ // if it get The variable $getCat
							$i=0; // we have to show serial number so initializing i=0;
							while($result=$getBrand->fetch_assoc()){//all will be fetch from getCat
								$i++;
							
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!') " href="?delbrand=<?php echo $result['brandId'];?>">Delete</a></td>
						</tr>
						<?php } } ?>
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


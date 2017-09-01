<?php
	include("../functions.php");
	$page=basename($_SERVER['PHP_SELF']);
	//$category_array=getCategory();

	 if(isset($_POST['add_category']))
		{
		setCategory();
		
	  }
	else if(isset($_GET['d_id']))
	{
		$idtodel=$_GET['d_id'];
		deleteCategory($idtodel);

	}
	else
	{
      getCategory(); 
	}


	function deleteCategory($idtodel)
	{
		global $conn,$stmt;
		$stmt=$conn->prepare("SELECT * FROM category_table WHERE parent_id=?");
		$stmt->bind_param("i",$idtodel);
		$stmt->bind_result($id15,$name15,$parentid15);
		$stmt->execute();
		while ($stmt->fetch()) 
		{
			$child_id_to_del=$id15;
		}
		$stmt=$conn->prepare("DELETE FROM category_table WHERE id=?");
		$stmt->bind_param("i",$idtodel);
		$stmt->execute();
		/////deleting child
		$stmt=$conn->prepare("DELETE FROM category_table WHERE id=?");
		$stmt->bind_param("i",$child_id_to_del);
		$stmt->execute();
		$stmt->close();
		$conn->close();

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include("header.php");?>
</head>
<body>
<?php $page=basename($_SERVER['PHP_SELF']);
include("sidebar.php");?>
<div id="main-content">
	
	<table>
		
		<thead>
			<tr>
			   <th><input class="check-all" type="checkbox" />
			   </th>
			   <th>Category ID</th>
			   <th>Category Name</th>
			   <th>Category parent</th>
			   <th>Operations</th>
			 </tr>
			
		</thead>
	 
		<tfoot>
			<tr>
				<td colspan="6">
					<div class="bulk-actions align-left">
						<select name="dropdown">
							<option value="option1">Choose an action...</option>
							<option value="option2">Edit</option>
							<option value="option3">Delete</option>
						</select>
						<a class="button" href="#">Apply to selected</a>
					</div>
					
					
						
						<div class="pagination">
						</div>
					 
					<div class="clear"></div>
				</td>
			</tr>
		</tfoot>
	 			
		<tbody>
				<!--default-->
		<?php global $category_array;
		foreach($category_array as $key => $value):?>
			<tr>
				<td><input type="checkbox" /></td>
				
				<td><strong><?php echo $category_array[$key]['id'];?></strong></td>
				<td><strong><?php echo $category_array[$key]['name'];?></strong></td>
				<td><strong><?php echo $category_array[$key]['parent_id'];?></strong></td>
				
	
					<!-- Icons --><td>
					 <a href="category_form.php?e_id=<?php echo $category_array[$key]['id'];?>" title="Edit" class="edit_class"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
					 <a href="managecategory.php?d_id=<?php echo $category_array[$key]['id'];?>&page_id=<?php echo $page_id;?>" title="Delete" class="delete_class"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
					 <a href="#" title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
				</td>
			</tr>
		<?php endforeach;?>
		<!--jfkff-->
		</tbody>
		
	</table>
</div>
<div class="clear"></div>

<?php include("footer.php");?>
<script type="text/javascript" src="jQuery.js"></script>
<script type="text/javascript">
	$(document).ready(function()
		{

						//alert("allready loaded");
						/////
						<?php global $total_pages;?>
						var htm="<a href='managecategory.php?page_id=0&showcategories=1' title='First Page'>&laquo; First</a><a href='managecategory.php?page_id=<?php  if($page_id==0) {echo $page_id;} else{echo $page_id-1;}?>&showcategories=1' title='Previous Page'>&laquo; Previous</a>";
						for(var i=1;i<='<?php echo $total_pages; ?>';i++)
						{
							htm+="<a href='managecategory.php?page_id="+(i-1)+"&showcategories=1' class='number current' title="+i+">"+i+"</a>";
						}
						htm+="<a href='managecategory.php?page_id=<?php  echo $page_id+1;?>&showcategories=1' title='Next Page'>Next &raquo;</a><a href='managecategory.php?page_id="+(i-2)+"&showcategories=1' title='Last Page'>Last &raquo;</a>";
						$(".pagination").html(htm);
					});

</script>
</body>
</html>
<!--


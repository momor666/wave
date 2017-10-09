<?php
	include_once('config/database.php'); 
	include_once('app/Controllers/MainController.php'); 
?>
<div id="content" class="container col-md-12">
	<?php 
		if(isset($_POST['btnAdd'])){
			$company_name = $_POST['company_name'];
			
			$menu_image = $_FILES['company_image']['name'];
			$image_error = $_FILES['company_image']['error'];
			$image_type = $_FILES['company_image']['type'];
			
			$error = array();
			
			if(empty($company_name)){
				$error['company_name'] = " <span class='label label-danger'>Хоосон байна!</span>";
			}
			
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			
			error_reporting(E_ERROR | E_PARSE);
			$extension = end(explode(".", $_FILES["company_image"]["name"]));
					
			if($image_error > 0){
				$error['company_image'] = " <span class='label label-danger'>Хуулах боломжгүй байна!!</span>";
			}else if(!(($image_type == "image/gif") || 
				($image_type == "image/jpeg") || 
				($image_type == "image/jpg") || 
				($image_type == "image/x-png") ||
				($image_type == "image/png") || 
				($image_type == "image/pjpeg")) &&
				!(in_array($extension, $allowedExts))){
			
				$error['company_image'] = " <span class='label label-danger'>Зурагийн төрөл зөвхөн jpg, jpeg, gif, or png!</span>";
			}
			
			if(!empty($company_name) && empty($error['company_image'])){
				
				// create random image file name
				$string = '0123456789';
				$file = preg_replace("/\s+/", "_", $_FILES['company_image']['name']);
				$function = new MainController;
				$menu_image = $function->get_random_string($string, 4)."-".date("Y-m-d").".".$extension;
					
				$upload = move_uploaded_file($_FILES['company_image']['tmp_name'], 'upload/images/'.$menu_image);
		
				$sql_query = "INSERT INTO company (company_name, company_image)
						VALUES(?, ?)";
				
				$upload_image = 'upload/images/'.$menu_image;
				$stmt = $connect->stmt_init();
				if($stmt->prepare($sql_query)) {	
					$stmt->bind_param('ss', 
								$company_name, 
								$upload_image
								);
					$stmt->execute();
					$result = $stmt->store_result();
					$stmt->close();
				}
				
				if($result){
					$error['add_company'] = " <h4><div class='alert alert-success'>
														* Шинэ брэнд амжилттай нэмлээ
														<a href='company.php'>
														<i class='fa fa-check fa-lg'></i>
														</a></div>
												  </h4>";
				}else{
					$error['add_company'] = " <span class='label label-danger'>Брэнд нэмэхэд алдаа гарлаа</span>";
				}
			}
			
		}

		if(isset($_POST['btnCancel'])){
			header("location: company.php");
		}

	?>
	<div class="col-md-12">
		<h1>Брэнд нэмэх</h1>
		<?php echo isset($error['add_company']) ? $error['add_company'] : '';?>
		<hr />
	</div>
	
	<div class="col-md-5">
		<form method="post"
			enctype="multipart/form-data">
			<label>Брэнд нэр :</label><?php echo isset($error['company_name']) ? $error['company_name'] : '';?>
			<input type="text" class="form-control" name="company_name"/>
			<br/>
			<label>Зураг :</label><?php echo isset($error['company_image']) ? $error['company_image'] : '';?>
			<input type="file" name="company_image" id="company_image" />
			<br/>
			<input type="submit" class="btn-primary btn" value="Батлах" name="btnAdd"/>
			<input type="reset" class="btn-warning btn" value="Цэвэрлэх"/>
			<input type="submit" class="btn-danger btn" value="Буцах" name="btnCancel"/>
		</form>
	</div>

	<div class="separator"> </div>
</div>
	
<?php include_once('config/close_database.php'); ?>
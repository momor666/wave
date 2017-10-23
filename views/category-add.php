<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once $_SERVER["DOCUMENT_ROOT"]."/app/Controllers/CategoryController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/app/Controllers/MainController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/views/header.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/views/left-sidebar.php";

if (isset($_POST['btnAdd'])) {
    $cat_name = $_POST['cat_name'];
    $cat_image = $_FILES['cat_image']['name'];
    $image_err = $_FILES['cat_image']['error'];
    $image_type = $_FILES['cat_image']['type'];
    $error = array();
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    error_reporting(E_ERROR | E_PARSE);
    $extention = end(explode(".", $_FILES["cat_image"]["name"]));
    if ($image_err > 0) {
        echo '<script type="text/javascript">alert("Зураг хуулах боломжгүй");</script>';
        $error['cat_image'] = "<span class='label label-danger'>Зураг хуулах боломжгүй байна</span>";
    } else if (!(($image_type == "image/gif") || 
        ($image_type == "image/jpeg") ||
        ($image_type == "image/jpg") ||
        ($image_type == "image/x-png") ||
        ($image_type == "image/png") ||
        ($image_type == "image/pjpeg")) && 
        !(in_array($extention, $allowedExts))){
        echo '<script type="text/javascript">alert("Зургын өргөтгөл зөвхөн jpg, jpeg, gif, png!!");</script>';
        $error['cat_image'] = "<span class='label label-danger'>Зургын өргөтгөл зөвхөн jpg, jpeg, gif, png!!</span>";
    }
    if (!empty($cat_name) && !empty($cat_image) && empty($error['cat_image'])) {
        
        $strings = '0123456789';
        $file = preg_replace("/\s+/", "-", $_FILES['cat_image']['name']);
        $function = new MainController();
        $cat_image = $function->get_random_string($strings, 4)."-".date("Y-m-d").".".$extention;
        $upload = move_uploaded_file($_FILES['cat_image']['tmp_name'], 'upload/images/'.$cat_image);
        $upload_image = 'upload/images/'.$cat_image;
        $cat = new CategoryController();
        $cat->create($cat_name, $upload_image);
    }
}
?>

<section class="content">
    <div class="container-fluid">
       
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Ангилал нэмэх</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="cat_name" required>
                                    <label class="form-label">Ангилалын гарчиг</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <input type="file" name="cat_image">
                            </div>
                            
                            <button class="btn btn-primary waves-effect" type="submit" name="btnAdd">Нэмэх</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->
    
    </div>
</section>

<?php require_once('footer.php');?>

<script src="../../js/pages/forms/form-validation.js"></script>
<script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>
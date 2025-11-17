<?php
require 'partials/db_config.php';
require 'partials/essentials.php';
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin Carousel</title>
<?php require('partials/header.php'); ?>
 
<?php require('partials/sidebar.php'); ?>
       
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden">
         <h3 class="mb-4">CAROUSEL</h3>
           
         <style>
    .custom-alert {
    position: fixed;
    top: 120px;
    right: 25px;
}
  </style> 
<!---CAROUSEL-------->
<div class="card shadow-sm mb-4">
            <div class="card-body shadow">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title m-0">Carousel Image Settings</h5>
                            <button type="button" class="btn btn-dark shadow-nonw btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                             <i class="bi bi-plus-square"></i> Add
                           </button>
                 </div>
                    <div class="row" id="carousel-data">
                     
                    </div>
                </div>
        </div>

         <!---Management Settings Modal---->
         <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="carousel_s_form">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Image</h5>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Picture</label>
                    <input type="file" name="carousel_picture" accept=".jpg, .png, .webp, .jpeg" id="carousel_picture_inp" class="form-control shadow-none" required>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="carousel_picture.value=''" class="btn text-white shadow-none btn-danger" data-bs-dismiss="modal">CANCEl</button>
                    <button type="submit" class="btn btn-success shadow-none">SAVE</button>
                </div>
                </div>
                </form>
            </div>
        </div>

        


</div>       
</div>
</div>





<script src="scripts/carousel.js"></script>
<?php require('partials/footer.php'); ?>
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
    <title>Admin Settings</title>
<?php require('partials/header.php'); ?>
 
<?php require('partials/sidebar.php'); ?>
       
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden">
         <h3 class="mb-4">SETTINGS</h3>
         
           
         <!---General Settings ---->
         <div class="card shadow-sm mb-4">
            <div class="card-body shadow">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-nonw btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                             <i class="bi bi-pencil-square"></i> Edit
                           </button>
                </div>
                <h6 class="card-subtitle text-dark mb-1 fw-bold">Website Title</h6>
                <p class="card-text" id="site_title"></p>
                <h6 class="card-subtitle mb-1 text-dark fw-bold">About Us</h6>
                <p class="card-text" id="site_about"></p>
            </div>
        </div>
        <!---General Settings Modal---->
        <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="general_s_form">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">General Settings</h5>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Website Title</label>
                    <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">About Us</label>
                    <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="10" required></textarea>
                 </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn text-white shadow-none btn-danger" data-bs-dismiss="modal">CANCEl</button>
                    <button type="submit" class="btn btn-success text-white shadow-none">SAVE</button>
                </div>
                </div>
                </form>
            </div>
        </div>

       

        <!---ContactUs----->
       

       

        

        


</div>
<!---Management-------->


        
</div>
</div>





<script src="scripts/setting.js"></script>
<?php require('partials/footer.php'); ?>
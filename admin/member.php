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
<title>Admin Members</title>
<?php require('partials/header.php'); ?>
 
<?php require('partials/sidebar.php'); ?>
       
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden">
         <h3 class="mb-4">MEMBERS</h3>
  <style>
    .custom-alert {
    position: fixed;
    top: 110px;
    right: 25px;
}
  </style>       
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">MEMBERS</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#place-s">
                <i class="bi bi-plus-square"></i> Add
            </button>
        </div>
        <div class="table-responsive" style="height: 450px; overflow-y: scroll;">
        <table class="table table-hover border">
            <thead class="table-dark">
            <tr class="bg-dark text-light">
                <th scope="col">#</th>
                <th scope="col">Picture</th>
                <th scope="col" width="10%">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone No</th>
                <th scope="col">Class</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody id="member-data">
            </tbody>
            </table>
        </div>
    </div>
</div>

     
 <!---Facilities Modal---->
 <div class="modal fade" id="place-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="place_s_form">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Member</h5>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="member_name"   class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Picture</label>
                    <input type="file" name="member_picture" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="member_email" class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Phone No</label>
                    <input type="text" name="member_phoneno" class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Class</label>
                    <input type="text" name="member_class" class="form-control shadow-none" required>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-white shadow-none btn-danger" data-bs-dismiss="modal">CANCEl</button>
                    <button type="submit" class="btn btn-success shadow-none">SAVE</button>
                </div>
                </div>
                </form>
            </div>
        </div>
        


</div>     
  
</div>
</div>


<script src="scripts/member.js"></script>
<?php require('partials/footer.php'); ?>
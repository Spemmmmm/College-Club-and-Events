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
<title>Admin Club</title>
<?php require('partials/header.php'); ?>
 
<?php require('partials/sidebar.php'); ?>
       
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden">
         <h3 class="mb-4">CLUB</h3>
  <style>
    .custom-alert {
    position: fixed;
    top: 110px;
    right: 25px;
}
  </style>       
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="text-end mb-4">
            
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-club">
                <i class="bi bi-plus-square"></i> Add
            </button>
        </div>
            <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                <table class="table table-hover border text-center">
                    <thead class="table-dark">
                    <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Action</th>
                        
                    </tr>
                    </thead>
                    <tbody id="club-data">
                    </tbody>
                    </table>
                </div>
    </div>
</div>

     
 <!---Add Room Modal---->
 <div class="modal fade" id="add-club" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="add_club_form" autocomplete="off">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Club</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Name Of Club</label>
                            <input type="text" name="name" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Description of Club</label>
                            <textarea name="desc" rows="4" class="form-control shadow-none"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Purpose and Vision</label>
                            <textarea name="purpose" rows="4" class="form-control shadow-none"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Key Activities</label>
                            <textarea name="activities" rows="4" class="form-control shadow-none"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contribution to College</label>
                            <textarea name="contribution" rows="4" class="form-control shadow-none"></textarea>
                        </div>
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


         <!---Edit Room Modal---->
        <div class="modal fade" id="edit-club" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="edit_club_form" autocomplete="off">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Club</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Name of The Club</label>
                            <input type="text" name="name" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Description of Club</label>
                             <textarea name="desc" rows="4" class="form-control shadow-none"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Purpose and Vision</label>
                            <textarea name="purpose" rows="4" class="form-control shadow-none"></textarea>
                        </div>
                         <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Key Activities</label>
                            <textarea name="activities" rows="4" class="form-control shadow-none"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contribution to College</label>
                            <textarea name="contribution" rows="4" class="form-control shadow-none"></textarea>
                        </div>
                        <input type="hidden" name="club_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" onclick="edit_details($row[id])" class="btn text-white shadow-none btn-danger" data-bs-dismiss="modal">CANCEl</button>
                    <button type="submit" class="btn btn-success shadow-none">SAVE</button>
                </div>
                </div>
                </form>
            </div>
        </div>
        
        <!-- Manage Room Images Modal -->
        <div class="modal fade" id="club-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Club Name</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="image-alert"></div>
                <div class="border-bottom border-3 pb-3 mb-3">
                    <form id="add_image_form">
                    <label class="form-label fw-bold">Add Image</label>
                    <input type="file" name="image" accept=".jpg, .jpeg, .png, .webp"  class="form-control shadow-none mb-3" required>
                    <button class="btn btn-success text-white shadow-none">ADD</button>
                    <input type="hidden" name="club_id">
                    </form>
                </div>
            </div>
            <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                <table class="table table-hover border text-center">
                    <thead class="sticky-top">
                    <tr class="bg-dark text-light sticky-top">
                        <th scope="col" width="60%">Image</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="club-image-data">
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>


</div>       
</div>
</div>


<?php require('partials/footer.php'); ?>
<script src="scripts/clubs.js"></script>

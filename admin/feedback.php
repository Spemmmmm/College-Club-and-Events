<?php
require 'partials/db_config.php';
require 'partials/essentials.php';
adminLogin();

if(isset($_GET['seen']))
{
    $frm_data = filteration($_GET);

    if($frm_data['seen']=='all'){
        $q = "UPDATE `feedback` SET `seen`=?";
        $values = [1];
        if(update($q, $values, 'i')){
            alert('success','Marked all as read');
        }else{
            alert('error','Operation failed');
            
        }

    }else{
        $q = "UPDATE `feedback` SET `seen`=? WHERE `sr_no`=?";
        $values = [1,$frm_data['seen']];
        if(update($q, $values, 'ii')){
            alert('success','Marked as read');
        }else{
            alert('error','Operation failed');
            
        }
    }
}

if(isset($_GET['del']))
{
    $frm_data = filteration($_GET);

    if($frm_data['del']=='all'){
        $q = "DELETE FROM `feedback`";
        if(mysqli_query($con, $q)){
            alert('success','All data deleted');
        }else{
            alert('error','Operation failed');
            
        }

    }else{
        $q = "DELETE FROM `feedback` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if(delete($q, $values, 'i')){
            alert('success','Data deleted');
        }else{
            alert('error','Operation failed');
            
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin Feedback</title>
<?php require('partials/header.php'); ?>
 
<?php require('partials/sidebar.php'); ?>
       
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden">
         <h3 class="mb-4">Feedback</h3>
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
            <a href="?seen=all" class="btn btn-primary rounded-pill shadow-none btn-sm">
            <i class="bi bi-check-all"></i>    Mark all as read
            </a>
            <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
              <i class="bi bi-trash"></i>  Delete all
            </a>
        </div>
        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
        <table class="table table-hover border">
            <thead class="table-dark">
            <tr class="bg-dark text-light">
                <th scope="col">#</th>
                <th scope="col">Club</th>
                <th scope="col"  width="40%">Feedback</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                  $q = "SELECT * FROM `feedback` ORDER BY `sr_no` DESC";
                  $data = mysqli_query($con, $q);
                  $i=1;

                  while ($row = mysqli_fetch_array($data)) {
                    $date =date('d-m-Y H:i a',strtotime($row['datentime']));
                    $seen='';
                    if($row['seen']!=1){
                        $seen= "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>
                    <i class='bi bi-check'></i> Mark as read</a>";
                    }
                    $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger' style='margin-right: 2px;'>
                    <i class='bi bi-trash'></i>  Delete</a>";

                    echo<<<query
                    <tr>
                    <td>$i</td>
                    <td>$row[club]</td>
                    <td>$row[feedback]</td>
                    <td>$date</td>
                    <td>$seen</td>
                    </tr>
                    query;
                    $i++;
                  }
                ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

     

        


</div>       
</div>
</div>




<?php require('partials/footer.php'); ?>
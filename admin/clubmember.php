<?php
require 'partials/db_config.php';
require 'partials/essentials.php';
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin - Club Members</title>
<?php require('partials/header.php'); ?>
<?php require('partials/sidebar.php'); ?>

<div class="container-fluid" id="main-content">
  <div class="row">
    <div class="col-lg-10 ms-auto p-4 overflow-hidden">
      <h3 class="mb-4">Club Members</h3>

      <style>
        /* Club section styling */
        .club-section {
          margin-bottom: 40px;
          background: #f8f9fa;
          padding: 20px;
          border-radius: 8px;
          box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .club-title {
          font-size: 1.5rem;
          font-weight: 600;
          margin-bottom: 15px;
          color: #343a40;
          border-bottom: 2px solid #6c757d33;
          padding-bottom: 5px;
        }

        /* Table styling */
        .members-table {
          width: 100%;
          border-collapse: collapse;
          min-width: 700px;
        }

        .members-table th, .members-table td {
          padding: 10px 12px;
          text-align: left;
        }

        .members-table th {
          background-color: #343a40;
          color: #fff;
          font-weight: 600;
          position: sticky;
          top: 0;
          z-index: 1;
        }

        .members-table tr:nth-child(even) {
          background-color: #f2f2f2;
        }

        .members-table tr:hover {
          background-color: #d6e0f0;
          cursor: pointer;
        }

        /* Table container scroll */
        .table-responsive-md {
          max-height: 400px;
          overflow-y: auto;
          overflow-x: auto;
          border-radius: 6px;
          border: 1px solid #dee2e6;
        }

        /* Pagination styling */
        .pagination {
          margin-top: 15px;
          display: flex;
          gap: 6px;
          flex-wrap: wrap;
        }

        .pagination a {
          padding: 6px 12px;
          border: 1px solid #343a40;
          border-radius: 4px;
          text-decoration: none;
          color: #343a40;
          transition: 0.2s;
        }

        .pagination a:hover {
          background-color: #343a40;
          color: #fff;
        }

        .pagination a.active {
          background-color: #343a40;
          color: #fff;
          font-weight: bold;
        }

        /* Responsive headings for mobile */
        @media (max-width: 768px) {
          .club-title {
            font-size: 1.25rem;
          }
        }
      </style>

      <?php
      $clubs = selectAll('rooms');

      foreach($clubs as $club) {
          $club_id = $club['id'];
          $club_name = $club['name'];

          // Pagination variables
          $limit = 10;
          $page = isset($_GET['page_' . $club_id]) ? (int)$_GET['page_' . $club_id] : 1;
          $offset = ($page - 1) * $limit;

          // Total members
          $total_result = select("SELECT COUNT(*) as total FROM `student` WHERE `club_id`=?", [$club_id], 'i');
          $total_row = mysqli_fetch_assoc($total_result);
          $total_members = $total_row['total'];
          $total_pages = ceil($total_members / $limit);

          // Fetch members
          $members = select("SELECT * FROM `student` WHERE `club_id`=? LIMIT ?,?", [$club_id, $offset, $limit], 'iii');

          echo "<div class='club-section' id='club-{$club_id}-section'>";
          echo "<div class='club-title'>{$club_name} Members</div>";

          echo "<div class='table-responsive-md'>";
          echo "<table class='members-table'>";
          echo "<thead>
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Course</th>
                      <th>Email</th>
                      <th>Contact No</th>
                      <th>Std ID</th>
                      <th>Section</th>
                  </tr>
                </thead><tbody>";

          $i = $offset + 1;
          while($member = mysqli_fetch_assoc($members)) {
              echo "<tr>
                      <td>{$i}</td>
                      <td>{$member['name']}</td>
                      <td>{$member['course']}</td>
                      <td>{$member['email']}</td>
                      <td>{$member['contactno']}</td>
                      <td>{$member['std_id']}</td>
                      <td>{$member['section']}</td>
                    </tr>";
              $i++;
          }

          if($i == $offset + 1) {
              echo "<tr><td colspan='7' class='text-center'>No members found</td></tr>";
          }

          echo "</tbody></table></div>";

          // Pagination
          if($total_pages > 1){
              echo "<div class='pagination'>";
              for($p=1; $p<=$total_pages; $p++){
                  $active = ($p == $page) ? 'active' : '';
                  echo "<a class='{$active}' href='?page_{$club_id}={$p}#club-{$club_id}-section'>{$p}</a>";
              }
              echo "</div>";
          }

          echo "</div>"; // club-section
      }
      ?>

    </div>
  </div>
</div>

<?php require('partials/footer.php'); ?>

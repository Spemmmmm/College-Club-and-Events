<?php
require('../partials/db_config.php');
require('../partials/essentials.php');
adminLogin();

// --- Helper function to shorten text ---
function shortText($text, $limit = 100){
    return (strlen($text) > $limit) ? substr($text, 0, $limit) . "..." : $text;
}

// --- Add club ---
if(isset($_POST['add_club']))
{  
    $frm_data = filteration($_POST);

    $q1 = "INSERT INTO `rooms`(`name`, `desc`, `purpose`, `activities`, `contribution`) VALUES (?,?,?,?,?)";
    $values = [
        $frm_data['name'],
        $frm_data['desc'],
        $frm_data['purpose'],
        $frm_data['activities'],
        $frm_data['contribution']
    ];

    echo insert($q1, $values, 'sssss') ? 1 : 0;
}

// --- Get all clubs ---
if(isset($_POST['get_all_clubs']))
{
    $res = select("SELECT * FROM `rooms`", [], '');
    $data = "";
    $i = 1;

    while($row = mysqli_fetch_assoc($res))
    {
        $name = htmlspecialchars($row['name'], ENT_QUOTES);
        $desc = htmlspecialchars($row['desc'], ENT_QUOTES);
        $purpose = htmlspecialchars($row['purpose'], ENT_QUOTES);
        $activities = htmlspecialchars($row['activities'], ENT_QUOTES);
        $contribution = htmlspecialchars($row['contribution'], ENT_QUOTES);

        $data .= "
        <tr class='align-middle'>
            <td>$i</td>
            <td>$name</td>
            <td>". shortText($desc, 100) ."</td>
            <td>
                <button type='button' onclick='edit_details($row[id])' 
                    class='btn btn-primary shadow-none btn-sm' 
                    data-bs-toggle='modal' data-bs-target='#edit-club'>
                    <i class='bi bi-pencil-square'></i>
                </button>
                
                <button type='button' onclick=\"club_images($row[id], '$name')\" 
                    class='btn btn-info shadow-none btn-sm' 
                    data-bs-toggle='modal' data-bs-target='#club-images'>
                    <i class='bi bi-images'></i>
                </button>

                <button type='button' onclick='remove_club($row[id])' 
                    class='btn btn-danger shadow-none btn-sm'>
                    <i class='bi bi-trash'></i>
                </button>
            </td>
        </tr>";
        $i++;
    }

    echo $data;
}

// --- Get single club ---
if(isset($_POST['get_club']))
{
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['get_club']], 'i');
    $clubdata = mysqli_fetch_assoc($res1);
    echo json_encode(['clubdata' => $clubdata]);
}

// --- Edit club ---
if(isset($_POST['edit_club']))
{
    $frm_data = filteration($_POST);
    $q1 = "UPDATE `rooms` SET `name`=?, `desc`=?, `purpose`=?, `activities`=?, `contribution`=? WHERE `id`=?";
    $values = [
        $frm_data['name'],
        $frm_data['desc'],
        $frm_data['purpose'],
        $frm_data['activities'],
        $frm_data['contribution'],
        $frm_data['club_id']
    ];

    echo update($q1,$values,'sssssi') ? 1 : 0;
}

// --- Add club image ---
if(isset($_POST['add_image']))
{
    $frm_data = filteration($_POST);
    $img_r = uploadImage($_FILES['image'], CLUB_FOLDER);

    if(in_array($img_r, ['inv image', 'inv_size', 'upload_failed'])){
        echo $img_r;
    } else {
        $q = "INSERT INTO `room_images`(`club_id`, `image`) VALUES (?,?)";
        echo insert($q, [$frm_data['club_id'], $img_r], 'is');
    }
}

// --- Get club images ---
if(isset($_POST['get_club_images']))
{
    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `room_images` WHERE `club_id`=?", [$frm_data['get_club_images']], 'i');
    $path = CLUB_IMG_PATH;

    while($row = mysqli_fetch_assoc($res))
    {
        $thumb_btn = $row['thumb'] 
            ? "<i class='bi bi-check text-light bg-success px-2 py-1 rounded fs-5'></i>" 
            : "<button onclick='thumb_image($row[sr_no],$row[club_id])' class='btn btn-secondary shadow-none'><i class='bi bi-check'></i></button>";

        echo <<<data
        <tr class='align-middle'>
            <td><img src="{$path}{$row['image']}" class="img-fluid"></td>
            <td>$thumb_btn</td>
            <td>
                <button onclick="rem_image($row[sr_no],$row[club_id])" class="btn btn-danger shadow-none">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        data;
    }
}

// --- Remove club image ---
if(isset($_POST['rem_image']))
{
    $frm_data = filteration($_POST);
    $values = [$frm_data['image_id'], $frm_data['club_id']];

    $res = select("SELECT * FROM `room_images` WHERE `sr_no`=? AND `club_id`=?", $values, 'ii');
    $img = mysqli_fetch_assoc($res);

    if($img && deleteImage($img['image'], CLUB_FOLDER)){
        echo delete("DELETE FROM `room_images` WHERE `sr_no`=? AND `club_id`=?", $values, 'ii');
    } else {
        echo 0;
    }
}

// --- Set thumbnail image ---
if(isset($_POST['thumb_image']))
{
    $frm_data = filteration($_POST);
    update("UPDATE `room_images` SET `thumb`=0 WHERE `club_id`=?", [$frm_data['club_id']], 'i');
    echo update("UPDATE `room_images` SET `thumb`=1 WHERE `sr_no`=? AND `club_id`=?", [$frm_data['image_id'],$frm_data['club_id']], 'ii');
}

// --- Remove club + images ---
if(isset($_POST['remove_club']))
{
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `room_images` WHERE `club_id`=?", [$frm_data['club_id']], 'i');
    while($row = mysqli_fetch_assoc($res1)){
        deleteImage($row['image'], CLUB_FOLDER);
    }

    delete("DELETE FROM `room_images` WHERE `club_id`=?", [$frm_data['club_id']], 'i');

    echo delete("DELETE FROM `rooms` WHERE `id`=?", [$frm_data['club_id']], 'i') ? 1 : 0;
}
?>

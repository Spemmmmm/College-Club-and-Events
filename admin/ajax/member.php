<?php
require('../partials/db_config.php');
require('../partials/essentials.php');
adminLogin();

if(isset($_POST['add_member']))
{
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['picture'], MEMBER_FOLDER);

    if($img_r == 'inv_img'){
        echo $img_r;
    }
    else if($img_r == 'inv_size'){
        echo $img_r;
    }
    else if($img_r == 'upload_failed'){
        echo $img_r;
    }
    else{
        $q = "INSERT INTO `member`(`name`, `picture`,`email`,`phoneno`,`class`) VALUES (?,?,?,?,?)";
        $values = [$frm_data['name'], $img_r,$frm_data['email'],$frm_data['phoneno'],$frm_data['class']];
        $res = insert($q,$values,'sssss');
        echo $res;

    }
}

if(isset($_POST['get_member']))
{
    $res = selectAll('member');
    $i=1;
    $path = MEMBER_IMG_PATH;

    while($row = mysqli_fetch_assoc($res))
    {
        echo <<<data
        <tr>
            <td>$i</td>
            <td><img src="$path$row[picture]" style="height:205px; width:205px;"></td>
            <td>$row[name]</td>
            <td>$row[email]</td>
            <td>$row[phoneno]</td>
            <td>$row[class]</td>
            <td>
            <button type="button" onclick="rem_member($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
            <i class="bi bi-trash"></i> Delete
            </button>
            </td>
        </tr>
        data;
        $i++;
    }
}



if(isset($_POST['rem_member']))
{
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_member']];

    $pre_q = "SELECT * FROM `member` WHERE `sr_no`=?";
    $res = select($pre_q, $values,'i');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['picture'], MEMBER_FOLDER)){
        $q = "DELETE FROM `member` WHERE `sr_no`=?";
        $res = delete($q,$values,'i');
        echo $res;
    }
    else {
        echo 0;
    }
}

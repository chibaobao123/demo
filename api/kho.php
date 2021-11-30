<?php
	include("../config/config.php");
	
	if (isset($_GET['action']) && $_GET['action'] == 'getDungCu') {
		$sql = "SELECT * FROM kho_hang WHERE phan_loai LIKE '%dung cu%'";
		$rs = mysqli_query($db, $sql);
		$json_response = array();
		
		while($row = mysqli_fetch_assoc($rs)) {
			array_push($json_response, $row);
		}
		echo json_encode($json_response);
	}

    if (isset($_POST['action']) && $_POST['action'] == 'delDungCu') {

        $ma_sp = $_POST['ma_sp'];

		$sql = "DELETE FROM kho_hang WHERE ma_sp = '$ma_sp' ";;
		$rs = mysqli_query($db, $sql);
		if($rs) {
            echo "success";
        }
	}

	if (isset($_POST['action']) && $_POST['action'] == 'edit') {
		
		$ma_sp = $_POST['ma_sp'];
		$sl_moi = trim($_POST['sl_moi']);

	
		$rs = mysqli_query($db, "UPDATE kho_hang SET so_luong='$sl_moi' WHERE ma_sp='$ma_sp'");
		if($rs) {
			echo "success";
		}
	
	}

    if (isset($_GET['action']) && $_GET['action'] == 'getNuocNgot') {
		$sql = "SELECT * FROM kho_hang WHERE phan_loai LIKE '%nuoc ngot%'";
		$rs = mysqli_query($db, $sql);
		$json_response = array();
		
		while($row = mysqli_fetch_assoc($rs)) {
			array_push($json_response, $row);
		}
		echo json_encode($json_response);
	}

    die;
?>
<title>Kho Hàng</title>
<?php
	include("session.php");
	include("header.php");
?>
<section style='display:flex; width:100%'>
<div class='dungCuTrongKho' style='width:50%; margin:20px'></div>
<div class='nuocNgotTrongKho' style='width:50%; margin:20px'></div>
</section>


<script type='text/javascript'>
	$(document).ready(function() {

		getDungCuTrongKho();
		getNuocNgotTrongKho()

		function getDungCuTrongKho() {
			$.ajax({
				url: "./api/kho.php",
				type: "GET",
				cache: false,
				data: {
					action: "getDungCu",
				},
				success: function(msg) {

					// console.log(msg);

					var html = "";
					var data = $.parseJSON(msg);
					html += "<h1 style='text-align: center'>Dụng cụ cho thuê</h1>";
					html += "<table class='mytable mytable_dungcu' style='width:100%;text-align: center'>";
					html += "<thead><tr><th>Tên</th><th>Số lượng</th><th></th></tr></thead>";
					for (var i = 0; i < data.length; i++) {
						html += "<tr>";
						html += "<td>" + data[i].ten_sp + "</td>";
						html += "<td>" + data[i].so_luong + "</td>";
						html += "<td><button class='btnEditSp' order='" + (i + 1) + "'  ma_sp='" + data[i].ma_sp + "'>Chỉnh sửa</button><button class='btnDelSp' ma_sp='" + data[i].ma_sp + "'>Xóa</button></td>";
						html += "</tr>";

						
					}
					html += "</table>";
					$(".dungCuTrongKho").html(html);

					$(".btnEditSp").click(function() {
							$(this).attr("disabled", "disabled");
							var order = $(this).attr("order");
							var ma_sp = $(this).attr("ma_sp");
							var row = $(".mytable_dungcu tr")[order];
					

							var soLuong = $(row).find("td")[1];
							var so_luong = $(soLuong).text();
							$(soLuong).html("<input style='background:yellow;' id='soLuong-" + order + "' type='text' value='" + so_luong + "' /><br /><span class='thongbao'>" + THONG_BAO + "</span>");

							$("#soLuong-" + order).keyup(function(e) {
								if (e.keyCode == 27) {	// ESC
									$(soLuong).html(so_luong);
									$($(".btnEditSp")[order - 1]).removeAttr("disabled");
								}
								if (e.keyCode == 13) {	// ENTER
									var sl_moi = $("#soLuong-" + order).val();
									if(sl_moi >= 0) {
										suaSuaSoLuong(ma_sp, sl_moi);
										$(soLuong).html(sl_moi);
										$($(".btnEditSp")[order - 1]).removeAttr("disabled");
									}else{
										thongbaoloi("Không đúng định dạng!!!")
									}
								}
							});
						})

					
					$('.btnDelSp').on('click', function(){
						let ma_sp = $(this).attr('ma_sp');
						$.ajax({
								url: "./api/kho.php",
								type: "POST",
								cache: false,
								data: {
									action: "delDungCu",
									ma_sp: ma_sp
								},
								success: function(msg) {
									if(msg == 'success'){
										thongbaotot(msg);
										getDungCuTrongKho();		
									}else{
										thongbaoloi(msg);
									}
								}
							})
						});
				}
			})
		}

		function getNuocNgotTrongKho() {
			$.ajax({
				url: "./api/kho.php",
				type: "GET",
				cache: false,
				data: {
					action: "getNuocNgot",
				},
				success: function(msg) {

					// console.log(msg);

					var html = "";
					var data = $.parseJSON(msg);
					html += "<h1 style='text-align: center'>Nước ngọt trong kho</h1>";
					html += "<table class='mytable mytable_nuocngot' style='width:100%;text-align: center'>";
					html += "<thead><tr><th>Tên</th><th>Số lượng</th><th></th></tr></thead>";
					for (var i = 0; i < data.length; i++) {
						html += "<tr>";
						html += "<td>" + data[i].ten_sp + "</td>";
						html += "<td>" + data[i].so_luong + "</td>";
						html += "<td><button class='btnEditSp_nuoc' order='" + (i + 1) + "'  ma_sp='" + data[i].ma_sp + "'>Chỉnh sửa</button><button class='btnDelSp' ma_sp=" + data[i].ma_sp + ">Xóa</button></td>";
						html += "</tr>";
					}
					html += "</table>";
					$(".nuocNgotTrongKho").html(html);

					$(".btnEditSp_nuoc").click(function() {
							$(this).attr("disabled", "disabled");
							var order = $(this).attr("order");
							var ma_sp = $(this).attr("ma_sp");
							var row = $(".mytable_nuocngot tr")[order];
					

							var soLuong = $(row).find("td")[1];
							var so_luong = $(soLuong).text();
							$(soLuong).html("<input style='background:yellow;' id='soLuong-" + order + "' type='text' value='" + so_luong + "' /><br /><span class='thongbao'>" + THONG_BAO + "</span>");

							$("#soLuong-" + order).keyup(function(e) {
								if (e.keyCode == 27) {	// ESC
									$(soLuong).html(so_luong);
									$($(".btnEditSp_nuoc")[order - 1]).removeAttr("disabled");
								}
								if (e.keyCode == 13) {	// ENTER
									var sl_moi = $("#soLuong-" + order).val();
									if(sl_moi >= 0) {
										suaSuaSoLuong(ma_sp, sl_moi);
												
										$(soLuong).html(sl_moi);
										$($(".btnEditSp_nuoc")[order - 1]).removeAttr("disabled");
									}else{
										thongbaoloi("Không đúng định dạng!!!")
									}
								}
							});
						})

					$('.btnDelSp').on('click', function(){
						let ma_sp = $(this).attr('ma_sp');
						$.ajax({
								url: "./api/kho.php",
								type: "POST",
								cache: false,
								data: {
									action: "delDungCu",
									ma_sp: ma_sp
								},
								success: function(msg) {
									if(msg == 'success'){
										thongbaotot(msg);
										getNuocNgotTrongKho();		
									}else{
										thongbaoloi(msg);
									}
								}
							})
						});
							
				}
			})
		}


		function suaSuaSoLuong(ma_sp, sl_moi){
			$.ajax({
				url: "./api/kho.php",
				type: "POST",
				cache: false,
				data: {
					action: "edit",
					ma_sp: ma_sp,
					sl_moi: sl_moi,
				},
				success: function(msg) {
					if (msg == "success") {
						thongbaotot('Cập nhật thành công!!!');
						tailaitrang()
					} else {
						thongbaoloi(msg);
						tailaitrang()

					}
				},
				error: function() {
					alert("Khong the cap nhat !!!");
				}
			})
		}
	})
</script>
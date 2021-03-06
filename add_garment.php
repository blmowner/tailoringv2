<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Masukkan Ukuran Baju</title>

	<!-- css & script -->
	<?php include "layout/css_&_script.php"; ?>

</head>


<?php
	include "inc/conn.php";
	error_reporting(0);

	ob_start();
	session_start();

	if (empty($_SESSION[user_id]) AND empty($_SESSION[user_password]))
	{
	  echo "<center>Login Required!<br>";
	  echo "<a href=index.php><b>LOGIN</b></a></center>";
	}
	else
	{
?>

<body>
  <div class="container">

	 <!-- header & logo -->
	<?php include "layout/header_logo.php"; ?>

	<!-- navigator -->
	<?php include "layout/navigator.php"; ?>


	<div class="panel panel-warning">
      <div class="panel-heading">
        <h4 class="panel-title"><b>Masukkan Ukuran Baju</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";

	if(isset($_POST['addGarment']))
	{
		$g_type = $_POST['g_type'];
		$g_fabric = $_POST['g_fabric'];
		$g_color = $_POST['g_color'];
		$g_neck = $_POST['g_neck'];
		$g_shoulder = $_POST['g_shoulder'];
		$g_bust = $_POST['g_bust'];
		$g_waist = $_POST['g_waist'];
		$g_hips = $_POST['g_hips'];
		$g_length = $_POST['g_length'];
		$g_arm_hole = $_POST['g_arm_hole'];
		$g_others = $_POST['g_others'];
		$c_id = $_POST['c_id'];
		
		$labuh_seluar = $_POST['labuh_seluar'];
		$labuh_kain = $_POST['labuh_kain'];
		$labuh_jubah = $_POST['labuh_jubah'];
		$keliling_cawat = $_POST['keliling_cawat'];
		$keliling_peha = $_POST['keliling_peha'];
		$panjang_cawat = $_POST['panjang_cawat'];
		$panjang_tgn  = $_POST['panjang_tgn'];
		
		$file_location 	= $_FILES['g_image']['tmp_name'];
		$file_type		= $_FILES['g_image']['type'];
		$file_name		= $_FILES['g_image']['name'];
		move_uploaded_file($file_location,"cloth/$file_name");
		
		$insert = mysql_query("INSERT INTO garment (g_type, g_fabric, g_color, g_neck, g_shoulder, g_bust, g_waist, g_hips, g_length, g_arm_hole, labuh_seluar, labuh_kain, labuh_jubah, keliling_cawat, keliling_peha, panjang_cawat, panjang_tgn, g_others, g_image, c_id)
											VALUES ('$g_type', '$g_fabric', '$g_color', '$g_neck', '$g_shoulder', '$g_bust', '$g_waist', '$g_hips', '$g_length', '$g_arm_hole',  '$labuh_seluar', '$labuh_kain', '$labuh_jubah', '$keliling_cawat', '$keliling_peha', '$panjang_cawat', '$panjang_tgn', '$g_others', '$file_name', '$c_id')");

		if($insert == TRUE)
			echo "<script>swal('Terima kasih!', 'ukuran baju berjaya disimpan...', 'success'); setTimeout(function () {
                window.location.href = 'manage_garment.php'; 
             }, 2000);</script>";
		else
			echo "<script>swal('Maaf!', 'error...', 'error'); setTimeout(function () {
                
             }, 2000);</script>";
	}
	
	echo "<center><b style='color:red;'>** ukuran dalam centimeter(cm)</b></center><br />";
   ?>

<div class="container">
   <div class='row'>
      <div class='col-md-4'>
         <div class='form-group'>
            <button class='btn btn-success' data-toggle='modal' data-target='#myModal'>
              Lihat Langkah Ukuran (Perempuan)
            </button>
         </div>
      </div>

      <div class='col-md-4'>
         <div class='form-group'>
            <button class='btn btn-info' data-toggle='modal' data-target='#myModal2'>
              Lihat Langkah Ukuran (Lelaki)
            </button>
         </div>
      </div>

      <div class='col-md-4'>
         <div class='form-group'>
            <a href="downloads/seluar.docx" download="seluar">
               <button class='btn btn-primary'>
               Muat Turun Langkah (Lelaki)
               </button>
            </a>
         </div>
      </div>
   </div>
</div>

   <?php
	echo"<form id='garmentForm' class='well form-horizontal' enctype='multipart/form-data' method='post' runat='server'>

      <div class='row'>
         <div class='col-md-3'>
         </div>
         <div class='col-md-6'>
            <div class='form-group'>
            	<label class='col-xs-3 control-label'>ID Pelanggan</label>
            	<div class='col-xs-8'>
            		<input type='text' class='form-control' name='c_id' value='$_SESSION[user_id]' readonly />
            	</div>
            </div>
         </div>
         <div class='col-md-1'>
         </div>
      </div>

            <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                 	 <label class='col-xs-3 control-label'>Jenis Baju</label>
                 	 <div class='col-xs-8'>
                 		<select name='g_type' class='form-control'>
							<option value=''>:: pilih jenis baju ::</option>";
							
							$queryGT = mysql_query("SELECT * FROM garment_type");
							while($rowGT = mysql_fetch_array($queryGT))
								echo "<option value='$rowGT[gt_name]'>$rowGT[gt_name]</option>";
						echo"</select>
                 	 </div>
   		          </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>

            <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Jenis Kain</label>
                  	<div class='col-xs-8'>
                  		<select name='g_fabric' class='form-control' value='$g_fabric'>
                  		<option value=''>:: pilih jenis kain ::</option>";
                  		
                  		$queryFabric = mysql_query("SELECT * FROM fabric");
                  		while($rowFabric = mysql_fetch_array($queryFabric))
                  			echo "<option value='$rowFabric[f_name]'>$rowFabric[f_name]</option>";
                  	echo"</select>
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
            
            <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Warna Kain</label>
                  	<div class='col-xs-8'>
                  		<select name='g_color' class='form-control' value='$g_color'>
                  		<option value=''>:: pilih warna kain ::</option>";
                  		
                  		$queryColor = mysql_query("SELECT * FROM color");
                  		while($rowColor = mysql_fetch_array($queryColor))
                  			echo "<option value='$rowColor[c_name]'>$rowColor[c_name]</option>";
                  	echo"</select>
                  	</div>
                  </div>
                </div>
                <div class='col-md-1'>
                </div>
            </div>

            <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Ukuran keliling leher</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='g_neck' value='$g_neck' placeholder='Ukuran Keliling Leher' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
            
            <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Ukuran Lebar Bahu</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='g_shoulder' value='$g_shoulder' placeholder='Ukuran Lebar Bahu' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
		    
		    <div class='row'>
		       <div class='col-md-3'>
		       </div>
		       <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Ukuran Keliling Dada</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='g_bust' value='$g_bust' placeholder='Ukuran Keliling Dada' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>

		    <div class='row'>
		       <div class='col-md-3'>
		       </div>
		       <div class='col-md-6'>
                  <div class='form-group'>
                     <label class='col-xs-3 control-label'>Ukuran Keliling Pinggang</label>
                     <div class='col-xs-8'>
                     	<input type='number' step='0.01' class='form-control' name='g_waist' value='$g_waist' placeholder='Ukuran Keliling Pinggang' />
                     </div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>


		    <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                	 <label class='col-xs-3 control-label'>Ukuran Keliling Pinggul</label>
                	 <div class='col-xs-8'>
                		<input type='number' step='0.01' class='form-control' name='g_hips' value='$g_hips' placeholder='Ukuran Keliling Pinggul' />
                	 </div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
		    </div>
		
            <div class='row'>
              <div class='col-md-3'>
              </div>
              <div class='col-md-6'>
                 <div class='form-group'>
                	<label class='col-xs-3 control-label'>Ukuran Labuh Baju</label>
                	<div class='col-xs-8'>
                		<input type='number' step='0.01' class='form-control' name='g_length' value='$g_length' placeholder='Ukuran Labuh Baju' />
                	</div>
                 </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>

            <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Ukuran Bukaan Tangan</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='g_arm_hole' value='$g_arm_hole' placeholder='Ukuran Bukaan Tangan' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
			
			 <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Labuh Seluar</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='labuh_seluar' value='$labuh_seluar' placeholder='Labuh Seluar' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
			
			 <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Labuh Kain</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='labuh_kain' value='$labuh_kain' placeholder='Labuh Kain' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
			
			 <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Labuh Jubah</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='labuh_jubah' value='$labuh_jubah' placeholder='Labuh Juba' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
			
			 <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Keliling Cawat</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='keliling_cawat' value='$keliling_cawat' placeholder='Keliling Cawat' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
			
			 <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Keliling Peha</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='keliling_peha' value='$keliling_peha' placeholder='Keliling Peha' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
			
			 <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Panjang Cawat</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='panjang_cawat' value='$panjang_cawat' placeholder='Panjang Cawat' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
			
			 <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Panjang Tangan</label>
                  	<div class='col-xs-8'>
                  		<input type='number' step='0.01' class='form-control' name='panjang_tgn' value='$panjang_tgn' placeholder='Panjang Tangan' />
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>


            <div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
		          <div class='form-group'>
		          	<label class='col-xs-3 control-label'>Lain-lain</label>
		          	<div class='col-xs-8'>
		          		<textarea class='form-control' name='g_others' placeholder='masukkan maklumat tambahan mengenai pakaian anda' style='height:100px;'></textarea>
		          	</div>
		          </div>
		       </div>
		       <div class='col-md-1'>
		       </div>
		    </div>
			
			<div class='row'>
               <div class='col-md-3'>
               </div>
               <div class='col-md-6'>
                  <div class='form-group'>
                  	<label class='col-xs-3 control-label'>Contoh Baju</label>
                  	<div class='col-xs-8'>
                  		<input type='file' class='form-control' name='g_image' />
				** muatnaik contoh baju/pakaian.
                  	</div>
                  </div>
               </div>
               <div class='col-md-1'>
               </div>
            </div>
			

		    <div class='row'>
		       <div class='col-md-3'>
		       </div>
		       <div class='col-md-6'>
                  <div class='form-group'>
                  	<div class='col-xs-9 col-xs-offset-3'>
                  		<button type='reset' class='btn btn-default'>Reset</button>
                  		<button type='submit' class='btn btn-warning' name='addGarment'>Simpan</button>
                  	</div>
                  </div> 
               </div>
               <div class='col-md-1'>
               </div>
            </div>
		

		<!-- messages is where the messages are placed inside -->
		<div class=\"form-group\">
			<div class=\"col-md-9 col-md-offset-3\">
				<div id=\"messages\"></div>
			</div>
		</div>";
	?>

	<script>
	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        
	        reader.onload = function (e) {
	            $('#image_preview').attr('src', e.target.result);
	        }
	        
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#file_upload").change(function(){
	    readURL(this);
	});
	</script>

</form>

</div>
</div>


<script>
$(document).ready(function() {

    $('#garmentForm').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            g_type: {
                validators: {
                    notEmpty: {
                        message: 'Jenis Baju adalah wajib'
                    }
                }
            },
			g_fabric: {
                validators: {
                    notEmpty: {
                        message: 'Jenis kain adalah wajib'
                    }
                }
            },
			g_color: {
                validators: {
                    notEmpty: {
                        message: 'Warna adalah wajib'
                    }
                }
            },
			g_neck: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran leher adalah wajib'
                    }
                }
            },
			g_shoulder: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran bahu adalah wajib'
                    }
                }
            },
			g_bust: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran dada adalah wajib'
                    }
                }
            },
			g_waist: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran pinggang adalah wajib'
                    }
                }
            },
			g_hips: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran pinggul adalah wajib'
                    }
                }
            },
			g_length: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran panjang adalah wajib'
                    }
                }
            },
			g_arm_hole: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran lengan adalah wajib'
                    }
                }
            },
			g_others: {
                validators: {
                    notEmpty: {
                        message: 'Maklumat tambahan adalah wajib'
                    }
                }
            },
			g_image: {
                validators: {
                    notEmpty: {
                        message: 'Contoh baju adalah wajib'
                    }
                }
            }
        }
    });
});


function bootstrap_pagination()
{
	$( document ).ready(function() { 

	    pageSize = 1;
	    pagesCount = $(".content").length;
	    var currentPage = 1;
	    
	    /////////// PREPARE NAV ///////////////
	    var nav = '';
	    var totalPages = Math.ceil(pagesCount / pageSize);
	    for (var s=0; s<totalPages; s++){
	        nav += '<li class="numeros"><a href="#">'+(s+1)+'</a></li>';
	    }
	    $(".pag_prev").after(nav);
	    $(".numeros").first().addClass("active");
	    //////////////////////////////////////

	    showPage = function() {
	        $(".content").hide().each(function(n) {
	            if (n >= pageSize * (currentPage - 1) && n < pageSize * currentPage)
	                $(this).show();
	        });
	    }
	    showPage();


	    $(".pagination li.numeros").click(function() {
	        $(".pagination li").removeClass("active");
	        $(this).addClass("active");
	        currentPage = parseInt($(this).text());
	        showPage();
	    });

	    $(".pagination li.pag_prev").click(function() {
	        if($(this).next().is('.active')) return;
	        $('.numeros.active').removeClass('active').prev().addClass('active');
	        currentPage = currentPage > 1 ? (currentPage-1) : 1;
	        showPage();
	    });

	    $(".pagination li.pag_next").click(function() {
	        if($(this).prev().is('.active')) return;
	        $('.numeros.active').removeClass('active').next().addClass('active');
	        currentPage = currentPage < totalPages ? (currentPage+1) : totalPages;
	        showPage();
	    });
	});
}


bootstrap_pagination();


</script>

<hr>



  <!-- Modal -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
          <h4 class="modal-title" id="myModalLabel">Langkah-Langkah Ukuran (Perempuan)</h4>
        </div>
        <div class="modal-body">
           <div class="content">
              <img class="img-responsive" src="img/ukur/1.JPG"/>
            </div>
            <div class="content">
               <img class="img-responsive" src="img/ukur/2.JPG"/>
            </div>
            <div class="content">
               <img class="img-responsive" src="img/ukur/3.JPG"/>
            </div>
            <div class="content">
               <img class="img-responsive" src="img/ukur/4.JPG"/>
            </div>
            <div class="content">
               <img class="img-responsive" src="img/ukur/5.JPG"/>
            </div>
            <div class="content">
               <img class="img-responsive" src="img/ukur/6.JPG"/>
             </div>
             <div class="content">
                <img class="img-responsive" src="img/ukur/7.JPG"/>
             </div>
             <div class="content">
                <img class="img-responsive" src="img/ukur/8.JPG"/>
             </div>
             <div class="content">
                <img class="img-responsive" src="img/ukur/9.JPG"/>
             </div>
        </div>
        <div class="modal-footer">
           <nav class="text-center">
               <ul class="pagination">
                   <li class="pag_prev">
                       <a href="#" aria-label="Previous">
                           <span aria-hidden="true">&laquo;</span>
                       </a>
                   </li>
                   <li class="pag_next">
                       <a href="#" aria-label="Next">
                           <span aria-hidden="true">&raquo;</span>
                       </a>
                   </li>
               </ul>
           </nav>
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
          <h4 class="modal-title" id="myModalLabel2">Langkah-Langkah Ukuran (Lelaki)</h4>
        </div>
        <div class="modal-body">
           <div class="content2" style="padding-left:130px">
              <img class="img-responsive" src="img/ukur/cawat.JPG"/>
            </div>
            <div class="content2" style="padding-left:110px">
               <img class="img-responsive" src="img/ukur/labuhseluar.JPG"/>
            </div>
            <div class="content2" style="padding-left:100px">
               <img class="img-responsive" src="img/ukur/peha.JPG"/>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>


<!-- footer -->
<?php include "layout/footer.php"; ?>

</body>


</html>
<?php
	}
?>

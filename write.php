<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<h2>Input Kas</h2>

<div class="container">
  <form action="?submit=1" method="post">
    <div class="row">
      <div class="col-25">
        <label for="fname">Tanggal</label>
      </div>
      <div class="col-75">
        <input type="date" id="tanggal" name="tanggal" placeholder="Tanggal ..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Uraian</label>
      </div>
      <div class="col-75">
        <input type="text" id="uraian" name="uraian" placeholder="Uraian ..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Jumlah</label>
      </div>
      <div class="col-75">
        <input type="text" id="jumlah" name="jumlah" placeholder="Jumlah ..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="tipe">Tipe</label>
      </div>
      <div class="col-75">
        <select id="tipe" name="tipe">
          <option value="masuk">Masuk</option>
          <option value="keluar">Keluar</option>
        </select>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
  <?php
  	if(@$_GET["submit"]==1){
  		$fileOpen = file_get_contents('kas/kas.json');
  		$data = json_decode($fileOpen, TRUE);
      $tanggal = $_REQUEST["tanggal"];
      $uraian = $_REQUEST["uraian"];
      $jumlah = $_REQUEST["jumlah"];
      $tipe = $_REQUEST["tipe"];
  		$data["data"][] = array('tanggal' => $tanggal, 'uraian' => $uraian, 'jumlah' => $jumlah, 'tipe' => $tipe);
  		$newJsonString = json_encode($data);
		  file_put_contents('kas/kas.json', $newJsonString);
  	}
  	if(@$_GET["submit"]==2){
  		$fileOpen = file_get_contents('kas/kas.json');
  		$data = json_decode($fileOpen, TRUE);
  		array_splice($data["data"],$_GET["id"],sizeof($data["data"])-1);
  		$newJsonString = json_encode($data);
		file_put_contents('kas/kas.json', $newJsonString);
  	}
  ?>
  <table class="table table-bordered">
		<thead class="thead-dark">
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Uraian</th>
				<th>Jumlah</th>
				<th>Tipe</th>
			</tr>
		</thead>
		<tbody>
			<?php 			
				$fileOpen = file_get_contents('kas/kas.json');
  				$data = json_decode($fileOpen, TRUE);
  				for($i=0;$i<sizeof($data["data"]);$i++){
				?>
				<tr>
					<td><?php echo ($i+1); ?></td>
					<td><?php echo $data["data"][$i]['tanggal']; ?></td>
					<td><?php echo $data["data"][$i]['uraian']; ?></td>
					<td><?php echo $data["data"][$i]['jumlah']; ?></td>
					<td><?php echo $data["data"][$i]['tipe']; ?></td>
					<td><button onclick='window.location="?submit=2&id=<?php echo ($i); ?>"'>delete</button></td>
				</tr>
			<?php
				}
			?>
		</tbody>
	</table>
</div>

</body>
</html>

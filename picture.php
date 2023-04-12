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

#dashboard{
    margin: auto;
    margin-top:12px;
    text-align: center;
}

button {
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: auto;
    text-align: center;
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

.buttonclass{
    margin: auto;
    margin-top:12px;
    text-align: center;
}
</style>
</head>
<body>
<div class="container">
  <form id='dashboard' method='GET' action='https://fajarmuhf.my.id/'>
        <button>Back to Dashboard</button>
  </form>
  <form class='buttonclass' method='GET' action='write.php'>
        <button>Kas</button>
  </form>
  <h2>Ganti Background</h2>
  <form action="?submit=3" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-25">
        <label for="fname">Gambar</label>
      </div>
      <div class="col-75">
        <input type="file" name="image" id="image" accept="image/gif, image/jpeg, image/png">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Video</label>
      </div>
      <div class="col-75">
        <input type="file" name="video" id="video" accept="video/mp4">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Durasi Gambar</label>
      </div>
      <div class="col-75">
        <?php 
        $fileOpen = file_get_contents('kas/kas.json');
        $data = json_decode($fileOpen, TRUE);
        if(@$_GET["submit"]==3){
          $fileOpen = file_get_contents('kas/kas.json');
          $data = json_decode($fileOpen, TRUE);
          $data["intervalgambar"] = $_POST["interval"];
          $data["durasigambar"] = $_POST["durasi"];
          if(!(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name']))){
            $data["jumlahpicture"] = (int)$data["jumlahpicture"]+1;
            move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . "/kabah".$data["jumlahpicture"].".jpg");
          }
          if(!(!file_exists($_FILES['video']['tmp_name']) || !is_uploaded_file($_FILES['video']['tmp_name']))){
            move_uploaded_file($_FILES["video"]["tmp_name"], __DIR__ . "/kabah.mp4");
          }
          $newJsonString = json_encode($data);
          file_put_contents('kas/kas.json', $newJsonString);
        }
        if($data["durasigambar"]){
          echo "<input type='number' name='durasi' value='".$data["durasigambar"]."'>";
        }
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Interval Gambar</label>
      </div>
      <div class="col-75">
        <?php 
        $fileOpen = file_get_contents('kas/kas.json');
        $data = json_decode($fileOpen, TRUE);
        if($data["intervalgambar"]){
          echo "<input type='number' name='interval' value='".$data["intervalgambar"]."'>";
        }
        ?>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>

  <?php
    if(@$_GET["submit"]==3){
      echo "<h4>Success uploaded</h4>";
    }

    if(@$_GET["submit"]==2){
      $fileOpen = file_get_contents('kas/kas.json');
      $data = json_decode($fileOpen, TRUE);
      unlink("kabah".$_GET["id"].".jpg");
      for($i=$_GET["id"];$i<=$data["jumlahpicture"];$i++){
        rename("kabah".$i.".jpg","kabah".($i-1).".jpg");
      }
      $data["jumlahpicture"] = (int)$data["jumlahpicture"]-1;
      $newJsonString = json_encode($data);
      file_put_contents('kas/kas.json', $newJsonString);
      echo "<h4>Success deleted</h4>";
    }
  ?>
  <div style="overflow-x: scroll;">
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr class="row">
          <th class="col-16">No</th>
          <th class="col-16">Gambar</th>
        </tr>
      </thead>
      <tbody>
        <?php       
          $fileOpen = file_get_contents('kas/kas.json');
            $data = json_decode($fileOpen, TRUE);
            for($i=0;$i<$data["jumlahpicture"];$i++){
          ?>
          <tr class="row">
            <td class="col-16"><?php echo ($i+1); ?></td>
            <td class="col-16"><img src="kabah<?php echo ($i+1); ?>.jpg" width="200px" height="200px"></td>
            <td class="col-16"><button onclick='window.location="?submit=2&id=<?php echo ($i+1); ?>"'>delete</button></td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>
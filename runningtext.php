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
  <form class='buttonclass' method='GET' action='runningtextimsak.php'>
        <button>Running Text Imsak</button>
  </form>
  <form class='buttonclass' method='GET' action='runningtextfajr.php'>
        <button>Running Text Subuh</button>
  </form>
  <form class='buttonclass' method='GET' action='runningtextsyuruk.php'>
        <button>Running Text Syuruk</button>
  </form>
  <form class='buttonclass' method='GET' action='runningtextdzuhur.php'>
        <button>Running Text Dzuhur</button>
  </form>
  <form class='buttonclass' method='GET' action='runningtextjumatan.php'>
        <button>Running Text Jum'atan</button>
  </form>
  <form class='buttonclass' method='GET' action='runningtextashar.php'>
        <button>Running Text Ashar</button>
  </form>
  <form class='buttonclass' method='GET' action='runningtextmagrib.php'>
        <button>Running Text Magrib</button>
  </form>
  <form class='buttonclass' method='GET' action='runningtextisha.php'>
        <button>Running Text Isha</button>
  </form>
</div>
</body>
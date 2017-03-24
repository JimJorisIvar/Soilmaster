<?php
if ($login->isUserLoggedIn() == true && $login->checkUserLevel() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    include("adminHeader.php");

} elseif ($login->isUserLoggedIn() == true && $login->checkUserLevel() == false) {
    include("normalHeader.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("login.php"); }
?>

<div class="row">
  <div class="col-xs-12">
    <div class="card card-banner card-chart card-green no-br">
      <div class="card-body">
        <div>
            <div id="map" class="map_dashboard"></div>
            <?php include_once "dashboard_map.php"; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-green-light">
  <div class="card-body">
    <i class="icon fa fa-wifi fa-4x"></i>
    <div class="content">
    <!--Get most recent scan_id from the database from this day-->
      <div class="title">Scans vandaag</div>
      <div class="value"><span class="sign"></span>6</div>
    </div>
  </div>
</a>

  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-blue-light">
  <div class="card-body">
    <i class="icon fa fa-wifi fa-4x"></i>
    <div class="content">
        <!--Get most recent scan_id from the database in total-->
      <div class="title">Totaal aantal scans</div>
      <div class="value"><span class="sign"></span>13</div>
    </div>
  </div>
</a>

  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-yellow-light">
  <div class="card-body">
    <i class="icon fa fa-user-plus fa-4x"></i>
    <div class="content">
<!--        Get the number of total scanning devices-->
      <div class="title">Monteurs</div>
      <div class="value"><span class="sign"></span>32</div>
    </div>
  </div>
</a>

  </div>
</div>




<?php
include_once "footer.php";
?>

<?php

include_once "normalHeader.php";
include_once "../classes/lastscan.php";
?>
<!-- TEST -->
<?php
$stmt = $DB_con->prepare("SELECT * FROM waardes ORDER BY scan_id DESC");
$stmt->execute();
$result = $stmt->fetch();

$lood_measured = 26;
$lood_allowed = 30;
$lood_tussenwaarde = 25;

$zink_measured = 70;
$zink_allowed = 80;
$zink_tussenwaarde = 75;

$barium_measured = 42;
$barium_allowed = 50;
$barium_tussenwaarde = 45;

if ($lood_measured > $lood_allowed || $zink_measured > $zink_allowed || $$barium_measured > $barium_allowed ) {
  $color_modal = "danger";
  $text_modal = "Bodem is zwaar verontreinigd, er mag hier niet gegraven worden!";
  $maatregel_modal = " Graven NIET toegestaan";
  $icon_modal = "fa fa-exclamation-triangle";
} else {
  if ($lood_measured > $lood_tussenwaarde || $zink_measured > $zink_tussenwaarde || $barium_measured > $barium_tussenwaarde) {
      $color_modal = "warning";
      $text_modal = "Bodem enigsinds vervuild. Trek beschermende kleding aan.";
      $maatregel_modal = " Graven alleen toegestaan met veiligsheidsmaatregelen";
      $icon_modal = "fa fa-thumbs-o-up";
  } else {
    $color_modal = "success";
    $text_modal = "De bodem in niet verontreinigd. Graven toegestaan.";
    $maatregel_modal = " Graven toegestaan";
    $icon_modal = "fa fa-thumbs-o-up";
  }
}
?>
<!-- ///////TEST -->

<!-- Modal for the mechanic which shows the right warning according to the output of the scan. -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Scan gegevens:</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-<?php echo $color_modal; ?> alert-dismissible fade in" role="alert">
          <div class="row">
            <div class="col-md-1" style="width: 5%;">
                <h4 id="oh-snap!-you-got-an-error!" style="padding-left: 2px;"><i class="fa fa-calendar" aria-hidden="true"></i></h4>
            </div>
            <div class="col-md-8">
              <h4><?php echo $result[datum]; ?></h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1" style="width: 5%;">
              <h4 id="oh-snap!-you-got-an-error!"><i class="fa fa-wifi" aria-hidden="true" style="padding-right: 7px"></i></h4>
            </div>
            <div class="col-md-8">
              <h4>Scan ID: <?php echo $result[scan_id]; ?></h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1" style="width: 5%;">
              <h4 id="oh-snap!-you-got-an-error!" style="padding-left: 6px;"><i class="fa fa-map-marker" aria-hidden="true"></i></h4>
            </div>
            <div class="col-md-8">
              <h4><?php echo $result[naam_scan]; ?></h4>
            </div>
          </div>
            <p><?php echo $text_modal; ?></p>
            <p>
                <br>
                <span class="label label-<?php echo $color_modal; ?>"><i class="<?php echo $icon_modal; ?>" aria-hidden="true"></i><?php echo $maatregel_modal; ?></span>
                <br>
            </p>
        </div>
      </div>
      <div class="modal-footer">
        <div class="checkbox" style="text-align: left">
            <input type="checkbox" id="checkbox1" onchange="document.getElementById('btnClose').disabled = !this.checked;" />
            <label for="checkbox1">
                Hiermee bevestig ik de melding gelezen te hebben.
            </label>
            <button id="btnClose" type="button" style="float: right;" class="btn btn-sm btn-success" data-dismiss="modal" disabled="btnClose">Sluiten</button>
        </div>
      </div>
    </div>
  </div>
</div>
<a data-controls-modal="myModal"
   data-backdrop="static"
   data-keyboard="false"
   href="#">
<a class="btn alert-info" data-toggle="modal" href="#myModal" >Bekijk waarschuwing nogmaals</a>


<?php
include_once "footer.php"
?>


<!-- Script to show model only once per session -->
<script>
    $(document).ready(function ()
    {
        if(sessionStorage["PopupShown"] != 'yes'){
                $(window).on('load', function(){
                    $('#myModal').modal('show');
                });
        }

        $("#btnClose").click(function (e)
        {
            sessionStorage["PopupShown"] = 'yes';
        });
    });
</script>


<?php
include_once ("footer.php");
?>

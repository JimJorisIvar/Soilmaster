<!-- Modal for the result_graph.php page -->


<?php
// Query to get the selected scan from the result_graph.php page
// The scan_id is stored in a session called $sendid
$stmt = $DB_con->prepare("SELECT * FROM waardes where scan_id = '$sendid'");
$stmt->execute();
$result = $stmt->fetch();
// end of query

// check to compare the results of the scan against the intervention and warning values
// First if statements checks if the scan results are above the intervention values.
if (
  $result[lood_ppm] > $result[lood_intervene] ||
  $result[koper_ppm] > $result[koper_intervene] ||
  $result[zink_ppm] > $result[zink_intervene] ||
  $result[kwik_ppm] > $result[kwik_intervene] ||
  $result[cadmium_ppm] > $result[cadmium_intervene] ||
  $result[kobalt_ppm] > $result[kobalt_intervene]) {
    $color_modal = "danger";
    $text_modal = "Bodem is zwaar verontreinigd, er mag hier niet gegraven worden!";
    $take_action_modal = " Graven NIET toegestaan";
    $icon_modal = "fa fa-ban";
} else {
    // second if checks if the scan resuslts are in between the warning and intervention values.
  if (
    $result[lood_ppm] > $result[lood_warning] ||
    $result[koper_ppm] > $result[koper_warning] ||
    $result[zink_ppm] > $result[zink_warning] ||
    $result[kwik_ppm] > $result[kwik_warning] ||
    $result[cadmium_ppm] > $result[cadmium_warning] ||
    $result[kobalt_ppm] > $result[kobalt_warning]) {
      $color_modal = "warning";
      $text_modal = "Bodem enigsinds vervuild. Trek beschermende kleding aan.";
      $take_action_modal = " Graven alleen toegestaan met veiligsheidsmaatregelen";
      $icon_modal = "fa fa-exclamation-triangle";
  } else {
      // if the values are not above the interventon values nor in between the warning and intervention values, execute below
    $color_modal = "success";
      $text_modal = "De bodem in niet verontreinigd. Graven toegestaan.";
      $take_action_modal = " Graven toegestaan";
      $icon_modal = "fa fa-thumbs-o-up";
  }
}
// end of check

// Split the datetime stamp into date and time
$splitTimeStamp = explode(" ", $result[datum]);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];
// end of check
?>

<!-- Modal for the mechanic which shows the right warning according to the output of the scan. -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- modal header -->
      <div class="modal-header">
        <h4 class="modal-title">Scan resultaat</h4>
      </div>
      <!-- end modal header -->

      <!-- modal body -->
      <div class="modal-body">
        <div class="alert alert-<?php echo $color_modal; ?> alert-dismissible fade in" role="alert">
          <!-- Text of the modal -->
          <div class="row">
            <div class="col-md-11">
              <h4><?php echo $text_modal; ?></h4>
            </div>
          </div>
          <!-- end of text -->
          <!-- take action -->
          <div class="row" style="padding-top: 2%;">
            <div class="col-md-7" style="width: 5%;">
              <h3><span class="label label-<?php echo $color_modal; ?>"><i class="<?php echo $icon_modal; ?>" aria-hidden="true"></i><?php echo $take_action_modal; ?></span></h3>
              <br/>
            </div>
          </div>
          <!-- end of take action -->
          <div class="row" style="padding-top: 3%;">
            <!-- scan id -->
            <div class="col-md-1" style="width: 5%;">
              <h4><i class="fa fa-wifi" aria-hidden="true" style="padding-right: 7px"></i></h4>
            </div>
            <div class="col-md-2">
              <h4>Scan ID: <?php echo $result[scan_id]; ?></h4>
            </div>
            <!-- end of scan id -->
            <!-- scan date -->
            <div class="col-md-1" style="width: 5%;">
                <h4 style="padding-left: 2px;"><i class="fa fa-calendar" aria-hidden="true"></i></h4>
            </div>
            <div class="col-md-2">
              <h4><?php echo $date; ?></h4>
            </div>
            <!-- end of scan date -->
          </div>

          <div class="row">
            <!-- scan location -->
            <div class="col-md-1" style="width: 5%;">
              <h4 style="padding-left: 6px;"><i class="fa fa-map-marker" aria-hidden="true"></i></h4>
            </div>
            <div class="col-md-2">
              <h4><?php echo $result[naam_scan]; ?></h4>
            </div>
            <!-- end of scan location -->
            <!-- scan timestamp -->
            <div class="col-md-1" style="width: 5%;">
                <h4 style="padding-left: 3px;"><i class="fa fa-clock-o" aria-hidden="true"></i></h4>
            </div>
            <div class="col-md-2">
              <h4><?php echo $time; ?></h4>
            </div>
            <!-- end of scan timestamp -->
          </div>
        </div>
      </div>
      <!-- end of modal body -->

      <!-- modal footer -->
      <div class="modal-footer">
        <div class="checkbox checkbox<?php echo $color_modal; ?>" style="text-align: left">
            <!-- <input type="checkbox" id="checkbox1" onchange="document.getElementById('ButtonClose').disabled = !this.checked;" />
            <label for="checkbox1">
                Hiermee bevestig ik de melding gelezen te hebben.
            </label> -->
            <button id="ButtonClose" type="button" style="float: right;" class="btn btn-<?php echo $color_modal; ?>" data-dismiss="modal" >Sluiten</button>
        </div>
      </div>
      <!-- end of modal footer -->
    </div>
  </div>
</div>

<!-- button to show modal again -->
<a class="btn alert-info" data-toggle="modal" href="#myModal" >Bekijk waarschuwing nogmaals</a>
<!-- end of button -->

<?php
include_once "footer.php"
?>

<!-- Script to show model only once per session -->
<script>
    $(document).ready(function ()
    {
        if(sessionStorage["test"] != 'yes'){
                $(window).on('load', function(){
                    $('#myModal').modal('show');
                });
        }

        // $("#ButtonClose").click(function (e)
        // {
        //     sessionStorage["test"] = 'yes';
        // });
    });
</script>
<!-- end of script -->

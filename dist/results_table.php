<?php
include_once "adminHeader.php";
include_once "../classes/ListOfScans.php";
?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                scans
            </div>
            <div class="card-body no-padding">
                <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Scan ID</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Scan name</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $scanlist = new ListOfScans($DB_con); //er wordt een nieuwe lijst aangemaakt
                    $listofscans = $scanlist->getListOfScans();
                    foreach ($listofscans as $scan) { //in deze foreach loopt hij over ieder individuele scan en print hij de waarden in die array
                        echo '
                        <tr>
                            <td id="scanid">' . $scan->getScanid() . '</td>
                            <td>' . $scan->getDate() . '</td>
                            <td>' . $scan->getLocation() . '</td>
                            <td>' . $scan->getScanName() . '</td>
                            <td><button data-scanid="' . $scan->getScanid() . '" name="var_id[]" type="button" class="scan btn btn-success btn-xs">Result</button></td>
                        </tr>';}?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
<?php
include_once "footer.php";
?>


<script>
        $('.scan').click(function() {
        id = $(this).data('scanid');
        var postData = {
        'id': id
        };

        var url = "setSelected.php";

        $.ajax({
        type: "POST",
        url: url,
        data: postData,
        dataType: "json",
        success: function(data)
        {
        }

        });
            window.location.href='result_graph.php';
        });
</script>



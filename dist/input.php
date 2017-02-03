<?php
include_once "adminheader.php";
?>


<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <form method="post" action="inputPost.php" class="">
                        <div class="card">
                            <div class="card-header">
                                Scanned values (PPM)
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="antimoon" type="text" class="form-control" placeholder="Antimoon">
                                        <input name="arseen" type="text" class="form-control" placeholder="Arseen">
                                        <input name="barium" type="text" class="form-control" placeholder="Barium">
                                        <input name="cadmium" type="text" class="form-control" placeholder="Cadmium">
                                        <input name="" type="text" class="form-control" placeholder="">
                                        <input name="" type="text" class="form-control" placeholder="">
                                        <input name="" type="text" class="form-control" placeholder="">
                                        <input name="" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="location" type="text" class="form-control" placeholder="Location">
                                        <input name="temperature" type="text" class="form-control" placeholder="Temperature ºC">
                                        <input name="moisture" type="text" class="form-control" placeholder="Moisture %">
                                        <input name="scanname" type="text" class="form-control" placeholder="Scan name">
                                        <div>
                                            <select class="select2">
                                                <option value="AL">Jim Ebbelaar</option>
                                                <option value="WY">Jan Piet</option>
                                                <option value="WY">Herman Klaassen</option>
                                                <option value="WY">Freek Willem</option>
                                                <option value="WY">Pientje Van de berg</option>
                                                <option value="WY">Klaas Frederiks</option>
                                            </select>
                                        </div>
                                        <div>
                                            <div class="radio radio-inline">
                                                <input type="radio" name="radio2" id="radio5" value="option1">
                                                <label for="radio5">
                                                    Hamamatsu
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input type="radio" name="radio2" id="radio6" value="option2" checked>
                                                <label for="radio6">
                                                    Other scanning device
                                                </label>
                                            </div>
                                        </div>
                                        <textarea placeholder="Comments" name="name" rows="3" class="form-control"></textarea>
                                        <div class="checkbox">
                                            <input type="checkbox" id="checkbox1">
                                            <label for="checkbox1">
                                                I agree with the terms and conditions.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <hr>
                                        <button type="submit" class="btn btn-success">Send values to database</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
<!--        <div class="col-sm-12">-->
<!--            <div>-->
<!--                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">-->
<!--                    Demo modal-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
<!--                <div class="modal-dialog">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="modal-header">-->
<!--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--                            <h4 class="modal-title">Your values have been send to the database</h4>-->
<!--                        </div>-->
<!--                        <div class="modal-body">-->
<!--                            <p>Thanks for your sharing the your results.<br>-->
<!--                               You're data helps making working in the soil safer!-->
<!--                            </p>-->
<!--                        </div>-->
<!--                        <div class="modal-footer">-->
<!--                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>-->
<!--                            <button type="button" class="btn btn-sm btn-success">Another input</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<?php
include_once "footer.php";
?>
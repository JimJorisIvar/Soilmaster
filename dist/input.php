<?php
include_once "adminHeader.php";
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
                                <input name="lood" type="text" class="form-control" placeholder="Lood">
                                <input name="koper" type="text" class="form-control" placeholder="Koper">
                                <input name="zink" type="text" class="form-control" placeholder="Zink">
                                <input name="kwik" type="text" class="form-control" placeholder="Kwik">
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
                                <div class="checkbox checkbox-success">
                                    <input type="checkbox" id="checkbox1" onchange="document.getElementById('send-button').disabled = !this.checked;">
                                    <label for="checkbox1">
                                        I agree with the terms and conditions.
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <hr>
                                <button type="submit" class="btn btn-success" id="send-button" disabled="send-button">Send values to database</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<?php
include_once "footer.php";
?>

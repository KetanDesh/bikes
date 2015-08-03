<div class="container"  id="container" style="margin-top:62px;">
    <div class="row">
        <div class="col-sm-12" style="padding-top:30px;">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="dealerInfoM <?php if(isset($default)){ echo $default;} ?>"><a href="#dealer_info">View Dealer Data</a></li>
                    <li class="<?php  if(isset($dealerClass)){ echo $dealerClass; } ?>" id="dealerM"><a id="add_dealerM" href="#add_dealer">Add Dealer</a></li>
                    <li class="bikeM <?php if(isset($bikeClass)){ echo $bikeClass;} ?>"><a id="add_bikeM" href="#add_bike">Add Bike</a></li>
                    
                </ul>
            </div>
            <div class="tab-content">
                <div id="dealer_info" class="tab-pane fade in col-md-12 <?php  if(isset($default)){echo $default;} ?>" style="padding-top:60px;"><!-- Add bike form -->
                    <div class="">
                        <?php echo form_open('Dealer_data/dealer_search#dealer_info','class="form-horizontal col-sm-offset-5"');?>
                        <p>Select Dealer</p>
                        <select id="dealerSearchDrp" name="dealerSearchDrp" style="">
                                <option>Select Dealer</option>
                            </select>
                        <?php echo form_close() ?>
                        <div id="searchInfo" class="col-sm-12" style="margin:26px 0  36px 0;overflow:scroll;"></div>
                    </div>
                </div>
                
                <div id="add_dealer" class="tab-pane fade in <?php  if(isset($dealerClass)){ echo $dealerClass; } ?>" style="padding-top:120px;">
                    <?php //echo validation_errors('<div class="error col-md-5 col-md-offset-4" style="padding-top:20px;">', '</div>');
                        if(isset($msg)){
                            echo "<div class='col-md-5 col-md-offset-4 dealerMsg' style='padding-top:20px;'><p>$msg</p></div>";
                        }
                    ?>
                    <div class="col-md-offset-1">
                        <?php echo form_open('dealer_data/add_dealer_data','class="form-horizontal col-sm-offset-2"');?>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="dealerName" id="dealerName" value="" placeholder="Dealer Name" autofocus="true" required="true">
                            </div> 
                        </div> 
                        <div class="form-group">    
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="description" id="description" placeholder="Description" >
                            </div>
                        </div>
                        <div class="form-group">    
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" required="true">
                            </div>
                        </div>
                        <div class="form-group">    
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="location" id="location" placeholder="Location" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10"> <button type="submit" id="submit" class="btn btn-primary btn-lg">Submit</button> </div> 
                        </div>
                        <?php echo form_close();?>
                    </div>
                </div><!-- add_dealer end -->
                
                <div id="add_bike" class="tab-pane fade in col-md-12 <?php if(isset($bikeClass)){ echo $bikeClass;} ?>"><!-- Add bike form -->
                    <?php //echo validation_errors('<div class="error col-md-5 col-md-offset-4" style="padding-top:20px;">', '</div>');
                        if(isset($msg1)){
                            echo "<div class='col-md-12 col-md-offset-4 bikeMsg' style='padding-top:20px;'><p>$msg1</p></div>";
                        }
                    ?>
                    <div style="padding-top:66px;">
                        <?php echo form_open('dealer_data/add_bike_data#add_bike','class="form-horizontal"');?>
                        <?php /*echo form_dropdown('dealerDrp',$dealerlist,'','class="required" id="dealerDrp"');*/?> 
                        
                        <select id="dataDealerDrp" name="dataDealerDrp" required="true">
                            <option>Select Dealer1</option>
                        </select>
                        <select name="datamakeDrp" id="datamakeDrp" required="true">
                            <option value="">Select Make</option>
                        </select>
                        <select name="datmodelDrp" id="datmodelDrp" required="true">
                            <option value="">Select Model</option>
                        </select>
                        <select name="datavariantDrp" id="datavariantDrp" required>
                            <option value="">Select Variant</option>
                        </select>
                        <div id="datadumbikeinfo" style="padding-top:30px;overflow: scroll;">
                            
                            <table style='width:30%'>
                                <tr style="background-color: gray;"> <th>Select </th><th>cc </th><th>AnalogMeter </th><th>DigitalMeter </th><th>Tachometer</th><th>DTSi</th><th>Kick Start</th> <th>Self Start</th> <th>Wheel Type</th> <th>Rear Brake</th><th>Front Brake</th><th>ABS</th>
                                    <th>Digital Meter</th><th>Manufactured Year</th><th>Discontinued Year</th><th>Color</th>
                                </tr>
                                <tr><td><input type='radio' name='bikeId' id='bikeId' value="" >
                                </td> <td></td><td></td><td></td><td></td><td></td><td></td> <td></td> <td></td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>  
                            </table>   
                        </div>
                        <div id="databikeInfo"  style="padding-top:30px;overflow: scroll;"></div><br>
                        <div class="form-group col-sm-3" style="margin-right: 0%;">
                            <input type="text" class="form-control" name="minPrice" id="minPrice" value="" placeholder="Enter Min Price" required="true"> 
                        </div>
                        <div class="form-group col-sm-3" style="margin-right: 0%;">
                            <input type="text" class="form-control" name="maxPrice" id="maxPrice" value="" placeholder="Enter Max Price" required="true">
                        </div>
                        <div class="form-group col-sm-3" style="margin-right: 0%;">
                            <input type="text" class="form-control" name="year" id="year" value="" placeholder="Enter Year" required="true">
                        </div>
                        <div class="form-group col-sm-3">
                            <div class=""> <button type="submit" id="submit1" class="btn btn-primary btn-md">Submit</button> </div> 
                            <!--<a id="bikesubmit" class='btn btn-primary' >Submit</a-->
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div><!-- Add bike form -->
            </div>
        </div>
    </div>
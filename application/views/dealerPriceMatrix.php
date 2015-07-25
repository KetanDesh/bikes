<div class="container"  id="container" style="margin-top:66px;">
    <div class="row">
        <div class="col-sm-12" style="padding-top:30px;">
        <lable>Select Model:</lable>
        <?php
            echo form_dropdown('countriesDrp',$countryDrop,'','class="required" id="makeDrp"');
        ?>    
        <select name="modelDrp" id="modelDrp">
            <option value="">Select Model</option>
        </select>
        <select name="variantDrp" id="variantDrp">
            <option value="">Select Variant</option>
        </select>
        <div id="dumbikeinfo" style="padding-top:10px;overflow: scroll;">
            <table style='width:30%'>
                <tr style="background-color: gray;"> <th>Select </th><th>cc </th><th>AnalogMeter </th><th>DigitalMeter </th><th>Tachometer</th><th>DTSi</th><th>Kick Start</th> <th>Self Start</th> <th>Wheel Type</th> <th>Rear Brake</th><th>Front Brake</th><th>ABS</th>
                    <th>Digital Meter</th><th>Manufactured Year</th><th>Discontinued Year</th><th>Color</th>
                </tr>
                <tr><td><input type='radio' name='bikeId' id='bikeId' value="" >
                </td> <td></td><td></td><td></td><td></td><td></td><td></td> <td></td> <td></td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>  
            </table>   
        </div>
        <div id="bikeInfo"  style="padding-top:10px;overflow: scroll;"></div><br>
        
        <select name="locationDrp" id="locationDrp">
            <option>Select Location </option>
        </select>

        <select name="yearDrp" id="yearDrp">
            <option value="">-- Select Year--</option>
            <?php 
               // $cur_year = intval(date('Y')); // current Year
            $datestring = "%Y";
            $time = now();
            $year_val = mdate($datestring, $time);
                for ($x = 0; $x < 8; $x++) {
                    $cur_val = intval($year_val-$x);
                    echo "<option value={$cur_val}>{$cur_val} </option>"; 
                }
             ?>
        </select>

        <select name="monthDrp" id="monthDrp">
            <option value="">-- Select Month --</option>
            <?php $cur_month = date('n'); // current month
                $cur_year = intval(date('Y'));
                $diff =0;
                if(isset($_GET["year"]) && $_GET["year"]==  $cur_year)
                    $diff = 12 - $cur_month;
                for ($x = 1; $x <= 12 - $diff; $x++) {
                    $month_val = date('m', mktime(0,0,0,$x,1));
                    if($month_val == $month)
                        echo "<option selected value={$month_val}> ".date('F', mktime(0,0,0,$x,1))."</option>";
                    else
                       echo "<option value={$month_val}> ".date('F', mktime(0,0,0,$x,1))."</option>";
                 } 
             ?>
        </select>
        <input type="text" name="distance" id="distance" value ="" placeholder="Distance(KM)" >
        <input type="text" name="on_rd_price" id="on_rd_price" value ="" placeholder="On road price">
        <a id="submit" class='btn btn-primary' >Submit</a>
        <div id="result">
        </div>
        </div>
    </div><!-- row -->
</div><!-- container end -->
</body>
</head>

        
        



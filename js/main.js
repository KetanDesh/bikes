$(document).ready(function(){
    //$("#dealerM").addClass("active");
    var baseurl =document.location.origin+'/bikes';
    var location = window.location.hash;
    
    $.ajax({url:baseurl+"/index.php/dealer_data/get_dealer_list",data:{},type:"GET",
        success:function(data){
            $("#dataDealerDrp").html(data);
            $("#dealerSearchDrp").html(data);
        }
    });
    $.ajax({url:baseurl+"/index.php/dealer_data/get_make_list",data:{},type:"GET",
        success:function(data){
            $("#datamakeDrp").html(data);
        }
    });
    $("#maxPrice").blur(function(){
        var min = $("#minPrice").val();
        var max = $("#maxPrice").val();
        if(min > max){
            $("#maxPrice").focus();   
        }
    });
    $.ajax({url:baseurl+"/index.php/lead_funnel_analysis/get_type",data:{},type:"GET",
        success:function(data){
            $("#type").html(data);;
        }
    });
    $.ajax({url:baseurl+"/index.php/lead_funnel_analysis/get_city",data:{},type:"GET",
        success:function(data){
            $("#city").html(data);;
        }
    });
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $("#submit1").click(function(){
        var location = window.location.hash;
       //console.log(window.location.hash); 
    });
    $("#popup").click(function(){
        $("#dealerInfo").css('display','block');
        $("#popup").css('display','block');
    });
    $("#popup1").click(function(){
        $("#dealerInfo").css('display','none');
        $("#addBike").css('display','block');
    });
    $("#makeDrp").change(function(){
        $.ajax({url:baseurl+"/index.php/valuation/getModel",data:{id:$(this).val()},type:"GET",
            success:function(data){
                $("#modelDrp").html(data);
            }
        });
    });
    $("#modelDrp").change(function(){
        var make = $( "#makeDrp option:selected" ).text();
        $.ajax({url:baseurl+"/index.php/valuation/getVariant",data:{id:make,model:$(this).val()},type:"GET",
            success:function(data){
                $("#variantDrp").html(data);
            }
        });
    });
    $("#variantDrp").change(function(){
        var make = $( "#makeDrp option:selected" ).text();
        var model = $( "#modelDrp option:selected" ).text();
        $("#dumbikeinfo").css("display","none");

        $.ajax({url:baseurl+"/index.php/valuation/getInfo",data:{id:make,model:model,variant:$(this).val()},type:"GET",
            success:function(data){
                $("#bikeInfo").html(data);
            }
        });
    });
    $("body").on("click",'#bikeId',function(){
        console.log("inside bike");
        $.ajax({url:baseurl+"/index.php/valuation/getLocationByBikeid",data:{bikeid:$(this).val()},type:"GET",
            success:function(data){
                $("#locationDrp").html(data);
            }
        });
    });
    $("#locationDrp").change(function(){
        var make = $( "#makeDrp option:selected" ).text();
        var model = $( "#modelDrp option:selected" ).text();
        var variant = $( "#variantDrp option:selected" ).text();
        var bikeId = $('input:radio[name=bikeId]:checked').val();
        $.ajax({url:baseurl+"/index.php/BikeValuation/api",data:{make:make,model:model,variant:variant,bikeId:bikeId,locId:$(this).val(),web:'yes'},type:"GET",
            success:function(data){
                $("#result").html(data);
            }
        });
    });

    $("#yearDrp").change(function(){
        var make = $( "#makeDrp option:selected" ).text();
        var model = $( "#modelDrp option:selected" ).text();
        var variant = $( "#variantDrp option:selected" ).text();
        var bikeId = $('input:radio[name=bikeId]:checked').val();
        var locId = $( "#locationDrp option:selected" ).val();
        $.ajax({url:baseurl+"/index.php/BikeValuation/api",data:{make:make,model:model,variant:variant,bikeId:bikeId,locId:locId,year:$(this).val(),web:'yes'},type:"GET",
            success:function(data){
                $("#result").html(data);
            }
        });
    });
    $("#monthDrp").change(function(){
        var make = $( "#makeDrp option:selected" ).text();
        var model = $( "#modelDrp option:selected" ).text();
        var variant = $( "#variantDrp option:selected" ).text();
        var bikeId = $('input:radio[name=bikeId]:checked').val();
        var locId = $( "#locationDrp option:selected" ).val();
        var year = $( "#yearDrp option:selected" ).val();
        $.ajax({url:baseurl+"/index.php/BikeValuation/api",data:{make:make,model:model,variant:variant,bikeId:bikeId,locId:locId,year:year,month:$(this).val(),web:'yes'},type:"GET",
            success:function(data){
                $("#result").html(data);
            }
        });
    });
    $("#submit").click(function(){
        console.log("in");
        var make = $( "#makeDrp option:selected" ).text();
        var model = $( "#modelDrp option:selected" ).text();
        var variant = $( "#variantDrp option:selected" ).text();
        var bikeId = $('input:radio[name=bikeId]:checked').val();
        var locId = $( "#locationDrp option:selected" ).val();
        var year = $( "#yearDrp option:selected" ).val();
        var month = $( "#monthDrp option:selected" ).val();
        var distance = $("#distance").val();
        var on_rd_price =$("#on_rd_price").val();
        console.log("Distance="+distance);
        $.ajax({url:baseurl+"/index.php/BikeValuation/api",data:{make:make,model:model,variant:variant,bikeId:bikeId,locId:locId,year:year,month:month,distance:distance,on_rd_price:on_rd_price,web:'yes'},type:"GET",
            success:function(data){
                $("#result").html(data);
            }
        });
    });
    $("#insertDealer").click(function(){
        var dealerName = $("#dealerName").val();
        var description = $("#description").val();
        var pincode = $("#pincode").val();
        var location = $("#location").val();
        var on_rd_price =$("#on_rd_price").val();

        $.ajax({url:baseurl+"/index.php/Dealer_data/add_bike_data",data:{dealerName:dealerName,description:description,pincode:pincode,location:location},type:"GET",
            success:function(data){
                $("#result").html("<h3>Insert Succes</h3>");
            }
        });
    });
    $(document).on('keyup','#distance,#on_rd_price,#minPrice,#maxPrice,#year,#pincode', function(event) {
        var v = this.value;
        if($.isNumeric(v) === false) {
            //alert("Please enter number");
            //chop off the last char entered
            this.value = this.value.slice(0,-1);
        }
    });
    $("#datamakeDrp").change(function(){
        $.ajax({url:baseurl+"/index.php/Valuation/getModel",data:{id:$(this).val()},type:"GET",
            success:function(data){
                $("#datmodelDrp").html(data);
            }
        });
    });
    $("#datmodelDrp").change(function(){
        var make = $( "#datamakeDrp option:selected" ).text();
        $.ajax({url:baseurl+"/index.php/Valuation/getVariant",data:{id:make,model:$(this).val()},type:"GET",
            success:function(data){
                $("#datavariantDrp").html(data);
            }
        });
    });
    $("#datavariantDrp").change(function(){
        var make = $( "#datamakeDrp option:selected" ).text();
        var model = $( "#datmodelDrp option:selected" ).text();
        var variant = $( "#datavariantDrp option:selected" ).text();
        $("#datadumbikeinfo").css("display","none");
        $.ajax({url:baseurl+"/index.php/Valuation/getInfo",data:{id:make,model:model,variant:$(this).val()},type:"GET",
            success:function(data){
                $("#databikeInfo").html(data);
            }
        });
    });
    $("body").on("click",'#databikeId',function(){
        console.log("inside bike");
        $.ajax({url:baseurl+"/index.php/Valuation/getLocationByBikeid",data:{bikeid:$(this).val()},type:"GET",
            success:function(data){
                $("#locationDrp").html(data);
            }
        });
    });
    $("#dealerSearchDrp").change(function(){
        //$("#datadumbikeinfo").css("display","none");
        $.ajax({url:baseurl+"/index.php/Dealer_data/dealer_search",data:{dealerID:$(this).val()},type:"GET",
            success:function(data){
                $("#searchInfo").html(data);
            }
        });
    });
// Date validation 
    
     
     

});
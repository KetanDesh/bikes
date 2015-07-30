<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo "$title"; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link href="<?php echo base_url()?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>/css/style.css" rel="stylesheet">
        <script src="<?php echo base_url()?>js/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>js/main.js"></script>
<!--    <script src="<?php echo base_url()?>js/paggination.js"></script>-->
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}
.bikeInfo{overflow: scroll;}
.dumbikeinfo{padding-top:10px;}
</style>
<script>
    
</script> 
</head>
<body style="margin-top:-14px;">
<nav class="navbar navbar-inverse navbar-fixed-top hidden-xs" role="navigation">
    <ul class="nav navbar-nav">
        <li style="height: 51px; width: 205px; background: url('<?php echo base_url().'images/logo.jpg' ?>') no-repeat scroll 0 0 / 212px 64px transparent;"><a></a></li>
        <li class="active"><a href="<?php echo base_url();?>">Credr.com</a></li>

        <li class="dropdown active">
            <a class="dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Valuation
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="min-width:200px;">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url().'index.php/Valuation' ?>">Sourcing</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url().'index.php/Dealer_data#add_dealer' ?>">Dealer's Data</a></li>
            </ul>
        </li>
        <li class="dropdown active">
            <a class="dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Refurbishment
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Api(json)</a></li>
              <li role="presentation" class="divider"></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"></a></li>
            </ul>
        </li>
        <li class="active"><a class="dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Rating
            <span class="caret"></span></a>
        </li>
        <li class="active"><a href="<?php echo base_url().'index.php/Lead_call_funnel' ?>">Lead Funnel Analysis</a></li>
    </ul> 
</nav>   
        
        
        



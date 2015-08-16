<!DOCTYPE html>
<html>
    <head>
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url("css/materialize.min.css"); ?>"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/style.css"); ?>">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>
    </head>

    <body>
	<nav>
	    <div class="navbar-fixed">
		<a href="#" class="brand-logo">Logo</a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
		    <li><a href="sass.html">Sass</a></li>
		    <li><a href="badges.html">Components</a></li>
		    <li><a href="<?php echo site_url("/assistant/logout"); ?>">Logout</a></li>
		</ul>
	    </div>
	</nav>
    
	<div class="row">
	    <div class="col s3 m3 left-pane">
		<div class="order">
                    <div class="details">
                        <ul class="collection with-header">
                            <li class="collection-header"><h5>Pending</h5></li>
                        <?php
                            foreach($orders["pending"] AS $pending)
                            { ?>
                            <li class="collection-item avatar">
                                <i class="material-icons circle red"></i>
                                <span class ="Title"><b><?php echo $pending->title; ?></b></span>
                                <p>Date: <?php echo date("F d, Y", (int) $pending->date); ?></p>
                                <p>Items: <?php echo count($pending->items); ?></p>
                                <a href="<?php echo site_url("/order/view/" . $pending->id); ?>" class="secondary-content cater"><i class="material-icons">View</i></a>
                            </li>
                        <?php
                            } ?>
                        </ul>
                    </div>
                 
		    <div class="details">
			<ul class="collection with-header">
                            <li class="collection-header"><h5>Serving</h5></li>
		    	<?php
                            foreach($orders["serving"] AS $serving)
                            { ?>
                            <li class="collection-item avatar">
		    		<i class="material-icons circle yellow"></i>
		    		<span class ="Title"><b><?php echo $serving->title; ?></b></span>
                                <p>Served By: <?php echo $serving->assistant->name; ?></p>
				<a href="<?php echo site_url("/order/finalize/" . $serving->id); ?>" class="secondary-content cater"><i class="material-icons">Finalize</i></a>
		    	    </li>
                        <?php
                            } ?>
		    	</ul>
		    </div>
                    
		    <div class="details">
			<ul class="collection with-header">
                            <li class="collection-header"><h5>Done</h5></li>
		    	<?php
                            foreach($orders["done"] AS $done)
                            { ?>
                            <li class="collection-item avatar">
		    		<i class="material-icons circle green"></i>
		    		<span class ="Title"><b><?php echo $done->title; ?></b></span>
                                <p>Served By: <?php echo $done->assistant->name; ?></p>
				<a href="<?php echo site_url("/order/details/" . $done->id); ?>" class="secondary-content cater"><i class="material-icons">Details</i></a>
			    </li>
                        <?php
                            } ?>
		    	</ul>
		    </div>
		    
		</div>
	    </div>
	    <!-- /.left-pane -->
	    <div class="col s9 m9 right-pane">
        <?php
            if($leaf)
                $this->load->view("order/" . $leaf, array("order" => $order, "assistant" => $assistant)); ?>
	    </div> <!-- /.right-pane -->
	</div>
        
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url("js/materialize.min.js"); ?>"></script>
    </body>
</html>

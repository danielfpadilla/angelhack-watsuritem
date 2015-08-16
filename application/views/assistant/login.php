<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url("css/materialize.min.css"); ?>"  media="screen,projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/style.css"); ?>" />
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
        <?php
            echo validation_errors();
            echo form_open("assistant/login"); ?>
            <div class="row">
                <div class="col offset-s4 s4 offset-m4 m4">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="https://trello-attachments.s3.amazonaws.com/55cf52353b0d138ba05a4184/500x500/439b03b83a1055f01fd3af892ab176a9/ahagsa.png">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Store Login</span>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="code" name="code" type="text" class="required" />
                                    <label for="code">Code</label>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="card-action">
                            <button class="btn waves-effect waves-light btn-large" type="submit" name="action">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url("js/materialize.min.js"); ?>"></script>
    </body>
</html>
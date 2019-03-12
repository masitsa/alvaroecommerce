<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo $title;?></title>

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<?php if(isset($login)){?>
<link href="<?php echo base_url();?>assets/themes/custom/login.css" rel="stylesheet">
<?php } else{?>
<link href="<?php echo base_url();?>assets/themes/custom/styles.css" rel="stylesheet">
<?php }?>
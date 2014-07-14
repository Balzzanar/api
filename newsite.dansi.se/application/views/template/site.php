<?php echo $header; ?>

<?php echo $main; ?>

<?php 
	/* Not all ppages have a footer. */
	echo (isset($footer) ? $footer : ''); 
?>
<?php 
/*
* Package: View
* Controller: Newproducts
*
* The start page for dansi.se
*
*/
?>

<?php #echo form_open_mulitpart('newproducts/upload');?>
<form class="form-horizontal" action="newproducts/newproduct" method="post" enctype="multipart/form-data">
<div class="span6 new-product-form"> <!-- Form Start -->	
	<div class="well new-product-form">
		<b>Produktnamn och bild</b>
	</div>
	<div class="new-product-form">
        <div>
       		<input type="file" class="form-control" placeholder="img" name="userfile">
        </div>

        <div>
	        <input type="text" class="form-control" placeholder="Produkt Namn" name="p_name">
        </div>

	<div>
                <input type="text" class="form-control" placeholder="Pris" name="p_price">
        </div>

	<div>
                <input type="text" class="form-control" placeholder="Beskrivning" name="p_description">
                <input id="cur_cat" type="text" name="p_cat">
        </div>

	<div>
		<div class="btn-group">
		  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
		    <div id="category-button">Kategori</div>
		    <span class="caret"></span>
		  </a>
		  <ul class="dropdown-menu">
	                  <li><a href="javascript:setActiveCategory('1')">Örhänge</a></li>
        	          <li><a href="javascript:setActiveCategory('2')">Halsband</a></li>
                	  <li><a href="javascript:setActiveCategory('3')">Armband</a></li>
		  </ul>
		</div>	
	</div>

        <div>
		<br />
                <button type="submit" class="btn btn-default">Skapa</button>
        </div>
	
</div>
	
	<br />
	<br />

</div>

	
</form>
</div> <!-- Form END -->

<div class="clear" ></div>
<div class="span12">
	<div class="well span6">
                <b>Befintliga prdukter</b>
        </div>
	<table class="span12 table table-striped">
	  <tr>
	  	<th>Namn</th>
	  	<th>Pris</th>
	  	<th>Beskrivning</th>
	  	<th>Bild</th>
	  	<th>Kategori</th>
	  	<th>Ta bort</th>
	  </tr>
	  <?php foreach ($products as $prod):?>
	  <tr>
	  	<td><?php echo $prod->name; ?></td>
	  	<td><?php echo $prod->price; ?></td>
	  	<td><?php echo $prod->descript; ?></td>
	  	<td><?php echo $prod->img; ?></td>
	  	<td><?php echo ''; ?></td>
	  	<td><a href="#">X</a></td>
	  </tr>
	<?php endforeach; ?>
	</table>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
<script src="public/bootstrap/js/holder.js"></script>
<script src="public/js/scripts.js"></script>

<script>
$(document).ready(function() {
	$('#cur_cat').hide();
});
</script>

</body>
</html>


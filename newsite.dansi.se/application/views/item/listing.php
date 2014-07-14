<?php 
/*
* Package: View
* Controller: Item
*
* The items view for dansi.se
*
*/

?>

<div class="container">

    <hr class="featurette-divider">

    <?php $index = 0; ?>
    <?php foreach($products as $product): ?>
        <?php if($index == 0): ?>
            <div class="row featurette">
        <?php endif; ?>

            <div class="col-md-3 col-sm-3 col-xs-6">
                <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                <br />
                <h4 class="featurette-heading"><?php echo $product->name; ?></h4>
            </div>

        <?php $index++; ?>
        <?php if($index == 4): ?>
            </div><!-- /.row -->
            <?php $index = 0; ?>
        <?php endif; ?>

    <?php endforeach; ?>
    <?php if($index > 0): ?>
        </div><!-- /.row -->
    <?php endif; ?>

</div><!-- /.container -->




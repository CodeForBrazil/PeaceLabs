<?php if (!empty($errors)): ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error;?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>

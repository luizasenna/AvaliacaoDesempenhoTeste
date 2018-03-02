<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_delete_confirm_title"><?php echo app('translator')->get($model.'/modal.title'); ?></h4>
</div>
<div class="modal-body">
    <?php if($error): ?>
        <div><?php echo $error; ?></div>
    <?php else: ?>
        <?php echo app('translator')->get($model.'/modal.body'); ?>
    <?php endif; ?>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get($model.'/modal.cancel'); ?></button>
  <?php if(!$error): ?>
    <a href="<?php echo e($confirm_route); ?>" type="button" class="btn btn-danger"><?php echo app('translator')->get($model.'/modal.confirm'); ?></a>
  <?php endif; ?>
</div>

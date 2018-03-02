<?php $__env->startSection('content'); ?>
<p>Hello <?php echo $user->first_name; ?>,</p>

<p>Welcome to SiteNameHere! Please click on the following link to confirm your SiteNameHere account:</p>

<p><a href="<?php echo $activationUrl; ?>"><?php echo $activationUrl; ?></a></p>

<p>Best regards,</p>

<p><?php echo app('translator')->get('general.site_name'); ?> Team</p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
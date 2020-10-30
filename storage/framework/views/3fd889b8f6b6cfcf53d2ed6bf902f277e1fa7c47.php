<?php $__env->startSection('content'); ?> 
<!-- BEGIN LOGIN -->
<div class="content"> 
    <!-- BEGIN FORGOT PASSWORD FORM --> 
    <?php if(session('status')): ?>
    <div class="note note-info">
        <h4 class="block">Email Sent!</h4>
        <p> An email with password reset link has been sent to your provided email address. </p>
    </div>
    <?php else: ?>
    <form class="form-horizontal forget-form" role="form" method="POST" action="<?php echo e(route('admin.password.email')); ?>" style="display:block;">
        <?php echo e(csrf_field()); ?>

        <h3 class="font-green">Forgot Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter Email please. </span> </div>
        <?php if($errors->has('email')): ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span><?php echo e($errors->first('email')); ?></span> </div>
        <?php endif; ?>
        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>"> 
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email Address" name="email" value="<?php echo e(old('email')); ?>" />
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase pull-right">Send Password Reset Link</button>
        </div>
    </form>
    <?php endif; ?> 
    <!-- END FORGOT PASSWORD FORM --> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.login_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
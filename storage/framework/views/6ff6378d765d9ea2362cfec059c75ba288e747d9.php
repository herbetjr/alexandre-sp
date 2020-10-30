<?php
$lang = config('default_lang');
if (isset($video))
    $lang = $video->lang;
$lang = MiscHelper::getLang($lang);
$direction = MiscHelper::getLangDirection($lang);
$queryString = MiscHelper::getLangQueryStr();
?>
<?php echo APFrmErrHelp::showErrorsNotice($errors); ?>

<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="form-body">        
    <?php echo Form::hidden('id', null); ?>

    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'lang'); ?>" id="lang_div">
        <?php echo Form::select('lang', ['' => 'Select Language']+$languages, $lang, ['class'=>'form-control', 'id'=>'lang', 'onchange'=>'setLang(this.value);']); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'lang'); ?>                                       
    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'video_title'); ?>">
        <?php echo Form::label('video_title', 'Video Title', ['class' => 'bold']); ?>

        <?php echo Form::text('video_title', null, array('class'=>'form-control', 'id'=>'video_title', 'placeholder'=>'Video Title', 'dir'=>$direction)); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'video_title'); ?>

    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'video_text'); ?>">
        <?php echo Form::label('video_text', 'Video Text', ['class' => 'bold']); ?>

        <?php echo Form::textarea('video_text', null, array('class'=>'form-control', 'id'=>'video_text', 'placeholder'=>'Video Text', 'dir'=>$direction)); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'video_text'); ?>

    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'video_link'); ?>">
        <?php echo Form::label('video_link', 'Video Link', ['class' => 'bold']); ?>

        <?php echo Form::text('video_link', null, array('class'=>'form-control', 'id'=>'video_link', 'placeholder'=>'Video Link', 'dir'=>$direction)); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'video_link'); ?>

    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'is_default'); ?>">
        <?php echo Form::label('is_default', 'Is default?', ['class' => 'bold']); ?>

        <div class="radio-list">
            <?php
            $is_default_1 = 'checked="checked"';
            $is_default_2 = '';
            if (old('is_default', ((isset($video)) ? $video->is_default : 1)) == 0) {
                $is_default_1 = '';
                $is_default_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="default" name="is_default" type="radio" value="1" <?php echo e($is_default_1); ?> onchange="showHideVideoId();">
                Yes </label>
            <label class="radio-inline">
                <input id="not_default" name="is_default" type="radio" value="0" <?php echo e($is_default_2); ?> onchange="showHideVideoId();">
                No </label>
        </div>			
        <?php echo APFrmErrHelp::showErrors($errors, 'is_default'); ?>

    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'video_id'); ?>" id="video_id_div">
        <?php echo Form::label('video_id', 'Default Video', ['class' => 'bold']); ?>                    
        <?php echo Form::select('video_id', ['' => 'Select Default Video']+$videos, null, array('class'=>'form-control', 'id'=>'video_id')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'video_id'); ?>                                       
    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'is_active'); ?>">
        <?php echo Form::label('is_active', 'Is Active?', ['class' => 'bold']); ?>

        <div class="radio-list">
            <?php
            $is_active_1 = 'checked="checked"';
            $is_active_2 = '';
            if (old('is_active', ((isset($video)) ? $video->is_active : 1)) == 0) {
                $is_active_1 = '';
                $is_active_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="active" name="is_active" type="radio" value="1" <?php echo e($is_active_1); ?>>
                Active </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" <?php echo e($is_active_2); ?>>
                In-Active </label>
        </div>			
        <?php echo APFrmErrHelp::showErrors($errors, 'is_active'); ?>

    </div>	
    <div class="form-actions">
        <?php echo Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')); ?>

    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    function setLang(lang) {
        window.location.href = "<?php echo url(Request::url()) . $queryString; ?>" + lang;
    }
    function showHideVideoId() {
        $('#video_id_div').hide();
        var is_default = $("input[name='is_default']:checked").val();
        if (is_default == 0) {
            $('#video_id_div').show();
        }
    }
    showHideVideoId();
</script>
<?php $__env->stopPush(); ?>
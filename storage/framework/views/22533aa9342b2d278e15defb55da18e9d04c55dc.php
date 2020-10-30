<?php $__env->startSection('content'); ?>
<!-- Header start -->
<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Header end -->
<!-- Inner Page Title start -->
<?php echo $__env->make('includes.inner_page_title', ['page_title'=>__('Company Detail')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- Job Header start -->
        <div class="job-header">
            <div class="jobinfo">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <!-- Candidate Info -->
                        <div class="candidateinfo">
                            <div class="userPic"><a
                                    href="<?php echo e(route('company.detail',$company->slug)); ?>"><?php echo e($company->printCompanyImage()); ?></a>
                            </div>
                            <div class="title"><?php echo e($company->name); ?></div>
                            <div class="desi"><?php echo e($company->getIndustry('industry')); ?></div>
                            <div class="loctext"><i class="fa fa-history" aria-hidden="true"></i>
                                <?php echo e(__('Member Since')); ?>, <?php echo e($company->created_at->format('M d, Y')); ?></div>
                            <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?php echo e($company->location); ?></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div style="display:none;" class="col-md-4 col-sm-4">
                        <!-- Candidate Contact -->
                        <div class="candidateinfo">
                            <?php if(!empty($company->phone)): ?>
                            <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <a
                                    href="tel:<?php echo e($company->phone); ?>"><?php echo e($company->phone); ?></a></div>
                            <?php endif; ?>
                            <?php if(!empty($company->email)): ?>
                            <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <a
                                    href="mailto:<?php echo e($company->email); ?>"><?php echo e($company->email); ?></a></div>
                            <?php endif; ?>
                            <?php if(!empty($company->website)): ?>
                            <div class="loctext"><i class="fa fa-globe" aria-hidden="true"></i> <a
                                    href="<?php echo e($company->website); ?>" target="_blank"><?php echo e($company->website); ?></a></div>
                            <?php endif; ?>
                            <div class="cadsocial"> <?php echo $company->getSocialNetworkHtml(); ?> </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="jobButtons"> <?php if(Auth::check() && Auth::user()->isFavouriteCompany($company->slug)): ?> <a
                    href="<?php echo e(route('remove.from.favourite.company', $company->slug)); ?>" class="btn"><i
                        class="fa fa-floppy-o" aria-hidden="true"></i> <?php echo e(__('Favourite Company')); ?> </a> <?php else: ?> <a
                    href="<?php echo e(route('add.to.favourite.company', $company->slug)); ?>" class="btn"><i class="fa fa-floppy-o"
                        aria-hidden="true"></i> <?php echo e(__('Add to Favourite')); ?></a> <?php endif; ?> <a
                    href="<?php echo e(route('report.abuse.company', $company->slug)); ?>" class="btn report"><i
                        class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php echo e(__('Report Abuse')); ?></a> <a
                    href="javascript:;" onclick="send_message()" class="btn"><i class="fa fa-envelope"
                        aria-hidden="true"></i> <?php echo e(__('Send Message')); ?></a> </div>
        </div>

        <!-- Job Detail start -->
        <div class="row">
            <div class="col-md-8">
                <!-- About Employee start -->
                <div class="job-header">
                    <div class="contentbox">
                        <h3><?php echo e(__('About Company')); ?></h3>
                        <p><?php echo $company->description; ?></p>
                    </div>
                </div>
                <div class="job-header">
                    <div class="contentbox">
                        <h3 style="padding-bottom: 20px;"><?php echo e(__('Work history and feedback')); ?></h3>
                        <div class="" id="projects_div">
                            <?php $__currentLoopData = $projectFeedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($o->jobApply['isCandidateContractStatus'] == "close" && $o->jobApply['isEmployeerContractStatus'] == "close"): ?>
                                <div class="project-review">
                                    <h4><?php echo e($o->jobDetails->title); ?></h4>
                                    <div class="rating">
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <div class="rateyo" data-rateyo-rating="<?php echo e($o->rating); ?>"
                                                     data-rateyo-num-stars="5" data-rateyo-score="3">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <span style="padding: 0;margin-top: -5px; margin-right: 3px; font-weight: bold;">
                                                    <?php if(strpos($o->rating, ".")): ?>
                                                        <?php echo e($o->rating); ?>0
                                                    <?php else: ?>
                                                        <?php echo e($o->rating); ?>.00
                                                    <?php endif; ?>
                                                </span>
                                                <span><?php echo e(\Carbon\Carbon::parse($o->created_at)->format('M Y')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="padding: 5px 0;">
                                        <?php echo e($o->feedback); ?>

                                    </p>
                                </div>
                                <hr>
                                <?php elseif($o->jobApply['isCandidateContractStatus'] == "close"
                                         && $o->jobApply['isEmployeerContractStatus'] == "open" ||
                                          $o->jobApply['isCandidateContractStatus'] == "open"
                                         && $o->jobApply['isEmployeerContractStatus'] == "close"): ?>

                                    <?php if($o->jobApply['CandidateCloseContract'] <= Carbon\Carbon::now()->subDays(90)): ?>
                                        <div class="project-review">
                                            <h4><?php echo e($o->jobDetails->title); ?></h4>
                                            <div class="rating">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <span><?php echo e(\Carbon\Carbon::parse($o->CandidateCloseContract)->format('M Y')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p style="padding: 5px 0;">
                                                No feedback given
                                            </p>
                                        </div>
                                        <hr>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <!-- Opening Jobs start -->
                <div class="relatedJobs">
                    <h3><?php echo e(__('Job Openings')); ?></h3>
                    <ul class="searchList">
                        <?php if(isset($company->jobs) && count($company->jobs)): ?>
                        <?php $__currentLoopData = $company->jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $companyJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!--Job start-->
                        <li>
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="jobimg"><a href="<?php echo e(route('job.detail', [$companyJob->slug])); ?>"
                                            title="<?php echo e($companyJob->title); ?>"> <?php echo e($company->printCompanyImage()); ?> </a></div>
                                    <div class="jobinfo">
                                        <h3><a href="<?php echo e(route('job.detail', [$companyJob->slug])); ?>"
                                                title="<?php echo e($companyJob->title); ?>"><?php echo e($companyJob->title); ?></a></h3>
                                        <div class="companyName"><a href="<?php echo e(route('company.detail', $company->slug)); ?>"
                                                title="<?php echo e($company->name); ?>"><?php echo e($company->name); ?></a></div>
                                        <div class="location">
                                            <label class="fulltime"
                                                title="<?php echo e($companyJob->getJobType('job_type')); ?>"><?php echo e($companyJob->getJobType('job_type')); ?></label>
                                            <label class="partTime"
                                                title="<?php echo e($companyJob->getJobShift('job_shift')); ?>"><?php echo e($companyJob->getJobShift('job_shift')); ?></label>
                                            - <span><?php echo e($companyJob->getCity('city')); ?></span></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="listbtn"><a
                                            href="<?php echo e(route('job.detail', [$companyJob->slug])); ?>"><?php echo e(__('View Detail')); ?></a>
                                    </div>
                                </div>
                            </div>
                            <p><?php echo e(str_limit(strip_tags($companyJob->description), 150, '...')); ?></p>
                        </li>
                        <!--Job end-->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <!-- Job end -->
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Company Detail start -->
                <div class="job-header">
                    <div class="jobdetail">
                        <h3><?php echo e(__('Company Detail')); ?></h3>
                        <ul class="jbdetail">
                            <li class="row">
                                <div class="col-md-6 col-xs-6"><?php echo e(__('Is Email Verified')); ?></div>
                                <div class="col-md-6 col-xs-6"><span><?php echo e(((bool)$company->verified)? 'Yes':'No'); ?></span>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-md-6 col-xs-6"><?php echo e(__('Total Employees')); ?></div>
                                <div class="col-md-6 col-xs-6"><span><?php echo e($company->no_of_employees); ?></span></div>
                            </li>
                            <li class="row">
                                <div class="col-md-6 col-xs-6"><?php echo e(__('Established In')); ?></div>
                                <div class="col-md-6 col-xs-6"><span><?php echo e($company->established_in); ?></span></div>
                            </li>
                            <li class="row">
                                <div class="col-md-6 col-xs-6"><?php echo e(__('Current jobs')); ?></div>
                                <div class="col-md-6 col-xs-6">
                                    <span><?php echo e($company->countNumJobs('company_id',$company->id)); ?></span></div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Google Map start -->
                <div class="job-header">
                    <div class="jobdetail"><?php echo $company->map; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="sendmessage" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="" id="send-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="company_id" id="company_id" value="<?php echo e($company->id); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send Message</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="message" cols="10" rows="7"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>
<?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<style type="text/css">
.formrow iframe {
    height: 78px;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $(function () {
        $(".rateyo").rateYo({
            readOnly: true,
            starWidth: "10px",
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
        });
    });
    $(document).on('click', '#send_company_message', function() {
        var postData = $('#send-company-message-form').serialize();
        $.ajax({
            type: 'POST',
            url: "<?php echo e(route('contact.company.message.send')); ?>",
            data: postData,
            //dataType: 'json',
            success: function(data) {
                response = JSON.parse(data);
                var res = response.success;
                if (res == 'success') {
                    var errorString = '<div role="alert" class="alert alert-success">' +
                        response.message + '</div>';
                    $('#alert_messages').html(errorString);
                    $('#send-company-message-form').hide('slow');
                    $(document).scrollTo('.alert', 2000);
                } else {
                    var errorString = '<div class="alert alert-danger" role="alert"><ul>';
                    response = JSON.parse(data);
                    $.each(response, function(index, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul></div>';
                    $('#alert_messages').html(errorString);
                    $(document).scrollTo('.alert', 2000);
                }
            },
        });
    });
});

function send_message() {
    const el = document.createElement('div')
    el.innerHTML =
        "Please <a class='btn' href='<?php echo e(route('login')); ?>' onclick='set_session()'>log in</a> as a Canidate and try again."
    <?php if(Auth::check()): ?>
    $('#sendmessage').modal('show');
    <?php else: ?>
    swal({
        title: "You are not Loged in",
        content: el,
        icon: "error",
        button: "OK",
    });
    <?php endif; ?>
}
if ($("#send-form").length > 0) {
    $("#send-form").validate({
        validateHiddenInputs: true,
        ignore: "",

        rules: {
            message: {
                required: true,
                maxlength: 5000
            },
        },
        messages: {

            message: {
                required: "Message is required",
            }

        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            <?php if(null !== (Auth::user())): ?>
            $.ajax({
                url: "<?php echo e(route('submit-message')); ?>",
                type: "POST",
                data: $('#send-form').serialize(),
                success: function(response) {
                    $("#send-form").trigger("reset");
                    $('#sendmessage').modal('hide');
                    swal({
                        title: "Success",
                        text: response["msg"],
                        icon: "success",
                        button: "OK",
                    });
                }
            });
            <?php endif; ?>
        }
    })
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
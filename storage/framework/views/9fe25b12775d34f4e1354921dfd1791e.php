<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Email Templates')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Email Templates')); ?></li>
<?php $__env->stopSection(); ?>

<?php
$setting = App\Models\Utility::settings();
$LangName = $currEmailTempLang->language;

?>

<?php $__env->startPush('css-page'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
<script src="<?php echo e(asset('js/tinymce/tinymce.min.js')); ?>"></script>
<script>
    if ($(".pc-tinymce-2").length) {
        tinymce.init({
            selector: '.pc-tinymce-2',
            height: "400",
            content_style: 'body { font-family: "Inter", sans-serif; }'
        });
    }
</script>
<script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
<script src="<?php echo e(asset('js/editorplaceholder.js')); ?>"></script>

<script>
    $(document).ready(function () {
        $.each($('.ckdescription'), function (i, editor) {

            CKEDITOR.replace(editor, {
                extraPlugins: 'editorplaceholder',
                editorplaceholder: editor.placeholder,

                removeButtons : 'Source,Save,NewPage,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CopyFormatting,RemoveFormat,Blockquote,BidiLtr,BidiRtl,Language,Anchor,Image,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,About,Maximize,ShowBlocks,TextColor,BGColor,Format,Font,FontSize'

            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('multiple-action-button'); ?>
<div class="text-end mb-3">
    <div class="d-flex justify-content-end drp-languages">
        <ul class="list-unstyled mb-0 m-2">
            <li class="dropdown dash-h-item drp-language" style="list-style-type: none;">
                <a
                class="dash-head-link dropdown-toggle arrow-none me-0"
                data-bs-toggle="dropdown"
                href="#"
                role="button"
                aria-haspopup="false"
                aria-expanded="false"
                >
                <span class="drp-text hide-mob text-primary"><?php echo e(__('Locale: ')); ?><?php echo e(ucFirst($LangName->fullName)); ?></span>
                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                      <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('manage.email.language', [$emailTemplate->id, $code])); ?>"
                        class="dropdown-item <?php echo e($currEmailTempLang->lang == $code ? 'text-primary' : ''); ?>"><?php echo e(ucFirst($lang)); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </li>
        </ul>
        <ul class="list-unstyled mb-0 m-2">
            <li class="dropdown dash-h-item drp-language" style="list-style-type: none;">
                <a class="dash-head-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="drp-text hide-mob text-primary"><?php echo e(__('Template: ')); ?> <?php echo e($emailTemplate->name); ?></span>
                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                    <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('manage.email.language', [$EmailTemplate->id,(Request::segment(3)?Request::segment(3):\Auth::user()->lang)])); ?>"
                    class="dropdown-item <?php echo e($emailTemplate->name == $EmailTemplate->name ? 'text-primary' : ''); ?>"><?php echo e($EmailTemplate->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </li>
        </ul>
        <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
        <ul class="list-unstyled mb-0 m-2">
            <li class="dropdown dash-h-item drp-language" style="list-style-type: none;">
                <a class="btn btn-primary btn-sm float-end" style="height:35px; margin-top:3px;" href="#" data-size="md" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['email template'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate Content with AI')); ?>"><i class="fas fa-robot"> <?php echo e(__('Generate with AI')); ?></i></a>
            </li>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



    <div class="row">

        <div class="col-12">
            <div class="row">

            </div>
            <div class="card">
                <div class="card-body">

                    <div class="language-wrap">
                        <div class="row">
                            <h6><?php echo e(__('Place Holders')); ?></h6>
                            <div class="col-lg-12 col-md-9 col-sm-12 language-form-wrap">

                                <div class="card">
                                    <div class="card-header card-body">
                                        <div class="row text-xs">
                                            <?php if($emailTemplate->slug=='new_ticket'): ?>
                                                <div class="row">
                                                    
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Ticket Name')); ?> : <span class="pull-right text-primary">{ticket_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Ticket Id')); ?> : <span class="pull-right text-primary">{ticket_id}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Email')); ?> : <span class="pull-right text-primary">{email}</span></p>
                                                    <p class="col-6"><?php echo e(__('Password')); ?> : <span class="pull-right text-primary">{password}</span></p>
                                                </div>
                                            <?php elseif($emailTemplate->slug=='new_ticket_reply'): ?>
                                                <div class="row">
                                                    
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Ticket Name')); ?> : <span class="pull-right text-primary">{ticket_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Ticket Id')); ?> : <span class="pull-right text-primary">{ticket_id}</span></p>
                                                    <p class="col-6"><?php echo e(__('Ticket Description')); ?> : <span class="pull-right text-primary">{ticket_description}</span></p>

                                                </div>
                                            <?php elseif($emailTemplate->slug=='new_user'): ?>
                                                <div class="row">
                                                    
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Email')); ?> : <span class="pull-right text-primary">{email}</span></p>
                                                    <p class="col-6"><?php echo e(__('Password')); ?> : <span class="pull-right text-primary">{password}</span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-9 col-sm-12 language-form-wrap">
                                <?php echo e(Form::model($currEmailTempLang, array('route' => array('email_template.update', $currEmailTempLang->parent_id), 'method' => 'PUT'))); ?>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <?php echo e(Form::label('subject',__('Subject'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('subject',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('name',__('Name'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('name',$emailTemplate->name,['class'=>'form-control font-style','disabled'=>'disabled'])); ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('from',__('From'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('from', $emailTemplate->from, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group col-12">
                                        <?php echo e(Form::label('content',__('Email Message'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::textarea('content',$currEmailTempLang->content,array('class'=>'ckdescription','required'=>'required'))); ?>


                                    </div>


                                    <div class="col-md-12 text-end">
                                        <?php echo e(Form::hidden('lang',null)); ?>

                                        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-print-invoice  btn-primary">
                                    </div>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/main-file/resources/views/email_templates/show.blade.php ENDPATH**/ ?>
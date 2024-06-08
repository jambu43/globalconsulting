<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo = Utility::get_superadmin_logo();
    $logos = \App\Models\Utility::get_file('uploads/logo/');

    $lang = app()->getLocale();
    if ($lang == 'ar' || $lang == 'he') {
        $settings['SITE_RTL'] = 'on';
    }
    $LangName = \App\Models\Languages::where('code', $lang)->first();
    if (empty($LangName)) {
        $LangName = new App\Models\Utility();
        $LangName->fullName = 'English';
    }
    $setting = App\Models\Settings::colorset();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if(isset($setting['color_flag']) && $setting['color_flag'] == 'true')
    {
        $themeColor = 'custom-color';
    }
    else {
        $themeColor = $color;
    }
    $settings = \App\Models\Utility::settings();

    config([
        'captcha.secret' => $settings['NOCAPTCHA_SECRET'],
        'captcha.sitekey' => $settings['NOCAPTCHA_SITEKEY'],
        'options' => [
            'timeout' => 30,
        ],
    ]);
?>
<?php $__env->startSection('content'); ?>
    <div class="custom-login">
        <div class="login-bg-img">
            
            <img src="<?php echo e(isset($setting['color_flag']) && $setting['color_flag'] == 'false' ? asset('assets/images/auth/' . $themeColor . '.svg') : asset('assets/images/auth/theme-3.svg')); ?>" class="login-bg-1">

            <img src="<?php echo e(asset('assets/images/user2.svg')); ?>" class="login-bg-2">
        </div>
        <div class="bg-login bg-primary"></div>
        <div class="custom-login-inner">

            <nav class="navbar navbar-expand-md default">
                <div class="container pe-2">
                    <div class="navbar-brand">
                        <a href="#">
                            <img src="<?php echo e($logos . $logo . '?timestamp=' . time()); ?>"
                                alt="<?php echo e(config('app.name', 'TicketGo Saas')); ?>" alt="logo" loading="lazy"
                                class="logo" />
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarlogin">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarlogin">
                        <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('home')); ?>"><?php echo e(__('Create Ticket')); ?></a>
                            </li>

                            <li class="nav-item">
                                <?php if($settings['FAQ'] == 'on'): ?>
                                    <a class="nav-link" href="<?php echo e(route('faq')); ?>"><?php echo e(__('FAQ')); ?></a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <?php if($settings['Knowlwdge_Base'] == 'on'): ?>
                                    <a href="<?php echo e(route('knowledge')); ?>" class="nav-link"><?php echo e(__('Knowledge')); ?></a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('search')); ?>"><?php echo e(__('Search Ticket')); ?></a>
                            </li>
                            <div class="lang-dropdown-only-desk">
                                <li class="dropdown dash-h-item drp-language">
                                    <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span class="drp-text"> <?php echo e(ucfirst($LangName->fullName)); ?>

                                        </span>
                                    </a>
                                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                                        <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('login', $code)); ?>" tabindex="0"
                                                class="dropdown-item dropdown-item <?php echo e($LangName->code == $code ? 'active' : ''); ?>">
                                                <span><?php echo e(ucFirst($language)); ?></span>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="custom-wrapper">
                <div class="custom-row">

                        <div class="card">

                            <div class="card-body">
                                <div>
                                    <h2 class="mb-3 f-w-600"><?php echo e(__('Login')); ?>

                                           </h2>
                                </div>
                                <?php if(session('error')): ?>
                                <div class="alert alert-danger">
                                    <?php echo e(session('error')); ?>

                                </div>
                                <?php endif; ?>
                                <form method="POST" action="<?php echo e(route('login')); ?>" id="form_data">
                                    <?php echo csrf_field(); ?>
                                    <?php if(session()->has('info')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('info')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(session()->has('status')): ?>
                                        <div class="alert alert-info">
                                            <?php echo e(session()->get('status')); ?>

                                        </div>
                                    <?php endif; ?>

                                    <div class="custom-login-form">
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label d-flex"><?php echo e(__('Email')); ?></label>
                                            <input type="email"
                                                class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                                                id="email" name="email" placeholder="<?php echo e(__('Enter your email')); ?>"
                                                required="" value="<?php echo e(old('email')); ?>">
                                            <div class="invalid-feedback d-block">
                                                <?php echo e($errors->first('email')); ?>

                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label d-flex"><?php echo e(__('Password')); ?></label>
                                            <input type="password"
                                                class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                                id="password" name="password" placeholder="<?php echo e(__('Enter Password')); ?>"
                                                required="" value="<?php echo e(old('password')); ?>">
                                            <div class="invalid-feedback d-block">
                                                <?php echo e($errors->first('password')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between">

                                                <span><a href="<?php echo e(route('password.request',$lang)); ?>"
                                                        tabindex="0"><?php echo e(__('Forgot your password?')); ?></a></span>
                                            </div>
                                        </div>
                                        <?php if(Utility::getSettingValByName('RECAPTCHA_MODULE') == 'yes'): ?>
                                            <div class="form-group mb-4">
                                                <?php echo NoCaptcha::display(); ?>

                                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="small text-danger" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        <?php endif; ?>
                                </form>
                                <div class="d-grid">
                                    <button class="btn btn-primary mt-2 login-do-btn"
                                        id="login_button"><?php echo e(__('Login')); ?></button>
                                </div>



                            </div>
                        </div>

                </div>
            </main>
            <footer>
                <div class="auth-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <span>&copy; <?php echo e(date('Y')); ?>

                                    <?php echo e(App\Models\Utility::getValByName('footer_text') ? App\Models\Utility::getValByName('footer_text') : config('app.name', 'TicketGo')); ?>

                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if(Utility::getSettingValByName('RECAPTCHA_MODULE') == 'yes'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>
    <script>
        $(document).ready(function() {
            $("#form_data").submit(function(e) {
                $("#login_button").attr("disabled", true);
                return true;
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/davidmalaba/Projects/TOT/globalconsulting/resources/views/auth/login.blade.php ENDPATH**/ ?>
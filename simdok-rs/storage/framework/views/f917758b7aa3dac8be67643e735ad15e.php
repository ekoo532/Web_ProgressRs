<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e(config('app.name')); ?></title>
<link rel="icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<header class="topbar">
    <div class="topbar-inner">
        <a href="<?php echo e(route('home')); ?>" class="brand">
            <span class="brand-icon brand-icon-logo"><img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo <?php echo e(config('app.name')); ?>"></span>
            <span><?php echo e(config('app.name')); ?></span>
        </a>
        <?php if(auth()->guard()->check()): ?>
        <div class="topbar-user">
            <span class="user-name"><?php echo e(auth()->user()->name); ?></span>
            <span class="badge <?php echo e(auth()->user()->role === 'admin' ? 'badge-teal' : 'badge-slate'); ?>">
                <?php echo e(auth()->user()->role === 'admin' ? 'Admin' : 'User'); ?>

            </span>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="link-muted" style="background:none;border:none;cursor:pointer;padding:0;font:inherit;">Keluar</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</header>
<main class="page">
<?php if(session('success')): ?>
    <div class="flash flash-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="flash flash-error"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<?php echo e($slot); ?>

</main>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\progRS_app\simdok-rs\resources\views/components/layout.blade.php ENDPATH**/ ?>
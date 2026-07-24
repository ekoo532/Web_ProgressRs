<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div class="auth-wrap">
    <div class="auth-card">
        <div class="brand brand-lg">
            <span class="brand-icon">RS</span>
            <div>
                <div class="brand-title">Buat Akun Baru</div>
                <div class="brand-sub">Khusus untuk pengguna (User)</div>
            </div>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-error"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-block">Ke Halaman Login</a>
        <?php else: ?>
        <form method="POST" action="<?php echo e(route('register.attempt')); ?>">
            <?php echo csrf_field(); ?>
            <label>Nama Lengkap</label>
            <input type="text" name="name" required autofocus value="<?php echo e(old('name')); ?>">

            <label>Username</label>
            <input type="text" name="username" required value="<?php echo e(old('username')); ?>">

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="password2" required>

            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
        <p class="auth-footer">Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Masuk di sini</a></p>
        <?php endif; ?>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\progRS_app\simdok-rs\resources\views/auth/register.blade.php ENDPATH**/ ?>
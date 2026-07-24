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
<div class="container">
    <div class="page-head">
        <div>
            <h1>Panel Admin — Progress &amp; Persetujuan Dokumen</h1>
            <p class="subtitle">Progress dokumen berjalan otomatis 25% &rarr; 50% &rarr; 75% &rarr; 100% mengikuti tahapan di bawah.</p>
        </div>
        <a href="<?php echo e(route('admin.users')); ?>" class="link-muted">Kelola Pengguna</a>
    </div>

    <div class="stat-grid">
        <div class="stat-card"><div class="stat-label">Total Dokumen</div><div class="stat-value"><?php echo e($countAll); ?></div></div>
        <div class="stat-card"><div class="stat-label">Belum Direview (25%)</div><div class="stat-value stat-rose"><?php echo e($countMenungguReview); ?></div></div>
        <div class="stat-card"><div class="stat-label">Menunggu ACC Direktur (50%)</div><div class="stat-value stat-amber"><?php echo e($countMenungguDirektur); ?></div></div>
        <div class="stat-card"><div class="stat-label">Siap Dikirim ke User (75%)</div><div class="stat-value stat-amber"><?php echo e($countMenungguKirim); ?></div></div>
    </div>
    <div class="stat-grid" style="margin-top:-8px;">
        <div class="stat-card"><div class="stat-label">Selesai &amp; Dikirim (100%)</div><div class="stat-value stat-teal"><?php echo e($countSelesai); ?></div></div>
    </div>

    <div class="tab-row">
        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="?status=<?php echo e($key); ?>" class="tab <?php echo e($filter === $key ? 'tab-active' : ''); ?>"><?php echo e($label); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($docs->isEmpty()): ?>
        <div class="empty-state"><p>Tidak ada dokumen pada kategori ini.</p></div>
    <?php else: ?>
        <div class="table-card">
            <div class="table-row table-head">
                <div class="col-doc">Dokumen</div>
                <div class="col-user">Diupload oleh</div>
                <div class="col-progress">Progress</div>
                <div class="col-status">Status</div>
                <div class="col-action">Aksi</div>
            </div>
            <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="table-row">
                <div class="col-doc">
                    <div class="doc-name"><?php echo e($doc->title); ?></div>
                    <div class="doc-cat"><?php echo e($doc->category); ?> · <a href="<?php echo e($doc->fileUrl()); ?>" target="_blank">Lihat File</a></div>
                </div>
                <div class="col-user"><?php echo e($doc->uploader->name); ?></div>
                <div class="col-progress"><?php if (isset($component)) { $__componentOriginalc1838dab69175fa625a76ca35492c358 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1838dab69175fa625a76ca35492c358 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.progress-bar','data' => ['value' => $doc->computedProgress()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($doc->computedProgress())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1838dab69175fa625a76ca35492c358)): ?>
<?php $attributes = $__attributesOriginalc1838dab69175fa625a76ca35492c358; ?>
<?php unset($__attributesOriginalc1838dab69175fa625a76ca35492c358); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1838dab69175fa625a76ca35492c358)): ?>
<?php $component = $__componentOriginalc1838dab69175fa625a76ca35492c358; ?>
<?php unset($__componentOriginalc1838dab69175fa625a76ca35492c358); ?>
<?php endif; ?></div>
                <div class="col-status"><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['doc' => $doc]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['doc' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($doc)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></div>
                <div class="col-action">
                    <a href="<?php echo e(route('admin.document.show', $doc)); ?>" class="btn btn-outline btn-sm">
                        <?php echo e($doc->is_completed ? 'Lihat Detail' : 'Kelola Progress'); ?>

                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\progRS_app\simdok-rs\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
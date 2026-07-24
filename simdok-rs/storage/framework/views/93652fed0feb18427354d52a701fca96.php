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
            <h1>Dokumen Saya</h1>
            <p class="subtitle">Upload dokumen dan pantau progress-nya. Progress berjalan <b>otomatis</b> 25% &rarr; 50% &rarr; 75% &rarr; 100% mengikuti tahapan review Admin &amp; Direktur.</p>
        </div>
        <a href="<?php echo e(route('user.upload')); ?>" class="btn btn-primary">+ Upload Dokumen</a>
    </div>

    <div class="stat-grid">
        <div class="stat-card"><div class="stat-label">Total Dokumen</div><div class="stat-value"><?php echo e($total); ?></div></div>
        <div class="stat-card"><div class="stat-label">Dalam Proses</div><div class="stat-value stat-amber"><?php echo e($dalamProses); ?></div></div>
        <div class="stat-card"><div class="stat-label">Menunggu ACC Direktur</div><div class="stat-value stat-amber"><?php echo e($menungguDirektur); ?></div></div>
        <div class="stat-card"><div class="stat-label">Selesai &amp; Dikirim (100%)</div><div class="stat-value stat-teal"><?php echo e($selesai); ?></div></div>
    </div>

    <?php if($docs->isEmpty()): ?>
        <div class="empty-state">
            <p>Belum ada dokumen. Mulai dengan upload dokumen pertama Anda.</p>
        </div>
    <?php else: ?>
        <div class="doc-list">
        <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="doc-card">
                <div class="doc-main">
                    <div class="doc-title-row">
                        <h3><?php echo e($doc->title); ?></h3>
                        <span class="badge badge-slate"><?php echo e($doc->category); ?></span>
                        <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
<?php endif; ?>
                    </div>
                    <div class="doc-file">
                        📄 <a href="<?php echo e($doc->fileUrl()); ?>" target="_blank" rel="noopener"><?php echo e($doc->original_name); ?></a>
                    </div>
                    <div class="doc-progress"><?php if (isset($component)) { $__componentOriginalc1838dab69175fa625a76ca35492c358 = $component; } ?>
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
                    <div class="doc-meta">Diperbarui <?php echo e($doc->updated_at?->format('d M Y H:i') ?? '-'); ?></div>
                </div>
                <div class="doc-actions">
                    <div class="stepper">
                        <div class="step done">Masuk</div>
                        <div class="step-line"></div>
                        <div class="step <?php echo e($doc->admin_approved ? 'done' : ''); ?>">Review Admin</div>
                        <div class="step-line"></div>
                        <div class="step <?php echo e($doc->director_approved ? 'done' : ''); ?>">ACC Direktur</div>
                        <div class="step-line"></div>
                        <div class="step <?php echo e($doc->is_completed ? 'done' : ''); ?>">Dikirim ke User</div>
                    </div>
                    <a href="<?php echo e(route('user.document.edit', $doc)); ?>" class="link-muted" style="font-size:12px;">Ganti File Dokumen</a>
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
<?php /**PATH C:\xampp\htdocs\progRS_app\simdok-rs\resources\views/user/dashboard.blade.php ENDPATH**/ ?>
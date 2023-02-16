<?php $__env->startSection('content'); ?>
    <div class="d-flex flex-column align-items-center justify-content-center gap-5" id="thanks-section">
        <img width="300" class="img-fluid" src="<?php echo e(asset('images/logo.png')); ?>" alt="">
        <span class="text-center" style="font-size: 36px;">
            THANKS <br>
            FOR YOUR TESTIMONY
        </span>
        <a href="<?php echo e(route('testimony.show')); ?>" class="btn btn-primary dlcf_btn_color">
            <i class="fa fa-home"></i>
            Share another Testimony ?
        </a>
        <div class="d-flex flex-column align-items-center gap-3" style="margin-top: 10vh">
            Connect with us
            <div class="d-flex gap-4">
                <a href="https://www.youtube.com/c/DCLMHQ" target="_blank"><img width="40"
                        src="<?php echo e(asset('images/yt.png')); ?>" alt=""></a>

                <a href="https://www.facebook.com/dclmhq" target="_blank"><img width="40"
                        src="<?php echo e(asset('images/fb.png')); ?>" alt=""></a>
                <a href="https://twitter.com/dclmhq" target="_blank"> <img width="40" src="<?php echo e(asset('images/tw.png')); ?>"
                        alt=""></a>


            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jonathan/LaravelProjects/dclm-testimony/resources/views/thanks.blade.php ENDPATH**/ ?>
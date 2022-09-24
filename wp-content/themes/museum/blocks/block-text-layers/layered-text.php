<?php
$content = get_field('content');
$back_bg = get_field('back-level_background');
$front_bg = get_field('front-level_background');
?>

<div class="block block__layered-text">
    <?php if ($back_bg || $front_bg) : ?>
        <div class="layered-text__background">
            <?php if ($back_bg) : ?>
                <div class="background__element background__bg">
                    <?= file_get_contents(get_attached_file($back_bg)); ?>
                </div>
            <?php endif; ?>
            <?php if ($front_bg) : ?>
                <div class="background__element background__deco">
                    <?= file_get_contents(get_attached_file($front_bg)); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($content) : ?>
        <div class="layered-text__overlay-content">
            <?= $content; ?>
        </div>
    <?php endif; ?>
</div>
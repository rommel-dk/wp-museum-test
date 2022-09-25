<?php
/**
 * Layered Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

include_once MUSEUM_BLOCKS_DIR . '/blocks_default.php';

// Load values and assign defaults.
$content = get_field('content');
$back_bg = get_field('back-level_background');
$front_bg = get_field('front-level_background');
?>

<div class="block block__layered-text<?= esc_attr($class_name); ?>">
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
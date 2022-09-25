<?php
/**
 * Extra Image Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

include MUSEUM_BLOCKS_DIR . '/blocks_default.php';

// Load values and assign defaults.
$background = get_field('background');
$img_desc = get_field('image_description');
$stylized_desc = get_field('stylized_description');
$stylized_desc_bg = get_field('stylized_description_background');
$stylized_desc_bg = $stylized_desc_bg ? ' style="background-image: url(\'' . $stylized_desc_bg['url'] . '\'"' : '';
?>

<div class="block block__extra-image-section">
    <div class="extra-image-section__extra-image-section-inner">
        <?php if (!empty($background)) : ?>
            <div class="extra-image-section-inner__background-wrap">
                <?= wp_get_attachment_image($background['ID'], 'full'); ?>
                
                <?php if (!empty($img_desc)) : ?>
                    <div class="background-wrap__desc">
                        <?= $img_desc; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    
        <?php if (!empty($stylized_desc)) : ?>
            <div class="extra-image-section-inner__stylized-desc">
                <div class="stylized-desc__inner"<?= $stylized_desc_bg; ?>>
                    <?= $stylized_desc; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

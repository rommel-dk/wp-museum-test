<?php
/**
 * Overlaying Images Block Template.
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
$full_width_image = get_field('full-width_image');
$right_side_image = get_field('right-side_image');
$right_side_image_overlay = get_field('right-side_image_overlay_amount');
$left_side_description = get_field('left-side_description');
$left_side_description_bg_color = get_field('left-side_description_background_color');
$left_side_description_bg = get_field('left-side_description_background_image');
$footer_description = get_field('footer_description');
$footer_logo = get_field('footer_logo');
$footer_bg_color = get_field('footer_background_color');

$left_side_style_wrapper = '';
$left_side_style = '';
if (!empty($left_side_description_bg_color))
    $left_side_style_wrapper .= 'background-color:' . $left_side_description_bg_color . ';';
if (!empty($left_side_description_bg))
    $left_side_style .= 'background-image:url(\'' . $left_side_description_bg['url'] . '\');';

$left_side_style_wrapper = $left_side_style_wrapper ? ' style="' . $left_side_style_wrapper . '"' : '';
$left_side_style = $left_side_style ? ' style="' . $left_side_style . '"' : '';


$footer_style = '';
if (!empty($footer_bg_color))
    $footer_style .= 'background-color: ' . $footer_bg_color . ';';

$footer_style = $footer_style ? ' style="' . $footer_style . '"' : '';
?>

<div class="block block__overlaying-images<?= esc_attr($class_name); ?>">
    <?php if (!empty($full_width_image)) : ?>
        <div class="overlaying-images__full-width-image">
            <?= wp_get_attachment_image($full_width_image['ID'], 'full'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($right_side_image)) : ?>
        <div class="overlaying-images__right-side-image"<?= $left_side_style_wrapper; ?>>
            <?php if (!empty($left_side_description)) : ?>
                <div class="right-side-image__left-side-description"<?= $left_side_style; ?>>
                    <?= $left_side_description; ?>
                </div>
            <?php endif; ?>

            <div class="right-side-image__image" style="--overlaying-images-top-distance: -<?= $right_side_image_overlay; ?>em">
                <?= wp_get_attachment_image($right_side_image['ID'], 'full'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($footer_description) || !empty($footer_logo)) : ?>
        <div class="overlaying-images__images-footer"<?= $footer_style; ?>>
            <?php if (!empty($footer_description)) : ?>
                <div class="images-footer__description">
                    <?= $footer_description; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($footer_logo)) : ?>
                <div class="images-footer__logo">
                    <?php
                    if (false !== strpos($footer_logo['mime_type'], 'svg')) {
                        $footer_logo = get_attached_file($footer_logo['ID']);
                        $footer_logo = $footer_logo ? file_get_contents($footer_logo) : '';
                    } else if (false !== strpos($footer_logo['mime_type'], 'image')) {
                        $footer_logo = wp_get_attachment_image($footer_logo['ID'], 'medium');
                    }

                    echo $footer_logo;
                    ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

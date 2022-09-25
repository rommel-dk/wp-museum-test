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

include MUSEUM_BLOCKS_DIR . '/blocks_default.php';

// Load values and assign defaults.
$api = museum_external_content();
$data = $api->get_data();

$read_more_icon = get_field('read_more_icon');
if ($read_more_icon) {
    if (false !== strpos($read_more_icon['mime_type'], 'svg')) {
        $read_more_icon = get_attached_file($read_more_icon['ID']);
        $read_more_icon = $read_more_icon ? file_get_contents($read_more_icon) : '';
    } else if (false !== strpos($read_more_icon['mime_type'], 'image')) {
        $read_more_icon = wp_get_attachment_image($read_more_icon['ID'], 'medium');
    }
}

$top_left_decoration = get_field('top-left_decoration');
if ($top_left_decoration) {
    if (false !== strpos($top_left_decoration['mime_type'], 'svg')) {
        $top_left_decoration = get_attached_file($top_left_decoration['ID']);
        $top_left_decoration = $top_left_decoration ? file_get_contents($top_left_decoration) : '';
    } else if (false !== strpos($top_left_decoration['mime_type'], 'image')) {
        $top_left_decoration = wp_get_attachment_image($top_left_decoration['ID'], 'medium');
    }
}
?>

<div class="block block__api-grid">
    <?php if (empty($data)) : ?>
        <p>- No data to show -</p>
    <?php else : ?>
        <span class="api-grid__decoration"><?= $top_left_decoration; ?></span>

        <div class="api-grid__api-grid-elements">
            <?php foreach ($data as $grid_data) : ?>
    
                <?php
                $classes = '';
                if (!empty($grid_data['appearances'])) {
                    foreach ($grid_data['appearances'] as $appearance => $property) {
                        $classes .= sanitize_html_class($appearance . '__' . $property);
                    }
                }
                $classes = $classes ? ' ' . $classes : $classes;


                $date = $grid_data['date'];
                if (!empty($date) && strtotime($date)) {
                    $date = date('d. M Y', strtotime($date));
                    $date = strtolower($date);
                }
                ?>
    
                <div class="api-grid-elements__api-element<?= $classes; ?>">
                    <div class="api-element__date-image-wrap">
                        <?php if (!empty($grid_data['type']) || !empty($date)) : ?>
                            <?php $space = ($grid_data['type'] || $date) ? ' ' : ''; ?>
                            <span class="api-element__date"><?= $grid_data['type'] . $space . $date; ?></span>
                        <?php endif; ?>
        
                        <?php if (!empty($grid_data['image'])) : ?>
                            <img class="api-element__image" src="<?= $grid_data['image']; ?>" alt="<?= $grid_data['image-alt']; ?>">
                        <?php endif; ?>
                    </div>
    
                    <?php if (!empty($grid_data['author'])) : ?>
                        <p class="api-element__author">
                            <?php if (!empty($grid_data['author-href'])) : ?>
                                <a href="<?= $grid_data['author-href']; ?>"><?= $grid_data['author']; ?></a>
                            <?php else : ?>
                                <?= $grid_data['author']; ?>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if (!empty($grid_data['title'])) : ?>
                        <h2 class="api-element__title"><?= $grid_data['title']; ?></h2>
                    <?php endif; ?>
    
                    <?php if (!empty($grid_data['href'])) : ?>
                        <div class="api-element__link">
                            <a href="<?= $grid_data['href']; ?>"><?= $read_more_icon; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
    
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

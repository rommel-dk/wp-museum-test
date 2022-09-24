<?php
/**
 * Template part for displaying a single post/page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rommel
 * @subpackage Museum
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

	</header>

	<div class="entry-content">

		<?php
		the_content();
		?>

		<div class="block block__layered-text">
			<div class="layered-text__background">
				<div class="background__element background__bg">
					<?= file_get_contents(get_template_directory() . '/blocks/block-text-layers/layered-text-red-bg.svg'); ?>
				</div>
				<div class="background__element background__deco">
					<?= file_get_contents(get_template_directory() . '/blocks/block-text-layers/layered-text-red-deco.svg'); ?>
				</div>
			</div>

			<div class="layered-text__overlay-content">
				<h1>
					Master the
					<br>front-<span>end</span>
					<br>w<span>i</span>th fine<span>sse</span>
				</h1>
				
				<p>The assignment is supposed to be executed as simple as possible. Code the template in HTML/CSS and try to avoid 3. party frameworks as much as possible. Creating the page with React components will grant extra megamate bonus points.</p>
			</div>
		</div>
		
	</div>

</article>

<section class="testimonials block" id="testimonials">
	<h3 class="header"><?php echo app('translator')->getFromJson('Что о нас говорят клиенты?'); ?></h3>

	<div class="testimonials-list owl-carousel">
		<div class="testimonial">
			<div class="text-block">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium, iusto ad eveniet quos nesciunt laudantium vitae asperiores cum, blanditiis, minus doloremque a quia fuga sequi. Dolorum excepturi porro explicabo velit!
			</div>
			<div class="person">
				<?php echo e(Html::image('img/avatars/person1.jpg', '', ['width'=> '100', 'height' => '100'])); ?>

				<div class="info">
					<b><?php echo app('translator')->getFromJson('Руби Роуз'); ?></b>
					<?php echo app('translator')->getFromJson('Киллер, RWBY'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
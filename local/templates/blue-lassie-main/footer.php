
</div>
</main>
<footer class="footer">
			<div class="container footer__container">
				<div class="footer__col">
					<h3 class="footer__title">Покупки</h3>
					<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu", 
	array(
		"ROOT_MENU_TYPE" => "Bying",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_TYPE" => "A",
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "bottom_menu",
		"CHILD_MENU_TYPE" => "Bying",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
				</div>
				<div class="footer__col">
					<h3 class="footer__title">Lassie</h3>
						<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu", 
	array(
		"ROOT_MENU_TYPE" => "Lassie",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"CACHE_SELECTED_ITEMS" => "N",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "bottom_menu",
		"CHILD_MENU_TYPE" => "Lassie"
	),
	false
);?>
				</div>
				<div class="footer__col">
				<h3 class="footer__title">Lassie клуб</h3>
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"bottom_menu", 
						array(
							"ROOT_MENU_TYPE" => "Lassieclub",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
							"CACHE_SELECTED_ITEMS" => "N",
							"MAX_LEVEL" => "2",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N",
							"COMPONENT_TEMPLATE" => "bottom_menu",
							"CHILD_MENU_TYPE" => "Lassieclub"
						),
						false
					);?>
				</div>
				<div class="footer__col">
				<?$APPLICATION->IncludeComponent(
	"custom:eshop.socnet.links", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"FACEBOOK" => "sfdsfsdf",
		"VKONTAKTE" => "sfsfgsg",
		"TWITTER" => "sgsdgsg",
		"GOOGLE" => "",
		"INSTAGRAM" => "",
		"ODNOCLASSIKI" => "asdasdasd",
		"FACEBOOK_SORT" => "3",
		"VKONTAKTE_SORT" => "1",
		"TWITTER_SORT" => "4",
		"GOOGLE_SORT" => "",
		"INSTAGRAM_SORT" => "",
		"ODNOCLASSIKI_SORT" => "2"
	),
	false
);?>
				</div>
			</div>
			<div class="footer__bottom">
				<div class="container footer__container">
					<div class="footer__bottom-col">
						<p class="footer__text">Официальный интернет-магазин Lassie® в России</p>
					</div>
					<div class="footer__bottom-col">
						<div class="footer__text-group"><a href="tel:+78003331204" class="footer__text">8 (800) 333-12-04 </a><span class="footer__text">(горячая линия)</span>
						</div>
						<div class="footer__text-group"><a href="tel:+74952150435" class="footer__text">8 (495) 215-04-35 </a><span class="footer__text">(ежедневно с 9:00 до 24:00)</span>
						</div><a href="mailto:order@lassieshop.ru" class="footer__text footer__text_block">order@lassieshop.ru</a>
					</div>
				</div>
			</div>
		</footer>
		<script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/app.min.js"></script>
	</body>

</html>

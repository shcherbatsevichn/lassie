<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
//dump($arResult);

if (is_array($arResult["SOCSERV"]) && !empty($arResult["SOCSERV"]))
{
?>
	<h3 class="footer__title"><?=GetMessage("SS_TITLE_CUSTOM")?></h3>
		<ul class="footer__socials socials" style="padding-left: 0">
			<?foreach($arResult["SORT"] as $linkName):?>
			<li class="socials__item">
				<a class="socials__name <?=$arResult["STYLE_MAP"][$linkName]["a-class"]?>" href="<?=htmlspecialcharsbx($arResult["SOCSERV"][$linkName]["LINK"])?>">
					<span class="<?=$arResult["STYLE_MAP"][$linkName]["span-class"]?>"></span>
				</a>
			</li>
			<?endforeach?>
		</ul>
	<p class="footer__text">Следи за новостями и акциями
			<br>в социальных сетях. Будь первым!</p>
<?
}
?>
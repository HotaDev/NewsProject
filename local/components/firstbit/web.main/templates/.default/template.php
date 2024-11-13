<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\UI\Extension;

Extension::load("ui.bootstrap4");
?>

<div id="component_news">

</div>
<div id="news-panel" class="news-panel">
    <div class="static-news">
        <? $APPLICATION->IncludeComponent("firstbit:web.main.carousel", ".default", []); ?>
        <? $APPLICATION->IncludeComponent(
	"firstbit:web.main.banner", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_CODE" => "news",
		"PROPERTY_BANNER1_ID" => "32"
	),
	false
); ?>
    </div>
    <? $APPLICATION->IncludeComponent("firstbit:web.main.search", ".default", []); ?>
</div>
<template id="component_news_tpl">
    <input hidden="hidden" :click="LoaderMethod()">
</template>

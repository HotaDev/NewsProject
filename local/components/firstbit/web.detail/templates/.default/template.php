<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\UI\Extension;
\CJSCore::init("sidepanel");

$news = $arResult['NEWS']->GetNextElement();
if ($news) {
$viev = $news->GetProperties();
$news = $news->GetFields();
while($autor = $arResult['autor']->getNext())
{
    if ($autor['ID'] == $viev['contact_person']['VALUE'][0]) {
        break;
    }
}
$textCount = str_word_count(strip_tags($news['DETAIL_TEXT']), 0, "АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя");
$readTime = ceil($textCount / 150);
if ($readTime % 10 == 1 && $readTime % 100 != 11) {
    $readText = $readTime . ' минута'; 
} elseif ($readTime % 10 > 1 && $readTime % 10 < 5 && ($readTime % 100 > 15 || $readTime % 100 < 10)) {
    $readText = $readTime . ' минуты';
}   else {
    $readText = $readTime . ' минут';
}
} 

?>

<div id="component_detail">

</div>
<div class="selected-news">
    <div id="counter"></div>
    <div class="back">
        <?php if ($APPLICATION->showPanelWasInvoked) { ?>
        <p><a href="/project/">< Мои новости</a></p>
        <?php } ?> 
    </div>
    <?php if ($news) {?>
    <div class="news-block">
        <div class="main-news">
            <h5 class="pt-4 pb-2 text-dark"><?=$news['NAME']?></h5>
            <img src="<?=CFile::GetPath($news['PREVIEW_PICTURE'])?>">
            <h5 class="pt-4 pb-2 text-dark"><?=$news['PREVIEW_TEXT']?></h5>
                <div class="text-news">
                    <?=$news['DETAIL_TEXT']?>
                </div>
        </div>
        <div class="side-info">
            <div class="main-info">
                <div class="post-date"><?=strtolower(FormatDate("d F Y", MakeTimeStamp($viev['date']['VALUE'])))?></div>
                <div class="read-time"><?=$readText?></div>
                <div class="author" id="<?=$autor['ID']?>">
                    <img src="<?=CFile::GetPath($autor['PERSONAL_PHOTO'])?>">
                    <div class="info">
                        <h5 class="mb-1"><?=$autor['LAST_NAME'] . ' ' . $autor['NAME']?></h5>
                        <span class="text-secondary"><?=$autor['WORK_POSITION']?></span>
                    </div>
                </div>
            </div>
            <? $APPLICATION->IncludeComponent("firstbit:web.detail.recommendations", ".default", []); ?>
        </div>
    </div>
    <div class="liks"> 
        <? $APPLICATION->IncludeComponent("firstbit:web.detail.like", ".default", ["news_id" => $news['ID']]); ?> 
    </div>
    <div class="tags">
        <h5 class="mr-2">Теги: </h5>
        <? $APPLICATION->IncludeComponent("firstbit:web.main.tags", ".default", ["news_id" => $news['ID']]);?>
    </div>
    <?php } else { ?>
    <h1 class="news-block">Новость не найдена</h1>
    <?php } ?>
</div>
<template id="component_detail_tpl">
    <input hidden="hidden" :click="LoaderMethod()">
</template>

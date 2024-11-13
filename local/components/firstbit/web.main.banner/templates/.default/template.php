<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$top_banner = $arResult["TOP_BANNER"];
$bottom_banner = $arResult["BOTTOM_BANNER"];

?>

<div id="component_banner">
    <div class="minor-news">
        <?php if ($top_banner) {?>
        <div class="news" id="<?=$top_banner["ID"]?>">
            <div>
                <span class="post-date"> <?= strtolower(FormatDate("d F Y", $top_banner["DATE_CREATE_UNIX"]))?> </span>
                <h5><?= $top_banner["NAME"] ?></h5>
                <p><?= $top_banner["PREVIEW_TEXT"] ?></p>
            </div>
            <img class="news-img"
                img src="<?=CFile::GetPath($top_banner['PREVIEW_PICTURE']);?>">
            <div class="tags">
                <? $APPLICATION->IncludeComponent("firstbit:web.main.tags", ".default", ["news_id" => $top_banner['ID']]); ?>
            </div>
        </div>
    <?php }?>
    <?php if ($bottom_banner) {?>
        <div class="news" id="<?=$bottom_banner["ID"]?>">
            <div>
                <span class="post-date"> <?= strtolower(FormatDate("d F Y", $bottom_banner["DATE_CREATE_UNIX"]))?> </span>
                <h5><?= $bottom_banner["NAME"] ?></h5>
                <p><?= $bottom_banner["PREVIEW_TEXT"] ?></p>
            </div>
            <img class="news-img"
                img src="<?=CFile::GetPath($bottom_banner['PREVIEW_PICTURE']);?>">
            <div class="tags">
                <? $APPLICATION->IncludeComponent("firstbit:web.main.tags", ".default", ["news_id" => $bottom_banner['ID']]); ?>
            </div>
        </div>
    <?php }?>
    </div>
</div>
<template id="component_banner_tpl">

</template>
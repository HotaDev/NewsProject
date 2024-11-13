<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\UI\Extension;
Extension::load("ui.bootstrap4");
$news = $arResult['NEWS'];
?>

<div id="component_recomm">
</div>

<div class="minor-news">
    <? foreach ($news as $new) { ?>
        <div class="news" id=<?= $new['fields']['ID']?>>
            <img class="news-img" src=<?= CFile::GetPath($new['fields']['PREVIEW_PICTURE']) ?> alt="None">
            <div class="news-info">
                <span class="post-date"><?= $new['date'] ?></span>
                <span class="read-time"><?= $new['props']['read_time']['VALUE'] ?></span>
                <h5><?= $new['fields']['NAME'] ?></h5>
            </div>
            <div class="tags">
                <? $APPLICATION->IncludeComponent("firstbit:web.main.tags", ".default", ['news_id' => $new['fields']['ID']]); ?>
            </div>
        </div>
    <? } ?>
</div>
<template id="component_recomm_tpl">

</template>
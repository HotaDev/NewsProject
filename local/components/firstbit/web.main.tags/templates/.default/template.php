<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\UI\Extension;


Extension::load("ui.bootstrap4");
?>


<div id="component_tags">
    <?php 
        Bitrix\Main\Loader::includeModule('firstbit.news');
        foreach(\FirstBit\News\Tags::GetTagsForNewsByID($arParams["news_id"]) as $tag){
            echo"<span>$tag</span>";
        }
    ?>
</div>
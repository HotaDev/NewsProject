<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;

Extension::load("ui.bootstrap4");
?>

<div id="component_like">
    
</div>

<template id="component_like_tpl">
    <div class="like_block">
        <div class="like" >
            <p class="text-success">
                {{likes}}
                <img class="like-img" :src='scrImage' alt="Image" @click='pushTheButton'>
                Мне нравится
            </p>
        </div>
    </div>
</template>
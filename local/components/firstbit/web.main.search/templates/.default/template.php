<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\UI\Extension;

Extension::load("ui.bootstrap4");
?>

<div id="component_search">
    </div>
    <template id="component_search_tpl">
    <div class="search-news">
    <input class="search-bar form-control" v-model= "input" type="text" placeholder="Поиск по новостям">
        <div class="news"  v-for = "items in items"   >
            <div @click="goToPage(items.fields.ID)" >
                <img class="news-img"
                    :src= "items.image" >
                <div >
                    <span class="post-date">{{items.date}}</span>
                    <span class="read-time">{{items.props.read_time.VALUE}}</span>
                    <h5>  {{items.fields.PREVIEW_TEXT}} </h5>
                </div>
            </div>
            <div class="tags"  >
                <span v-for = "tags in items.tags" @click="pullTosearch(tags)" >
                    {{tags}}
                </span>
            </div>
        </div>
    </div>
    </template>
    
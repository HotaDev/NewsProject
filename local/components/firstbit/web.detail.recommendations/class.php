<?php

use Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\SystemException;
use Firstbit\News\Recommendations;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

class RecommendComponent extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable
{
    private $_request;
    const MODULE_NAME = "firstbit.project";

    public function configureActions()
    {
        return [];
    }

    /**
     * Точка входа в компонент
     * Должна содержать только последовательность вызовов вспомогательых ф-ий и минимум логики
     * всю логику стараемся разносить по классам и методам
     */
    public function executeComponent()
    {
        try {
            \CJSCore::init("sidepanel");
            \Bitrix\Main\UI\Extension::load('ui.vue');
            \Bitrix\Main\UI\Extension::load('ui.vue.vuex');
            \Bitrix\Main\UI\Extension::load('ui.bootstrap4');
            \Bitrix\Main\UI\Extension::load('ui.buttons');
            Loader::includeModule('firstbit.news');
            $this->arResult['NEWS'] = Recommendations::GetRecommendations($_GET['id']);
            $this->IncludeComponentTemplate();
        } catch (SystemException $exception) {
            ShowError($exception->getMessage());
        }
    }
}

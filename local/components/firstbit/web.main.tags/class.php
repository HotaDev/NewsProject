<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class TagsComponent extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable {
    private $_request;
    const MODULE_NAME = "firstbit.project";

    public function configureActions() {
        return [];
    }

    public function GetNews() {
        $filter = [
            'IBLOCK_CODE' => 'news',
        ];
        if (CModule::IncludeModule("iblock")) {
            $this->arResult['NEWS'] = CIBlockElement::GetList(
                array("SORT" => "ASC"),
                $filter,
                false
            );
        }
    }

    /**
     * Точка входа в компонент
     * Должна содержать только последовательность вызовов вспомогательых ф-ий и минимум логики
     * всю логику стараемся разносить по классам и методам
     */
    public function executeComponent() {
        try {
            $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
            \Bitrix\Main\UI\Extension::load('ui.vue');
            \Bitrix\Main\UI\Extension::load('ui.vue.vuex');
            \Bitrix\Main\UI\Extension::load('ui.bootstrap4');
            \Bitrix\Main\UI\Extension::load('ui.buttons');
            $this->IncludeComponentTemplate();
        } catch (SystemException $exception) {
            ShowError($exception->getMessage());
        }
    }
}

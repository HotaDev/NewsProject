<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\SystemException;
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class DetailComponent extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable {
    private $_request;
    const MODULE_NAME = "firstbit.project";

    public function configureActions() {
        return [];
    }
    
    public function GetNews() {
        $filter = [
            'ID' => $_GET['id'] ?? 30,
        ];
        if(CModule::IncludeModule("iblock"))
        { 
            $this->arResult['NEWS'] = CIBlockElement::GetList(
                Array("SORT"=>"ASC"),
                $filter,
                false,
            );
            $this->arResult['autor'] = CUser::GetList(
                'ID',
                'asc',
                Array('ACTIVE' => 'Y'),
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
            $this->GetNews();
            $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
            \Bitrix\Main\UI\Extension::load('ui.vue');
            \Bitrix\Main\UI\Extension::load('ui.vue.vuex');
            \Bitrix\Main\UI\Extension::load('ui.bootstrap4');
            \Bitrix\Main\UI\Extension::load('ui.buttons');
            $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
            if (str_contains($request->getRequestUri(), 'selected'))
                $this->IncludeComponentTemplate('selected');
            else
                $this->IncludeComponentTemplate();
        } catch (SystemException $exception) {
            ShowError($exception->getMessage());
        }
    }
}

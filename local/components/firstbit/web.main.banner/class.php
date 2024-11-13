<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class BannerComponent extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable {
    private $_request;
    const MODULE_NAME = "firstbit.project";

    public function configureActions() {
        return [];
    }

    public function GetUserCity() {

        global $USER;  

        $userId = $USER->GetID();  

        $user = CUser::GetByID($userId)->Fetch(); 
        

        $cityAbbrs = [
            "Москва" => "МСК",
            "Санкт Петербург" => "СПБ",
            "Новосибирск" => "НСК"
        ];

        return $cityAbbrs[$user['WORK_CITY']];

    }
    
    public function GetNews($banner_type) {
        $filterCity = $this->GetUserCity();

        $filter = [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE' => "Y",
            'PROPERTY_GROUPS_VALUE' => $filterCity,  
            'PROPERTY_PIN_VALUE' => $banner_type,     
        ];

        if(CModule::IncludeModule("iblock"))
        { 
            $news_list = CIBlockElement::GetList(
                Array("SORT"=>"ASC", 
                "DATE_ACTIVE_FROM"=>"DESC"
                ),
                $filter,
                false,
                
            );

            try{
                $result = $news_list->fetch();
            }
            catch(SystemException $exception) {
                ShowError($exception->getMessage());
            }

            return $result;

        }
    }

    /**
     * Точка входа в компонент
     * Должна содержать только последовательность вызовов вспомогательых ф-ий и минимум логики
     * всю логику стараемся разносить по классам и методам
     */
    public function executeComponent() {
        try {
            // $this->GetNews();
            if ($this->GetNews("Верхний баннер")){
                $this->arResult['TOP_BANNER'] = $this->GetNews("Верхний баннер");
            }
            // $this->arResult['TOP_BANNER'] = $this->GetNews("Верхний баннер");
            if ($this->GetNews("Нижний баннер")){
                $this->arResult['BOTTOM_BANNER'] = $this->GetNews("Нижний баннер");
            }
            // print_r($this->arParams);
    
            $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
            \Bitrix\Main\UI\Extension::load('ui.vue');
            \Bitrix\Main\UI\Extension::load('ui.vue.vuex');
            \Bitrix\Main\UI\Extension::load('ui.bootstrap4');
            \Bitrix\Main\UI\Extension::load('ui.buttons');
            Loader::includeModule('firstbit.news');
            if (str_contains($request->getRequestUri(), 'selected'))
                $this->IncludeComponentTemplate('selected');
            else
                $this->IncludeComponentTemplate();
        } catch (SystemException $exception) {
            ShowError($exception->getMessage());
        }
    }
}

<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
use \Firstbit\News\LikesTable;
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class LikeComponent extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable {
    private $_request;
    const MODULE_NAME = "firstbit.project";

    public function configureActions() {
        return [];
    }
    
    public function getUserId(){
        global $USER;
        $userId = $USER->GetID();
        return $userId;
    }

    public function getItemId(){
        $ItemId = $this->arParams["news_id"];  
        return (int)$ItemId;
    }
    
    public function getLikesAction()
    {
        $itemId = $this->getItemId();

        Loader::includeModule('firstbit.news');
        $likes = LikesTable::query();
        $likes->setFilter([ 
            '=ITEM_ID' => $itemId 
        ]);
        $likes->setSelect(['ID']); 

        $properties = [];
        $properties = $likes->exec()->fetchAll();
        $result = count($properties);

        $userStatus = $this->getUserStatus();
        if ($userStatus > 0) {
            $status = 'like';
        } else {
            $status = 'not_like';
        }
        return ['COUNT_LIKE' => $result, 'STATUS' => $status];
    }
    
    public function getLikesUserAction($params): array { 
        
        $status = $this->getUserStatus();

        if ($status > 0) { 
            $this->delUserLike();
            return ['STATUS' => 'false'];
        } else {
            $this->addUserLike();
            return ['STATUS' => 'true'];
        } 
    } 
    
    public function getUserStatus() {

        $userId = $this->getUserId();
        $itemId = $this->getItemId();

        Loader::includeModule('firstbit.news');
        $likes = LikesTable::query();
        $likes->setFilter([ 
            '=ITEM_ID' => $itemId,
            '=USER_ID' => $userId
        ]);
        $likes->setSelect(['ID']);
        
        $properties = [];
        $properties = $likes->exec()->fetchAll();
        $result = count($properties);

        return $result;
    }

    public function addUserLike() {
        $userId = $this->getUserId();
        $itemId = $this->getItemId();

        Loader::includeModule('firstbit.news');
        LikesTable::add([
            'USER_ID' => $userId,
            'ITEM_ID' => $itemId
        ]);   
    }

    public function delUserLike() {
        $userId = $this->getUserId();
        $itemId = $this->getItemId();

        $likes = LikesTable::query();
        $likes->setFilter([ 
            '=ITEM_ID' => $itemId,
            '=USER_ID' => $userId
        ]);
        $likes->setSelect(['ID']);
        
        $properties = [];
        $properties = $likes->exec()->fetch();

        Loader::includeModule('firstbit.news');
        LikesTable::delete($properties);   
    }

    public function GetNews() {
        $filter = [
            'ID' => $_GET['id'] ?? 30,
        ];
        if (CModule::IncludeModule("iblock")) { 
            $itemId = CIBlockElement::GetList(
                Array("SORT"=>"ASC"),
                $filter,
                false,
            );
        }
        $resItemId = $itemId->fetch();
        return $resItemId;
    }
    
    public function executeComponent() {
        try {
            $this->getLikesAction();
            $this->getUserId();
            $this->getItemId();
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

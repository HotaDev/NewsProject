<?php


use \Bitrix\Main\Loader;
use Bitrix\Main\SystemException;

use Firstbit\News\Helper;
use Firstbit\News\Tags;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class SearchComponent extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable {
    private $_request;
    const MODULE_NAME = "firstbit.project";
    public function configureActions() {
        return [];
    }
    
    public function getItemsAction($input) {
        
        Loader::includeModule('firstbit.news');
        
        if (strlen($input) < 3 ) {
            $input = null;
        }
            if (substr($input, 0, 1) == "#"){
                $tagsID =(\CIBlockElement::GetList([],["NAME"=> "%$input%" ]))->Fetch()["ID"];
                $news = Helper::GetNews([],["IBLOCK_CODE"=> 'news',"PROPERTY_TAGS" =>$tagsID], false,['nTopCount'=> 6]);
            }else{

                    $news = Helper::GetNews(
                        [],
                        [
                            "IBLOCK_CODE"=> 'news',
                                ['LOGIC' => 'OR',
                                    ["PREVIEW_TEXT" => "%$input%"], 
                                    ["DETAIL_TEXT"=> "%$input%"]
                                ]
                        ], 
                        false,['nTopCount'=> 6]);
                    
            }
        
        
        
        foreach($news as $key => $value){
            $value['image']= CFile::GetPath($value['fields']['PREVIEW_PICTURE']);
            $value['test']= $value['fields']['ID'];
            $tags = Tags::GetTagsForNewsByID( $value['fields']['ID']);
            foreach($tags as $tag){
                $value['tags'][]=$tag;
            }
            $news[$key]= $value;
        }
        return $news;
      
    }
    
    public function getPathImage($imageID){
        return( CFile::GetPath($imageID));
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
            
            if (str_contains($request->getRequestUri(), 'selected'))
                $this->IncludeComponentTemplate('selected');
            else
                $this->IncludeComponentTemplate();
        } catch (SystemException $exception) {
            ShowError($exception->getMessage());
        }
    }
}

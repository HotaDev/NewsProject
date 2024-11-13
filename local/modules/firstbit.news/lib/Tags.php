<?php
namespace FirstBit\News;

class Tags {
    public static function GetTagsForNewsByID($IELEMENT_ID) : array {
        $tagNames = [];
        $arFilter = ["CODE" => "tags"];  
        $arOrder = ["sort"=>"asc"];
        $IBLOCK_ID = \CIBlockElement::GetByID($IELEMENT_ID)->Fetch()['IBLOCK_ID']; //change to variable later
        $tagProps = \CIBlockElement::GetProperty($IBLOCK_ID, $IELEMENT_ID, $arOrder, $arFilter);
        while($tagProp = $tagProps->Fetch()){
            $tagNames[] = \CIBlockElement::GetByID($tagProp["VALUE"])->Fetch()["NAME"];
        }
        return $tagNames;
    }
}
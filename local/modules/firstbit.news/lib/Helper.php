<?php

namespace FirstBit\News;

class Helper
{
    public static function GetDate(string $date): string
    {
        return strtolower(FormatDate("d F Y", MakeTimeStamp($date)));
    }

    public static function GetUser(){
        global $USER;
        $userId = $USER->GetID();
        $user = \CUser::GetByID($userId)->Fetch();
        return $user;
    }
    /**
     * Принимает параметры для поиска новостей. Возвращает массив новостей.
     * @param array $order Массив полей для сортировки
     * @param array $filter Массив фильтров
     * @param array|bool $groupBy Поля для группировки
     * @param array|bool $navStartParams Ограничения количества элементов
     * @param array $selectedFields Массив возвращаемых полей элемента
     * @return array|bool Массив найденых элементов
     */

    public static function GetNews($order = array(), $filter = array(), $groupBy = false, $navStartParams = false, $selectedFields = array())
    {
        $allNews = \CIBlockElement::GetList($order, $filter, $groupBy, $navStartParams, $selectedFields);
        $news = [];
        while ($el = $allNews->GetNextElement()) {
            $news[count($news)]['fields'] = $el->GetFields();
            $news[count($news) - 1]['props'] = $el->GetProperties();
            $news[count($news) - 1]['date'] = self::GetDate($news[count($news) - 1]['props']['date']['VALUE']);
        }
        return $news;
    }
}   
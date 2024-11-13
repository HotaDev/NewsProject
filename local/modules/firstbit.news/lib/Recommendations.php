<?php

namespace FirstBit\News;

class Recommendations
{
    /**
     * Выдаёт список рекомендаций.
     *
     * @param  int $newsId ID текущей новости
     * @return array|null Список рекомендаций
     */
    public static function GetRecommendations(int $newsId): array|null
    {
        $currentNews = Helper::GetNews([], ['ID' => $newsId])[0];
        $iblockId = $currentNews['fields']['IBLOCK_ID'];
        $order = ["PROPERTY_DATE" => "DESC"];
        $tagsCount = count(gettype($currentNews['props']['tags']['VALUE']) === 'array' ? $currentNews['props']['tags']['VALUE'] : []);
        $recommendations = [];
        for ($i = 0; $i < $tagsCount; $i++) {
            $navStartParams = ['nTopCount' => (4 - $tagsCount) - count($recommendations) + $i];
            $filter = ['IBLOCK_ID' => $iblockId, ['LOGIC' => 'OR', 'PROPERTY_TAGS' => $currentNews['props']['tags']['VALUE'][$i]], '!ID' => $newsId];
            $tmp = Helper::GetNews($order, $filter, false, $navStartParams);
            if ($tmp)
                foreach ($tmp as $el)
                    $recommendations[] = $el;
        }
        return $recommendations;
    }
}
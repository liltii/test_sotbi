<?php

namespace Test\Main;

class Iblock
{
    function __construct()
    {
        global $APPLICATION;
        \Bitrix\Main\Loader::includeModule('iblock');
    }

    /**
     * Создание ИБ
     *
     * @param array $params
     * @return bool
     * @throws \Exception
     */
    public function create(array $params): bool
    {
        if (empty($params['NAME'])) {
            throw new \Exception('Должно быть переданно имя для ИнфоБлока.');
            return false;
        }

        if (empty($params['CODE'])) {
            throw new \Exception('Должен быть передан символьный код для ИнфоБлока.');
            return false;
        }

        if (empty($params['IBLOCK_TYPE_ID'])) {
            throw new \Exception('Должен быть передан id типа инфоблока для ИнфоБлока.');
            return false;
        }

        $iblock = new \CIBlock;
        $arFields = [
            "ACTIVE" => 'Y',
            "NAME" => $params['NAME'],
            "CODE" => $params['CODE'],
            "LIST_PAGE_URL" => $params['LIST_PAGE_URL'] ?? '',
            "DETAIL_PAGE_URL" => $params['DETAIL_PAGE_URL'] ?? '',
            "IBLOCK_TYPE_ID" => $params['IBLOCK_TYPE_ID'],
            "SITE_ID" => 's1',
            "SORT" => $params['SORT'] ?? 500,
            "GROUP_ID" => Array("2"=>"R", "3"=>"R")
        ];

        $iblock->Add($arFields);

        return true;
    }

    /**
     * Создание элемента для ИБ
     * @param array $params
     * @return bool
     * @throws \Exception
     */
    public function addElement(array $params): bool
    {
        $el = new \CIBlockElement;

        if (empty($params['NAME'])) {
            throw new \Exception('Должно быть переданно имя для элемента.');
            return false;
        }

        if (empty($params['IBLOCK_ID'])) {
            throw new \Exception('Должно быть переданн символьный код для элемента.');
            return false;
        }

        $PROP = [];

        if (!empty($params['COORDINATES'])) {
            $PROP['COORDINATES'] = $params['COORDINATES'];
        }

        if (!empty($params['PHONE'])) {
            $PROP['PHONE'] = $params['PHONE'];
        }

        if (!empty($params['EMAIL'])) {
            $PROP['EMAIL'] = $params['EMAIL'];
        }

        if (!empty($params['CITY'])) {
            $PROP['CITY'] = $params['CITY'];
        }

        $arLoadProductArray = [
            "IBLOCK_ID" => $params['IBLOCK_ID'],
            "NAME" => $params['NAME'],
            "ACTIVE" => $params['ACTIVE'] ?? 'Y',
            "CODE" => $params['CODE'] ?? '',
            "PROPERTY_VALUES" => $PROP,
            "SORT" => $params['SORT'] ?? 500,
        ];

        $el->Add($arLoadProductArray);

        if ($el->LAST_ERROR) {
            throw new \Exception($el->LAST_ERROR);
            return false;
        }

        return true;
    }
}
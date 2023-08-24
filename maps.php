<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

\Bitrix\Main\Loader::includeModule('iblock');

$resOffices = CIBlockElement::GetList(
    [],
    ["IBLOCK_ID" => 10]
);

while ($arOffice = $resOffices->GetNextElement()) {
  $office['PROPERTIES'] = $arOffice->GetProperties();
  $arCoordinate = explode(',', $office['PROPERTIES']['COORDINATES']['VALUE']);

  $arResult['POSITION']['yandex_scale'] = "5";
  $arResult['POSITION']['yandex_lat'] = $arCoordinate[0];
  $arResult['POSITION']['yandex_lon'] = $arCoordinate[1];
  $arResult['POSITION']['PLACEMARKS'][] = array(
    'LON' => $arCoordinate[1],
    'LAT' => $arCoordinate[0],
  );
}

$APPLICATION->IncludeComponent(
    "bitrix:map.yandex.view",
    "",
    Array(
        "INIT_MAP_TYPE" => "MAP",
        "MAP_DATA" => serialize($arResult['POSITION']),
        "MAP_WIDTH" => "700",
        "MAP_HEIGHT" => "400",
        "CONTROLS" => array("ZOOM", "TYPECONTROL", "SCALELINE"),
        "OPTIONS" => array("ENABLE_SCROLL_ZOOM", "ENABLE_DBLCLICK_ZOOM", "ENABLE_DRAGGING"),
    )
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

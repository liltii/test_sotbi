<?php

//CModule::IncludeModule('test.main');

return function (\Bitrix\Main\Routing\RoutingConfigurator $routes) {
    $routes->post('/api/iblock/create/', [\Test\Main\Controller\Iblock::class, 'createAction']);
    $routes->post('/api/iblock/addElement/', [\Test\Main\Controller\Iblock::class, 'addElementAction']);
};

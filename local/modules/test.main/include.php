<?php

$module_folder = \Bitrix\Main\Application::getDocumentRoot() . '/local/modules/test.main';

\Bitrix\Main\Loader::registerNamespace('Test\Main\Controller', $module_folder . '/controller');
<?php

class test_main extends CModule
{
    var $MODULE_ID = 'test.main';
    var $MODULE_NAME = 'Тестовый модуль';
    var $MODULE_DESCRIPTION = "Каркас для модуля";
    var $MODULE_VERSION = "1.0";
    var $MODULE_VERSION_DATE = "2023-04-09 12:00:00";
    var $PARTNER_NAME = 'Timur Akzigitov';
    var $PARTNER_URI = 'https://localhost:80';

    public function DoInstall()
    {
        \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
    }

    public function DoUninstall()
    {
        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}
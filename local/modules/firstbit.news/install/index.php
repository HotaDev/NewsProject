<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class firstbit_news extends CModule
{
    public $MODULE_ID = "firstbit.news";

    public $MODULE_NAME;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;
    public $MODULE_PATH;

    public $MODULE_GROUP_RIGHTS = "Y";

    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = Loc::getMessage("FBIT_INTRF_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("FBIT_INTRF_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = Loc::getMessage("FBIT_INTRF_MODULE_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("FBIT_INTRF_MODULE_PARTNER_URL");
    }
    public function DoInstall()
    {
        $this->registerModule();
    }
    public function registerModule()
    {
        RegisterModule($this->MODULE_ID);
    }    
    public function DoUninstall()
    {
        $this->unRegisterModule();
    }
    public function unRegisterModule()
    {
        UnRegisterModule($this->MODULE_ID);
    }
}
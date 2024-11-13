<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<? $APPLICATION->SetTitle("Проект"); ?>

<? $APPLICATION->IncludeComponent("firstbit:web.main", ".default", array("COMPONENT_TEMPLATE" => ".default"), false); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>

<? if (!$APPLICATION->showPanelWasInvoked) { ?>
<? $APPLICATION->ShowHead(); }?>

<? $APPLICATION->SetTitle("Проект"); ?>

<? $APPLICATION->IncludeComponent("firstbit:web.detail", ".default", []); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
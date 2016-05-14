<?php
@session_start();
session_destroy();
require_once("Page.php");
require_once("./Views/FormCreator/MyForm.php");
require_once("./Views/FormCreator/TextBox.php");

class PageRegistration extends Page
{
	protected function showContent()
	{
		$Pr= new  MyForm("Анкета" ,"Registration");
		$Pr->addCtrl(new TextBox("Фамилия", $Pr->GetVarName()."SurName"));
		$Pr->addCtrl(new TextBox("Имя", $Pr->GetVarName()."Name"));
		$Pr->addCtrl(new TextBox("Логин", $Pr->GetVarName()."Login"));
		$Pr->addCtrl(new TextBox("Пароль", $Pr->GetVarName()."Password"));
		$Pr->setAction("./Service/checklogin.php");
		$Pr->setId("Admin");
		$Pr->setButtonText("Создать");
		$Pr->setOnclick("validationFormRegistration()");
		$Pr->setTableClass("testForm");
		echo $Pr;
		
	}
}
<?php
@session_start();
session_destroy();
require_once("Page.php");
require_once("./Views/FormCreator/MyForm.php");
require_once("./Views/FormCreator/TextBox.php");
require_once("./Views/FormCreator/Button.php");

class PageLogin extends Page
{
	protected function showContent()
	{
		$Pr = new  MyForm( "Авторизация" ,"Autorization");	
		$Pr->addCtrl(new Button("Новая учетная запись", $Pr->GetVarName()."New", "Создать"));	
		$Pr->addCtrl(new TextBox("Логин", $Pr->GetVarName()."Login"));
		$Pr->addCtrl(new TextBox("Пароль", $Pr->GetVarName()."Password"));

		$Pr->setAction("./Service/checklogin.php");
		$Pr->setId("Admin");
		$Pr->setButtonText("Войти");
		$Pr->setOnclick("validationFormAutorization()");	
		$Pr->setTableClass("testForm");
		echo $Pr;		
	}	
}



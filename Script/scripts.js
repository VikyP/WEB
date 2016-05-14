function validationFormAutorization()
{
	var isValid=true;
	var log= document.getElementById("AutorizationLogin");		
	if(log.value=="")
	{
		document.getElementById("error_AutorizationLogin").innerHTML="Укажите логин";
		var isValid=false;
	}
	else
		document.getElementById("error_AutorizationLogin").innerHTML="";
	
	
	var pass= document.getElementById("AutorizationPassword");	
	if(pass.value=="")
	{
		document.getElementById("error_AutorizationPassword").innerHTML="Укажите логин";
		var isValid=false;
	}
	else
		document.getElementById("error_AutorizationPassword").innerHTML="";
	
	return isValid;
}
function validationFormRegistration()
{
	var isValid=true;
	var name= document.getElementById("RegistrationName");		
	if(name.value=="")
	{
		document.getElementById("error_RegistrationName").innerHTML="Укажите имя";
		var isValid=false;
	}
	else
		document.getElementById("error_RegistrationName").innerHTML="";	
	
	
	var SurName= document.getElementById("RegistrationSurName");
	if(SurName.value=="")
	{
		document.getElementById("error_RegistrationSurName").innerHTML="Укажите фамилию";
		var isValid=false;
	}
	else
		document.getElementById("error_RegistrationSurName").innerHTML="";
	
	
	
	var Login= document.getElementById("RegistrationLogin");
	if(Login.value=="")
	{
		document.getElementById("error_RegistrationLogin").innerHTML="Укажите логин";
		var isValid=false;
	}
	else
		document.getElementById("error_RegistrationLogin").innerHTML="";
	
	
	var Password= document.getElementById("RegistrationLogin");
	if(Password.value=="")
	{
		document.getElementById("error_RegistrationPassword").innerHTML="Укажите пароль";
		var isValid=false;
	}
	else
		document.getElementById("error_RegistrationPassword").innerHTML="";
	
	if(isValid)
	{
		document.getElementById("Registration_submit").setAttribute("class","hidden");
	}
	else
		document.getElementById("Registration_submit").disabled = false;
	
	return isValid;	
}

function registration()
{
	var form=document.getElementById("Form_Admin");	
	form.innerHTML+="<input type=hidden name='action' value='registration'>";
	form.action="index.php?id=Registration";
	form.submit();
} 


function autorizationError( message )
{		
	alert(""+message);
}

 function Cancel()
 {
	var forms= document.getElementsByName('frame');	
	if(forms.length!=0)	
		forms[0].remove();
 }
 
 function Validation()
{
	 var Record= document.getElementById("record");
	 if(Record.value=="")
	 {
		 document.getElementById("error").innerHTML="Укажите значение";		 
		 return false;
	 }
	 return true;
 }
 
function EditRecord( page,id_rec,value_rec )
{
	Cancel();
	var form = document.createElement("form");	
	form.name='frame';
	form.method='post';
	form.action='index.php';	
	form.innerHTML=	
		"<div  class='testForm'>"+
		"<img class='buttonT' src='./Site_Images/remove.png' title='Отменить' "+
			"onclick='Cancel(); return false;' />"+
			"<input type='hidden' name='id' value='"+page+"'>"+// строчный индекс страницы
			"<input type='hidden' name='idRecord' value='"+id_rec+"'>"+//id редактируемой записи
			"<table class='tableL'  >"+
			"<tr><td style='align:center;'  colspan='2'>"+
			" Редактирование"+
			"</tr></td>"+
			"<tr><td>"+
			"<input class ='TextField'  type='text' name ='editRecord' id='record' value='"+value_rec+"' />"+//изменения
			"</td> <td id='error' ></td></tr>"+
			"<tr><td  colspan='2'>"+
			"<input class='button button-gray' type='submit' onclick='return Validation();' >"+
			"</tr></td>"+			
			"</table>"+			
		"</div>";	
	document.body.appendChild(form);
}

function AddRecord( page )
{
	Cancel();
	var form = document.createElement("form");	
	form.name='frame';
	form.method='post';
	form.action='index.php';
	form.innerHTML=
		"<div id='frame' class='testForm' >"+
		"<img class='buttonT'  src='./Site_Images/remove.png' title='Отменить' "+
		"onclick='Cancel(); return false;' />"+
		"<input type=hidden name='id' value='"+page+"'>"+// строчный индекс страницы			
			"<table class='tableL'  >"+
				"<tr><td style='align:center;' colspan='2'>"+
				" Новая запись"+
				"</tr></td>"+
				"<tr><td>"+
				"<input class ='TextField' id='record' type='text' name ='newRecord' value=''/>"+//изменения
				"</td><td id='error'></td></tr>"+
				"<tr><td  colspan='2' >"+
				"<input class='button button-gray' type='submit' onclick='return Validation();'>"+
				"</tr></td>"+			 
			"</table>"+			
		"</div>";	
	document.body.appendChild(form);
}

function rowDel(value_rec)
{
		return "<tr><td style='align:left;'>"+
				" Удалить запись"+
				"</td>"+
				
				"<td>"+	
				"<h3>"+		
				value_rec+
				"</h3>"+	
				"</td></tr>";
}

function DeleteRecord( page,id_rec,value_rec )
{
	Cancel();
	var form = document.createElement("form");	
	form.name='frame';
	form.method='post';
	form.action='index.php';
	form.innerHTML=
	"<form>"+
		"<div  class='testForm'>"+
		"<img class='buttonT' src='./Site_Images/remove.png' title='Отменить' "+
			"onclick='Cancel(); return false;' />"+
			"<input type=hidden name='id' value='"+page+"'>"+// строчный индекс страницы
			"<input type=hidden name='deleteRecord' value='"+id_rec+"'>"+//id редактируемой записи
			"<table class='tableL'  >"+
			rowDel(value_rec)+
			"<tr><td  colspan='2'>"+
			"<input class='button button-gray' type='submit' >"+
			"</td></tr>"+			
			"</table>"+			
		"</div>"+	
	"</form>";
	document.body.appendChild(form);
}
/*
function ErrorDeleteRecord( page,id_rec,value_rec )
{
	Cancel();
	var form = document.createElement("form");	
	form.name='frame';
	form.method='post';
	form.action='index.php';
	form.innerHTML=
	"<form>"+
		"<div  class='testForm'>"+
		"<img class='buttonT' src='./Site_Images/remove.png' title='Отменить' "+
			"onclick='Cancel(); return false;' />"+
			
			"<table class='tableL'  >"+
			"<tr><td style='align:center;'>"+
			" Удалить запись невозможно"+
			"</tr></td>"+			
					
			"</table>"+			
		"</div>"+	
	"</form>";
	document.body.appendChild(form);
}*/

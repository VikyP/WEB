var page="Films";

function show_prompt( flag)
{
	
		var name=prompt("Пожалуйста, введите ваш логин","Гарри Поттер");
		if (name!=null && name!="")
		{
		document.write("Привет " + name + "! Как дела сегодня?");
		}
	
} 



function testForm(name, page)
{
	var form = document.createElement("form");
	
	form.innerHTML=
	"<form action='index.php' method='POST'>"+
	"<div  class='testForm'>"+
		"<input type=hidden name='id' value='"+page+"'>"+
		"<input  type='text' name ='newRecord' value='"+name+"' />"+
		"<input type='submit'>"+	
	"</div>"+
	
	"</form>";
	document.body.appendChild(form);
}
 
 function addslashes( str ) 
	{    	 
	    return str.replace('/(["\'\])/g', "\\$1").replace('/\0/g', "\\0");
	}
 function newSelect(selectIndex)
 {	 
	 var selectHidden=document.getElementById("hidden_"+selectIndex);
	 var selectNew=document.createElement("SELECT");
	 selectNew.innerHTML=selectHidden.cloneNode(true).innerHTML;
	 return selectNew;
 }
 
 

function EditRecordFilms(id_rec)
{
	
	Cancel();
	//e =  window.event;
	var line=document.getElementById('film_'+id_rec);
	//alert( "W ="+e.pageY);
	
	createForm('edit', id_rec);
	
}


function AddRecordFilm( )
{
	Cancel();
	createForm('add', 0);	
}

function DeleteRecordFilm(id_rec,value_rec,dir, genre, img )
{
	Cancel();
	var e =  window.event;
	var top=0;
	
	//if(e.pageY<600)
	// top = (e.pageY-100);
	//else
	// top = (e.pageY-300);
	var form = document.createElement("form");	
	form.name='frame';
	form.method='post';
	form.action='index.php';
	
	form.innerHTML=
	"<form>"+
		"<div  class='testForm' style='top:"+top+"px';>"+
		"<img class='buttonT' src='./Site_Images/remove.png' title='Отменить' "+
			"onclick='Cancel(); return false;' />"+
			"<input type=hidden name='id' value='"+page+"'>"+// строчный индекс страницы
			"<input type=hidden name='deleteRecord' value='"+id_rec+"'>"+//id редактируемой записи
			"<table class='tableL'  >"+
			rowTitle("Удалить запись")+
			rowNameDel(value_rec)+
			rowDirectoreDel(dir)+
			rowGenreDel(genre)+
			rowPosterDel(img)+
			"<tr><td colspan='2' style='align:left;'>"+
			"<input  class='button button-gray' type='submit' value ='Удалить'/>"+
			"</tr></td>"+			
			"</table>"+			
		"</div>"+	
	"</form>";
	document.body.appendChild(form);
}

function createForm(action, id_rec )
{
	Cancel();
	var title_form="";
	var title_action="";
	var id_hidden="";
	var path="defaultPoster.jpg";
	var line= document.getElementById("film_"+id_rec);	
	var path_hidden="";
	
	var value="";
	switch(action)
	{
		case 'add':
		title_form="Новый фильм";
		title_action="newRecord";		
		break;
		
		case 'edit':
		title_form="Редактировать";
		title_action="editRecord";
		id_hidden="<input type=hidden name='idRecord' value='"+id_rec+"'>";	
		value =addslashes((line.getElementsByTagName("td"))[1].innerHTML);				
		var id_dir=(line.getElementsByTagName("td"))[5].innerHTML;		
		var id_genre=(line.getElementsByTagName("td"))[6].innerHTML;	
		path=(line.getElementsByTagName("td"))[7].innerHTML;
		path_hidden="<input type=hidden name='path' value='"+path+"'>";

		break;
	}
	
	var e =  window.event;
	var top=0;	
	//if(e.pageY<600)
	// top = (e.pageY-100);
	//else
	// top = (e.pageY-300);
 
	var form = document.createElement("form");	
	form.name='frame';
	form.method='post';
	form.action='index.php';
	form.setAttribute("enctype","multipart/form-data");
	form.innerHTML=
		"<div  class='testForm' style='top:"+top+"px'; >"+
		"<img class='buttonT'  src='./Site_Images/remove.png' title='Отменить' "+
		"onclick='Cancel(); return false;' />"+		
		"<input type=hidden name='id' value='"+page+"'>"+
			id_hidden+  // скрытое поле с индексом записи	для редактирования	
			path_hidden+
			"<table class='tableL'  >"+				
				rowTitle(title_form)+
				rowName(title_action,value)+
				rowDirector()+
				rowGenre()+	
				rowPoster(path)+
				rowSubmit()+					
			"</table>"+			
		"</div>";	
	 document.body.appendChild(form);
	if(action=="edit")
		{			
		document.getElementById("table_director").selectedIndex=document.getElementById("table_director").options.namedItem(id_dir+"_director").index;
		document.getElementById("table_genre").selectedIndex=document.getElementById("table_genre").options.namedItem(id_genre+"_genre").index;			
		}
}

function rowTitle(title_form)
{
	return "<tr ><td colspan='3'style='align:center;'>"+
				title_form+
				"</td></tr>";
}

function rowName(title_action,value)
{
	
	return	"<tr><td style='align:left;'>"+
				" Название"+
				"</td>"+
				"<td>"+
				'<input class ="TextField" id="record" type="text" name ="'+title_action+'" value="'+addslashes(value)+'" />'+//изменения
				"</td><td id='error'></td></tr>";	
}

function rowNameDel(value)
{	
	return	"<tr><td style='align:left;'>"+
				"Название"+
				"</td>"+
				"<td>"+
				"<h3>"+
				addslashes(value)+
				"</h3>"+
				"</tr></td>";	
}

function rowDirector()
{
		return "<tr><td style='align:left;'>"+
				" Режиссер"+
				"</td>"+
				"<td colspan='2'>"+
				"<select class ='TextFieldForm' id='table_director' name='director' >"+
				addslashes(newSelect("director").innerHTML) +	
				"</select>"+
				"</td></tr>";
}

function rowDirectoreDel(dir)
{
		return "<tr><td style='align:left;'>"+
				" Режиссер"+
				"</td>"+
				"<td >"+	
				"<h3>"+		
				dir+
				"</h3>"+	
				"</td></tr>";
}


function rowGenre()
{
	return		"<tr>"+
					"<td style='align:left;'>"+
						" Жанр"+
					"</td>"+
					"<td colspan='2'>"+
						"<select class ='TextFieldForm' id='table_genre' name='genre'>"+
							newSelect("genre").innerHTML +
						"</select>"+
					"</td>"+
				"</tr>";
	
}


function rowGenreDel(genre)
{
	return		"<tr>"+
					"<td style='align:left;'>"+
						" Жанр"+
					"</td>"+
					"<td>"+
					"<h3>"+	
						genre+
						"</h3>"+	
					"</td>"+
				"</tr>";
	
}

function rowPoster(path)
{
	return		"<tr>"+
					"<td style='align:left;'>"+
						"Постер"+
					"</td>"+
					"<td colspan='2'>"+
						"<img class='image' src='images_small/"+path+"' alt='Image' />"+
					"</td>"+
				"</tr>"+
				"<tr>"+					
					"<td style='align:left;'>"+
						"Другой файл"+
					"</td>"+
					"<td>"+
						"<input type='file' name ='photofile' />"+
					"</td>"+					
				"</tr>";	
}

function rowPosterDel(path)
{
	return		"<tr>"+					
					"<td colspan='2'>"+
						"<img class='image' src='images_small/"+path+"' alt='Image' />"+
					"</td>"+
				"</tr>";
}

function rowSubmit()
{
	return "<tr><td colspan='3' style='align:left;'>"+
				"<input  class='button button-gray' type='submit' onclick='return Validation();'/>"+
				"</td></tr>";
	
	
}

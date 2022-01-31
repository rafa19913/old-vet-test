	
	 function sumar(numero){
		 	
		  if(!isNaN(numero.value))
		  var cantidad = parseInt(numero.value);
		  else
		  var cantidad = 0;
		  
		  cantidad++;
		  
		  numero.value = cantidad;	  
	  }
	  function restar(numero){
		  if(!isNaN(numero.value))
		  var cantidad = parseInt(numero.value);
		  else
		  var cantidad = 1;
		  
		  if(cantidad > 1)
		  cantidad--;
		  else 
		  cantidad = 1;
		  numero.value = cantidad;	  
	  }

	  function agregar(id_s,id_p,cantidad){
		if(!isNaN(cantidad)){
			var zona = document.getElementById('lista');
			zona.innerHTML = '<h5>Material Agregado</h5>Cargando...';
		  x = new XMLHttpRequest();
		  x.onreadystatechange=function(){
			if(x.readyState==4 && x.status == 200){
				zona.innerHTML = x.responseText;
			}
		  }
		
		  x.open('GET','funciones.php?opcion=2&id_s='+id_s+'&id_p='+id_p+'&cant='+cantidad,true);
		  x.send();
		  
		}else
		alert("Ingrese solo el número en la cantidad.");
	  }


	  function quitar(id_s,id_p){
			var zona = document.getElementById('lista');
			zona.innerHTML = '<h5>Material Agregado</h5>Cargando...';
		  x = new XMLHttpRequest();
		  x.onreadystatechange=function(){
			if(x.readyState==4 && x.status == 200){
				zona.innerHTML = x.responseText;
			}
		  }
		
		  x.open('GET','funciones.php?opcion=4&id_s='+id_s+'&id_p='+id_p,true);
		  x.send();
		  
	  }	  
	  
	  
	  
	  
	  
	  function buscar(txt,id_s){
		  xmlhttp = new XMLHttpRequest();
		  zona = document.getElementById('agregar');
		  
		  zona.innerHTML = "<h5>Lista de Material</h5>Cargando..."
		  xmlhttp.onreadystatechange=function(){
			
			if(xmlhttp.readyState==4 && xmlhttp.status == 200){
				
			zona.innerHTML = xmlhttp.responseText;
			return false;
			}
		  }
		  
		  xmlhttp.open('GET','funciones.php?opcion=1&buscar='+txt+'&id_s='+id_s ,true);
		  xmlhttp.send();
		  
		  
	  }


function lista(id_s){
	
		  xmlhttp2 = new XMLHttpRequest();
		  zona2 = document.getElementById('lista');
		  
		  zona2.innerHTML = "<h5>Lista de Material</h5>Cargando..."
		  xmlhttp2.onreadystatechange=function(){
			
			if(xmlhttp2.readyState==4 && xmlhttp2.status == 200){
				zona2.innerHTML = xmlhttp2.responseText;
			}
		  }
		  
		  xmlhttp2.open('GET','funciones.php?opcion=3&id_s='+id_s,true);
		  xmlhttp2.send();
		  
		  
}
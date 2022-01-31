//asdasdasdasd
	 function accion(opcion,id_p,cantidad){

		if(!isNaN(cantidad) || opcion != '2'){
		zona = document.getElementById('loading');
		zona.innerHTML = '<img src="../images/loading2.gif" width="23" height="23" />';
		  x = new XMLHttpRequest();
		  x.onreadystatechange=function(){
			if(x.readyState==4 && x.status == 200){
				document.getElementById('carrito').innerHTML = x.responseText;
				zona.innerHTML = '';
				if(opcion==2){
					document.getElementById('codigo').value = '';
					document.getElementById('codigo').focus();
					document.getElementById('cantidad').value = '1';
				}
				mostrarTotal(document.getElementById('id_cliente').value);
			}
		  }
		
		  x.open('GET','funciones.php?id_p='+id_p+'&cantidad='+cantidad+'&opcion='+opcion,true);
		  x.send();
	 }else 
	 alert('Ingresa una cantidad válida');
		
	  }
	  
	  function cargarCliente(valor,txt){
		  
		  document.getElementById('servicios').innerHTML = '';
		  document.getElementById('id_cliente').value = 0;
		  if(valor){
			  zona = document.getElementById('loading');
			  zona.innerHTML = '<img src="../images/loading2.gif" width="23" height="23" />';
			  xc = new XMLHttpRequest();
			  xc.onreadystatechange=function(){
				  if(xc.readyState==4 && xc.status == 200){
					   document.getElementById('clientes').innerHTML = xc.responseText;
					   zona.innerHTML = '';
					   
				  }
		  	  }
		  xc.open('GET','funciones.php?opcion=4&txt='+txt,true);
		  xc.send();
		  }
		  else{ 
		  	document.getElementById('clientes').innerHTML = '';
			document.getElementById('servicios').innerHTML = '';
		  }
		  mostrarTotal(document.getElementById('id_cliente').value);
		  
	  }
	  
	  function cargarServicios(id_c){
		  
		  document.getElementById('servicios').innerHTML = '';
		  document.getElementById('id_cliente').value = id_c;
		  zona = document.getElementById('loading');
		  zona.innerHTML = '<img src="../images/loading2.gif" width="23" height="23" />';
		  xs = new XMLHttpRequest();
		  
		  xs.onreadystatechange=function(){
			  if(xs.readyState==4 && xs.status ==200){
				  document.getElementById('servicios').innerHTML = xs.responseText;
				  zona.innerHTML = '';
				  mostrarTotal(id_c);
				  
			  }
		  }
		  xs.open('GET','funciones.php?opcion=5&id_c='+id_c,true);
		  xs.send();
		  
	  }
	  
	  function mostrarTotal(id_c){
		  xt = new XMLHttpRequest();
		  zona = document.getElementById('loading');
		  zona.innerHTML = '<img src="../images/loading2.gif" width="23" height="23" />';
		  xt.onreadystatechange=function(){
			  if(xt.readyState==4 && xt.status==200){
				  document.getElementById('total_compra').innerHTML = xt.responseText;
				  zona.innerHTML = '';				  
			  }
		  }
		  xt.open('GET','funciones.php?opcion=6&id_c='+id_c,true);
		  xt.send();
	  }
	  
	  function pulsarCliente(e,txt) {
		   
 	 	tecla = (document.all) ? e.keyCode :e.which;
		
		if(tecla!=13)
		return (tecla!=13);
		else
		cargarCliente(true,txt);
		return (tecla!=13);

	  } 
	  function pulsarCodigo(e,txt) {
		   
 	 	tecla = (document.all) ? e.keyCode :e.which;
		
		if(tecla!=13)
		return (tecla!=13);
		else
		accion(2,codigo.value,cantidad.value)
		return (tecla!=13);

	  } 
	  
	  
	  function comprar(opcion){
		  zona = document.getElementById('loading');
		  zona.innerHTML = '<img src="../images/loading2.gif" width="23" height="23" />';
		  zona2 = document.getElementById('zona_compra');
		  var tipo = document.getElementById('tipo_pago').value;
		  var forma = document.getElementById('forma_pago').value;
		  var id_c = document.getElementById('id_cliente').value;
		  var total = document.getElementById('total_pagado').value;
			var pago = document.getElementById('pago').value;
		  
		  if(tipo == "Credito")
		  var abono = document.getElementById('abono').value;
		  else
		  var abono = 0;
		  
		  
		  if(opcion==7){
				if(isNaN(pago) || pago == ""){
					alert('Ingrese la cantidad que pagó el cliente');
					return false;
				}
				var accion = 'finalizar';
			}
		  else
		   var accion = 'cancelar';
			 
			 
		  if(confirm('¿Desea '+accion+' la venta?')){
			  xco = new XMLHttpRequest();
			  
			  xco.onreadystatechange=function(){
				  if(xco.readyState==4 && xco.status==200){
					  zona.innerHTML = '';
					  zona2.innerHTML = xco.responseText;
						var cambio = pago - total;
						
						alert('El cambio es de $' + cambio);
					  alert(document.getElementById('resultado_compra').innerHTML);
						if(opcion==7)
					  imprimir(document.getElementById('ticket').innerHTML);
					  location.reload(true);
				  }
			  }
			  xco.open('GET','funciones.php?opcion='+opcion+'&id_c='+id_c+'&tipo='+tipo+'&forma='+forma+'&total='+total+'&pago='+abono,true);
			  xco.send();
		  }else
		  zona.innerHTML= '';
	  }
	  

	function zonaAbono(aux){
	var zonaA = document.getElementById('zona_abono');
	
	if(aux){
	zonaA.innerHTML = '<br>Abonó:<input type="text" name="abono" id="abono" value="0" />';
	document.getElementById('tipo_pago').value='Credito';
	}
	else{
	zonaA.innerHTML = '';
	document.getElementById('tipo_pago').value='Contado';
	}
	
		
	}
	  
	  // JavaScript Document
function imprimir(texto){
 // var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(texto);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}
	

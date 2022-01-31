/////////////// Documento de validaciones

//mascaras de validacion
function pesoCorrecto(txt){
	//regresa verdadero si es correcto
	if((!esFraccion(txt) && !esnumero(txt)))
	return false;
	else
	return true;
}

//funcion para validar si es un numero
function esnumero(txt){
	var codigo = /^[0-9]+$/;
	return codigo.test(txt);
}
//validacion para saber si es una fraccion
function esFraccion(txt){

	var codigo = /^\d+\.\d+$/;
	return codigo.test(txt);
}

function tieneLetras(txt){
var codigo = /[a-zA-Z]+/;
return codigo.test(txt);	
}

function correoCorrecto(txt){  
	//despues con un . y al final la extencion
    var correo =/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/ ;
    return correo.test(txt)
}

function telefonoCorrecto(txt){
	var telefono = /^[0-9\*]+$/;
	return telefono.test(txt);
}

function cpCorrecto(txt){
	var cp = /^[0-9]{5}$/;
	return cp.test(txt);
}


/////////////validaciones de formulario

function validarMascota(){

var nombre = document.getElementById('nombreMascota');
var peso = document.getElementById('peso');
var id_raza = document.getElementById('id_raza');
var nueva_raza = document.getElementById('nueva_raza');
//alert(nueva_raza.value);
if(nombre.value.length == 0){
	alert("Ingrese el nombre de la mascota");
	nombre.focus();
	return false;
}
else if(!pesoCorrecto(peso.value)){
	alert("Ingresa el peso de la mascota. (Ej. 5.500)");
	peso.focus();
	return false;
	
}else if(nueva_raza.value){
	
	var raza = document.getElementById('raza2');
	if(raza){
		if(raza.value.length==0){
		alert('Ingresa el nombre de la nueva raza.');	
		raza.focus();
		return false;
		}
	}
}

return true;
	
}

function validarCliente(){
	
	
	//aisgno los valores a cada variable
	var nombre = document.getElementById('nombre');
	var apellido = document.getElementById('apellido');
	var correo = document.getElementById('email');
	var telefono = document.getElementById('telefono');
	var colonia = document.getElementById('colonia');
	var calle = document.getElementById('calle');
	var numero = document.getElementById('numero');
	var celular = document.getElementById('celular');
	var cp = document.getElementById('codigo_postal');
	
	if(nombre.value.length==0){
	nombre.focus();
	alert("Ingresa el nombre del cliente");	
	return false;
	}else if(apellido.value.length==0){
		apellido.focus();
		alert('Ingresa el apellido del cliente');
		return false;
	}else if(!correoCorrecto(correo.value) && correo.value.length>0){
		correo.focus();
		alert('Ingresa un correo valido');
		return false;
	}else if(!telefonoCorrecto(telefono.value)){
		telefono.focus();
		alert('Ingresa el telefono sin guiones ni espacios');
		return false;
	}else if(!telefonoCorrecto(celular.value) && celular.value.length > 0){
		celular.focus();
		alert('Ingrese el celular sin guiones ni espacios');
		return false;
	}else if(colonia.value == 0){
		colonia.focus();
		alert('Ingresa la colonia o fraccionamiento del cliente');
		return false;
	}else if(calle.value == 0){
		calle.focus();
		alert('Ingresa la calle del cliente');
		return false;
	}else if(numero.value == 0){
		numero.focus();
		alert('Ingresa el numero del cliente');
		return false;
	}else if(!cpCorrecto(cp.value) && cp.value.length>0){
		cp.focus();
		alert('Ingresa un Código Postal correcto');
		return false;
		
	}
	
	return true;
		
}


function validarModificarCliente(){

var nombre = document.getElementById('nombre');
var correo = document.getElementById('correo');
var telefono = document.getElementById('telefono');
var celular = document.getElementById('celular');
var direccion = document.getElementById('direccion');

if(nombre.value.length==0){
	nombre.focus();
	alert("Ingresa el nombre del cliente");	
	return false;
	}else if(!correoCorrecto(correo.value) && correo.value.length>0){
		correo.focus();
		alert('Ingresa un correo valido');
		return false;
	}else if(!telefonoCorrecto(telefono.value)){
		telefono.focus();
		alert('Ingresa el telefono sin guiones ni espacios');
		return false;
	}else if(!telefonoCorrecto(celular.value) && celular.value.length > 0){
		celular.focus();
		alert('Ingrese el celular sin guiones ni espacios');
		return false;
	}else if(direccion.value == 0){
		direccion.focus();
		alert('Ingresa la direccion del cliente');
		return false;
	}
return true;
}


function validarVacuna(){

var nombre = document.getElementById('nombre');
var descripcion = document.getElementById('descripcion');

if(nombre.value.length == 0){
alert('Ingresa el nombre de la vacuna');
nombre.focus();
return false;
}else if(descripcion.value.length == 0){
alert('Ingresa la descripción de la vacuna');
descripcion.focus();
return false;
}
return true;	
	
}
function validarDesparasitante(){

var nombre = document.getElementById('nombre');
var producto = document.getElementById('producto');
var tipo = document.getElementById('tipo');

if(nombre.value.length == 0){
	alert('Ingresa el nombre del desparasitante');
	nombre.focus();
	return false;
}else if(producto.value.length == 0){
	alert('Ingresa el producto activo del desparasitante');
	producto.focus();
	return false;
}else if(tipo.value.length == 0){
	alert('Ingresa el tipo del edsparasitante');
	tipo.focus();
	return false;
}

return true;	
}

function validarServicio(){
var nombre = document.getElementById('nombre');
var descripcion = document.getElementById('descripcion');
var precio = document.getElementById('precio');
if(nombre.value.length == 0){
	alert('Ingresa el nombre del servicio');
	nombre.focus();
	return false;
}else if(descripcion.value.length == 0){
	alert('Ingresa la descripción del servicio');
	descripcion.focus();
	return false;
}else if(!pesoCorrecto(precio.value)){
	alert('Ingresa el precio del servicio');
	precio.focus();
	return false;
}

return true;	
}


function validarProducto(){

var codigo = document.getElementById('codigo');
var nombre = document.getElementById('nombre');
var unidad = document.getElementById('unidad');
var precio = document.getElementById('precio');
var cantidad = document.getElementById('cantidad')	

if(codigo.value.length == 0){
	alert('Ingresa el codigo de barras del producto');	
	codigo.focus();
	return false;
}else if(nombre.value.length == 0){
	alert('Ingresa el nombre del producto');	
	nombre.focus();
	return false;
}else if(unidad.value.length == 0){
	alert('Ingresa la presentación del producto');	
	unidad.focus();
	return false;
}else if(!pesoCorrecto(precio.value)){
	alert('Ingresa el precio del producto. Ej 120.50');	
	precio.focus();
	return false;
}else if(!esnumero(cantidad.value)){
	alert('Ingresa la cantidad que tiene del producto.');	
	cantidad.focus();
	return false;
}


return true;
	
}

function validarEmpleado(){
	var nombre = document.getElementById('nombre');
	var email = document.getElementById('email');
	var psw = document.getElementById('psw');
	var psw2 =document.getElementById('psw2');

if(nombre.value.length==0){
alert('Ingresa el nombre del empleado');	
nombre.focus();
return false;
}else if(!correoCorrecto(email.value)){
alert('Ingresa un correo válido');	
email.focus();
return false;
}else if(psw.value.length==0){
alert('Ingresa la contraseña del empleado');	
psw.focus();
return false;
}else if(psw.value != psw2.value){
alert('Las contraseñas deben de coincidir.');	
psw2.focus();
return false;
}
	
	
return true;
}

function validarClienteMascota(){

if(validarCliente()){
	if(validarMascota())
	return true;
	else
	return false;
}else
return false;

return false;
	
}

function validarCompraPruducto(){

var precio = document.getElementById('precio');
var cantidad = document.getElementById('cantidad');

if(!pesoCorrecto(precio.value)){
	alert('Ingresa el precio del producto. Ej 120.50');
	precio.focus();
	return false;
}else if(!esnumero(cantidad.value)){
	alert('Ingresa la cantidad que tiene del producto.');
	cantidad.focus();
	return false;
}

return true;
	
}

function validarSalida(){
	
var motivo = document.getElementById('motivo');
var cantidad = document.getElementById('cantidad');
var pass_oc = document.getElementById('p_oculto').value;
var pass = document.getElementById('password');


if(!esnumero(cantidad.value)){
	alert('Ingresa la cantidad de salida del producto.');
	cantidad.focus();
	return false;
}
else if(motivo.value === ""){
	alert('Ingresa el motivo de la salida del producto');
	motivo.focus();
	return false;
}else if (pass_oc != pass.value) {
	pass.focus();
	alert('La contraseña ingresada no es correcta.');
	return false;
}

return true;
	
}

function validarModificarProducto () {
	if(validarProducto()){
		var pass_oc = document.getElementById('p_oculto').value;
		var pass = document.getElementById('password');
		if (pass_oc != pass.value) {
			pass.focus();
			alert('La contraseña ingresada no es correcta.');
			return false;
		}
		return true;
	}else{
		return false;
	}
}
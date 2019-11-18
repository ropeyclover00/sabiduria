# Requisitos Funcionales del Proyecto Final

* Se espera un sistema web utilizando Laravel u otro framework de desarrollo.
* Agregar un archivo README.md con el nombre y primer apellido de los desarrolladores.
* En caso de tratarse de otro lenguaje distinto a Larave, incluir en el README.md las instrucciones de instalación y puesta en marcha, así como caulquier pre-requisitios adicional.

## Entrega

* Se enviará en la tarea "Proyecto Final" de clasroom el enlace hacia su repositorio en git que contenga el código de su sistema. El repositorio deberá ser público o se deberán proporcionar los permisos para poder descargarlo. No se aceptan sistemas en zip.
* La fecha y hora de entrega señalada será el límite para enviar el enlace a su repositorio, por lo que a partir de este momento se reciben los enlaces hacia su repositorio. Una vez entregado y revisado, no se aceptan correcciones.
* Se señalará una fecha y hora para entrega de calificación y en caso de que lo requieran, revisar el origen de su calificación.

## Base de datos

* La estructura de la base de datos debe estar dentro del proyecto y poderse instalar. (Uso de migraciones)
* Generar datos de prueba para al menos una tabla. (Implementación de al menos un seeder y una factory)

## Autenticación, autorización y seguridad

* Realizar autenticación de usuarios mediante correo y contraseña.
* Validar toda información que se reciba a partir de una formulario.
* Restringir el acceso a ciertas rutas dependiendo de el tipo de usuario u alguna condición. (Middleware, Gates o Policies).
* **Extra:** Login mediante credenciales de terceros (Facebook, Google, etc). (Passport / Socialite).

## GUI

* Crear vistas utilizando blade
* Crear al menos un layout e implementarlo en vistas
	* Mostrar nombre, nombre de usuario o correo del usuario.
	* Mostrar opción para ingresar (login) o salir (logout) del sistema según corresponda.
	* Mostrar menú de navegación.
* Implementar Bootstrap u otro framework de css.
* **Importante:** Mostrar mensajes al usuario cuando:
	* Exista un error de validación al completar un formulario.
	* Se haya completado una tarea, sea con éxito, con errores o si require información adicional. (Ej. Al crear, eliminar o editar).
	* Existan listados vacíos.
* Cuando exista un error al validar un formulario o se esté editando información de un registro existente, el formulario deberá mostrar la información capturada o a editar.
* Los enlaces o inclusión de recursos locales (css, js, etc) deberán generarse utilizando los helpers adecuados. (Ej. action, route, asset).

## ORM (Eloquent)

* Definir una relación de cada uno de los siguientes tipos y sus inversas dentro de los modelos:
	* "uno a muchos" (1:n)
	* "muchos a muchos" (n:n)
	* polimórfica o polimórfica muchos a muchos.
* Prevenri problema de (n+1) consultas. ("Eager Loading" utilizando with() al consultar múltiples registros con n relaciones).

* **Extra:** Utilizar al menos en una consulta "Constraining Eager Load".
* Declarar "fillable" o "guarded" en al menos un modelo.
* **Extra:** Almacenar información adicional en al menos una tabla pivote.
* Registrar fecha y hora de creación / edición de un registro. (time stamps) en al menos un modelo.
* Implementar "borrado lógico" (Soft Delete) en al menos un modelo.
* Crear métodos que modifiquen la información al guardarla o al recuperarla. (Accessor o Muttator).

## Controladores

* Crear al menos un controlador tipo resource.
* **Extra:** Crear un controlador tipo resource anidado.
* Crear al menos un método personalizado dentro de un controlador.

## API

* Crear y consultar al menos un controlador con al menos un método que regrese un json.

## Archivos

Se deberá crear e implementar un cargador de archivos que permita:

* Cargar uno o muchos archivos a la vez.
* Listar los archivos o mostrar el archivo cargado.
* Eliminar el archivo.

## Correo Electrónico

* Implementar verificación de correo electrónico al realizar registro.
* **Extra:** Envío de correo electrónico personalizado.

## Sheduler y Jobs

* **Extra:** Implementar la ejecución de una tarea recurrente de forma automática.
* **Extra:** Implementar el uso de Jobs para la ejecución de múltiples tareas.

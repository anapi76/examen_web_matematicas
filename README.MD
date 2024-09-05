## Utilizando la estructura vista en clase del MVC deberemos crear una página web que haga:
1. Se inicie con la ruta “/” en la que nos muestre un menú con 5 botones para elegir una de las opciones y nos debe redirigir a esa ruta: (1 punto)
1.1. Alumno: \alumnos.
1.2. Suma: \sumar.
1.3. Resta: \restar.
1.4. Multiplicación: \multiplicar.
1.5. División: \dividir.
2. Cuando accedamos a la página del alumno, mediante la ruta /alumno. Esa página se encargará de mostrarnos la información del alumno y el nivel actual que tenga. Para ello deberemos hacer os siguientes pasos: (2 puntos)
2.1. Primero deberá mostrar tres campos para rellenar el nombre, primer apellido y segundo apellido, además de un botón que nos actualice los datos. Al pulsar, si existen datos mostrará todos los datos del alumno y los datos de todos los niveles que tiene el alumno en cada una de las operaciones.
2.2. Si no se envían datos al pulsar el botón, o no existe ese alumno en la BB.DD. deberá mostrar una lista con los datos de todos los alumnos, que deberá hacerse en la ruta /listaAlumnos.
2.3. En el listado de alumnos, de la ruta /listaAlumnos, el texto del nombre será un link que mostrará los datos del alumno seleccionado.
3. Cuando accedamos a la página de sumar, mediante la ruta /sumar. Esa página se encargará de mostrar dos números enteros aleatorios para sumarse y un campo numérico para que el alumno pueda introducir el resultado. A la vez deberá mostrar tres campos de texto para rellenar el nombre, primer apellido y segundo apellido del alumno, así como un botón para comprobar el resultado introducido. (2 puntos)
3.1. Cuando pulsemos debe comprobar si el alumno está en la BB.DD. Si no existe el alumno en la tabla lo debe añadir.
3.2. Tras esto, añadirá un nuevo intento de esa operación y ese alumno.
3.3. También deberá actualizar o insertar en la tabla nivel la operación del alumno, incrementando el número de fallos o de aciertos según corresponda.
4. Cuando accedamos a la página de restar, mediante la ruta /restar. Esa página debe hacer lo mismo que la de sumar, pero en este caso restando los valores. (0.75 puntos)
5. Cuando accedamos a la página de multiplicar, mediante la ruta /multiplicar. Esa página debe hacer lo mismo que la de sumar, pero en este caso multiplicando los valores. (0.75 punto)
6. Cuando accedamos a la página de dividir, mediante la ruta /dividir. Esa página debe hacer lo mismo que la de sumar, pero en este caso dividiendo los valores. (1.5 punto)
6.1. Para la división es importante que tengamos en cuenta que estamos haciendo una división de números enteros y el resultado ha de ser otro número entero. Por lo tanto, es posible que exista un resto de la división. Por lo tanto, tendremos que poner dos campos: Uno para el resultado de la división y otro para el resto.
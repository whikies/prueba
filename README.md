# Prueba técnica Symfony

## Tareas realizadas
- Creación de servicio para operaciones
- Creación de controlador para realizar operaciones aritméticas con cuatro endpoint
- Creación de comando para realizar operaciones aritméticas
- Test unitarios del servicio
- Frontend realizado con React
- Implementación de reposiorio git

## Operaciones disponibles
- Suma
- Restar
- Multiplicación
- División
- Porcentaje
- Raíz cuadrada
- Raíz cúbica
- Exponencial

## Información sobre el proyecto
- Versión de symfony 6.2.6
- Versión de php 8.1
- Webpack
- React
- Docker

## Instalación
- Descargar el repositorio en una carpeta
- Ejecutar: docker-compose up -d
- Ejecutar: docker exec -t -i test_php bash
- Ejecutar: composer install && yarn install && yarn build;
- Para ver la vista con react acceder a: http://localhost:8000/
- Para ver la vista con el formulario de symfony acceder a: http://localhost:8000/form
- Para ver la vista con el formulario de symfony ejecutado con javascript acceder a: http://localhost:8000/form-js

## Comando
El comando realiza las mismas acciones que el controlador

Para ejecutar el comando:
- docker exec -t -i test_php bash
- php bin/console app:operation --help

## Pruebas unitarias
Para ejecutar las pruebas:
- docker exec -t -i test_php bash
- php bin/phpunit

## Información adicional
El controlador tiene cuatro métodos, uno para mostrar el formulario react, otro para mostrar el formulario de symfony, otro para mostrar el formulario de symfony ejecutado con javascript y otro para hacer las operaciones.

El servicio realiza las operaciones aritméticas disponibles con sus correspondientes validaciones

El formulario es un formulario con React incrustado dentro del mismo symfony

El formuario de symfony es un formulario de php (FormType) renderizado con las plantillas twig

Se ha utilizado typescript y scss con el webpack de symfony

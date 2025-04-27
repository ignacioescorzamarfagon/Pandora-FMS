# Prueba técnica de desarrollo de Pandora FMS.

La prueba técnica se compone de dos ejercicios uno de decodificación y otro de un pequeño sistema de reserva de citas.

# Tecnologías utilizadas.

- PHP 8.2
- Apache
- MySQL 8.0
- phpMyAdmin
- Docker y Docker Compose
- HTML5, CSS3, JavaScript (AJAX)

# Estructura del proyecto.

Pandora FMS/

- docker-compose.yaml
- Dockerfile
- README.md
- .gitignore
- src/
  - index.php
  - sistema_citas/
    - index.php
    - check_dni.php
    - save_appointment.php
    - css/
      - style.css
    - js/
      - functions.js
  - decodificacion/
    - index.php

# Requisitos previos.

Antes de comenzar, asegurate de tener instalado en tu máquina:

- Docker
- Docker compose

# Instalación

1.  Clona el repositorio https://github.com/ignacioescorzamarfagon/Pandora-FMS
2.  Accede al directorio del proyecto: Pandora FMS/
3.  Construye y levanta los contenedores: docker compose up --build -d
4.  Accede a la aplicación: Web principal:
    http://localhost:8080
    phpMyAdmin: http://localhost:8081
    Usuario: root
    Contraseña: root
    Al levantar los contenedores se deberían de crear automáticamente la base de datos pandoradb y sus credenciales:
    - Usuario: pandoradb_user
    - Contraseña: pandoradb_pass
    - Base de datos: pandoradb

# Menús disponibles

Al acceder a http://localhost:8080, encontrarás dos opciones principales:

- Decodificación: Redirige al ejercicio 1.
- Sistema de Citas: Redirige al ejercicio 2.

@echo off
echo =========================================
echo Configuración y ejecución de Laravel Sail
echo =========================================

:: Paso 1: Cambiar al directorio del proyecto
cd %~dp0

:: Paso 2: Instalar dependencias de Composer
echo Instalando dependencias de Composer...
vendor\bin\sail composer install

:: Paso 3: Instalar dependencias de npm
echo Instalando dependencias de npm...
vendor\bin\sail npm install

:: Paso 4: Copiar el archivo .env
echo Copiando el archivo .env...
copy .env.example .env

:: Paso 5: Generar la clave de aplicación
echo Generando la clave de aplicación...
vendor\bin\sail artisan key:generate

:: Paso 6: Ejecutar migraciones
echo Ejecutando migraciones...
vendor\bin\sail artisan migrate

:: Paso 7: Levantar los contenedores de Sail
echo Levantando los contenedores de Sail...
vendor\bin\sail up -d

:: Paso 8: Compilar assets
echo Compilando assets...
vendor\bin\sail npm run dev

:: Mensaje final
echo =========================================
echo Proyecto Laravel en funcionamiento en Sail.
echo Puedes acceder en http://localhost
echo =========================================
pause

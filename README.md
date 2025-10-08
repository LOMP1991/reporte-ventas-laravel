# 📊 Sistema de Reportes de Ventas - Laravel

Sistema de reportes interactivos con gráficos y exportación a PDF.

## 🎯 Características

- ✅ Dashboard con métricas (Total Ventas, Transacciones, Venta Promedio)
- ✅ Gráficos interactivos (Chart.js)
- ✅ Filtros por rango de fechas
- ✅ Exportación a PDF
- ✅ Diseño responsivo (Tailwind CSS)

## 🔧 Requisitos

## 🔧 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **XAMPP** (incluye Apache, MySQL y PHP)
- **PHP 8.1 o superior** (incluido en XAMPP)
- **Composer** (gestor de dependencias de PHP)
- **Git** (para clonar el repositorio)

## 📦 Instalación

### Paso 0: Instalar Composer (si no lo tienes)

**Windows:**
1. Descarga el instalador: https://getcomposer.org/Composer-Setup.exe
2. Ejecuta el instalador
3. Cuando te pida la ruta de PHP, selecciona: `C:\xampp\php\php.exe`
4. Completa la instalación
5. **Reinicia tu terminal/CMD/Git Bash**
6. Verifica la instalación:
```bash
   composer --version

Linux/Mac:
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer
php -r "unlink('composer-setup.php');"
composer --version

## 📦 Instalación

### 1. Clonar el Repositorio
```bash
# Clonar el proyecto
git clone https://github.com/LOMP1991/reporte-ventas-laravel.git

# Entrar al directorio
cd reporte-ventas-laravel

2. Instalar Dependencias

# Instalar dependencias de PHP
composer install


3. Configurar el Proyecto

# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

#Migrar las tablas necesaria
php artisan migrate

# Limpiar caché
php artisan config:clear
php artisan cache:clear

4. Ejecutar el Proyecto

# Iniciar servidor de desarrollo
php artisan serve

5. Acceder al Reporte
Abre tu navegador y ve a:
http://localhost:8000/reporte

📂 Estructura del Proyecto

reporte-ventas-laravel/
├── app/Http/Controllers/
│   └── ReportController.php       # Controlador principal
├── resources/views/reports/
│   ├── sales.blade.php            # Vista del dashboard
│   └── sales-pdf.blade.php        # Plantilla PDF
├── routes/
│   └── web.php                    # Rutas del sistema
└── README.md                      # Este archivo


Tecnologías Utilizadas

Laravel 11 - Framework PHP
Chart.js - Gráficos interactivos
Tailwind CSS - Estilos
DomPDF - Exportación PDF

🚀 Funcionalidades
Métricas Principales

Total Ventas: Suma de todas las transacciones
Transacciones: Número total de ventas
Venta Promedio: Valor promedio por transacción

Gráficos

Ventas por Categoría: Gráfico circular (pie chart)
Ventas por Día: Gráfico de línea temporal

Exportación

Descarga reporte en formato PDF
Incluye tabla detallada de todas las transacciones

🔄 Conectar con Base de Datos (Opcional)
Si quieres usar datos reales de MySQL:


1. Configurar .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=root
DB_PASSWORD=


🐛 Solución de Problemas
Database file at path [C:\xampp\htdocs\Prueba\reporte-ventas-laravel\database\database.sqlite] does not exist: "php artisan migrate"
php artisan config:clear
bashphp artisan view:clear
php artisan cache:clear
Puerto 8000 ocupado
bashphp artisan serve --port=8080



Desarrollado con Laravel 11 y PHP 8.1+

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

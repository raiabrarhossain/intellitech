@echo off
title NEXA INTELLITECH - Multi-Domain Automation & AI Server
echo =====================================================================
echo           NEXA INTELLITECH PLATFORM
echo   Unified Home, Office, Factory, Window Automation & AI Agents
echo =====================================================================
echo.
echo Starting local PHP development server at http://localhost:8000 ...
echo Press Ctrl+C at any time to stop the server.
echo.

set PHP_BIN=C:\Users\defaultuser0.DESKTOP-P7AKPL3\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe

if exist "%PHP_BIN%" (
    start http://localhost:8000
    "%PHP_BIN%" -S localhost:8000
) else (
    echo [INFO] Searching system PATH for php...
    start http://localhost:8000
    php -S localhost:8000
)

pause

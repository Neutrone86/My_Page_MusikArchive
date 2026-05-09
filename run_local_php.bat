@echo off
chcp 65001 > nul
title Music Archive Local Server
cd /d "%~dp0"
echo Starting PHP local server for Music Archive...
echo URL: http://127.0.0.1:8000/
echo Admin: http://127.0.0.1:8000/login/
echo Login: admin
echo Password: 123
echo.
start "" "http://127.0.0.1:8000/"
php -S 127.0.0.1:8000
pause

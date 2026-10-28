@echo off
title AV Global Development Server
echo Starting PHP Development Server on http://localhost:8000 ...
cd /d "C:\Users\Abhay\Desktop\av-global"
"C:\xampp\php\php.exe" -S localhost:8000 -t "C:\Users\Abhay\Desktop\av-global"
pause

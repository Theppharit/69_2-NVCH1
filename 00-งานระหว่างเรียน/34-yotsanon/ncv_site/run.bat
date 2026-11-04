@echo off
chcp 65001 >nul
call venv\Scripts\activate || exit /b 1
rem เปิด Tailwind แบบ watch ในหน้าต่างแยก แล้วรันเซิร์ฟเวอร์ Django
start "tailwind" cmd /k npm run watch
python manage.py runserver

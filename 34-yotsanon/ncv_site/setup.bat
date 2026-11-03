@echo off
chcp 65001 >nul
echo === ติดตั้งโปรเจกต์เว็บไซต์ วิทยาลัยอาชีวศึกษานครราชสีมา ===

where python >nul 2>nul || (echo ไม่พบ Python กรุณาติดตั้งจาก https://www.python.org/downloads/ แล้วรันใหม่ & exit /b 1)
where npm >nul 2>nul || (echo ไม่พบ Node.js กรุณาติดตั้งจาก https://nodejs.org/ แล้วรันใหม่ & exit /b 1)

python -m venv venv || exit /b 1
call venv\Scripts\activate || exit /b 1
python -m pip install --upgrade pip
pip install -r requirements.txt || exit /b 1

call npm install || exit /b 1
call npm run build || exit /b 1

python manage.py makemigrations core || exit /b 1
python manage.py migrate || exit /b 1
python manage.py seed || exit /b 1

echo.
echo ติดตั้งเสร็จแล้ว! ใช้งานด้วยคำสั่ง run.bat
echo เว็บไซต์:  http://127.0.0.1:8000/
echo แอดมิน:    http://127.0.0.1:8000/admin/   (admin / admin1234 — เปลี่ยนรหัสผ่านด้วย)

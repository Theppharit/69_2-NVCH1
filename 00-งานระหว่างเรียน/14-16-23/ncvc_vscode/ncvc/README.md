# เว็บไซต์ วิทยาลัยอาชีวศึกษานครราชสีมา (Django + Tailwind CSS + SQLite3)

## ติดตั้งและรัน (Windows / macOS / Linux)
    python -m venv venv
    venv\Scripts\activate          # macOS/Linux: source venv/bin/activate
    pip install -r requirements.txt
    python manage.py makemigrations core
    python manage.py migrate
    python manage.py seed          # (ไม่บังคับ) ข้อมูลตัวอย่าง
    python manage.py createsuperuser
    python manage.py runserver

เว็บไซต์: http://127.0.0.1:8000/   ระบบแอดมิน: http://127.0.0.1:8000/admin/

## Tailwind CSS
ตอนนี้ใช้ Tailwind ผ่าน CDN (ใช้งานได้ทันทีตอนพัฒนา) ถ้าจะใช้งานจริงให้ compile เป็นไฟล์ CSS:
    npm init -y && npm i -D tailwindcss@3
    npx tailwindcss init
    # ตั้ง content: ["./core/templates/**/*.html"] ใน tailwind.config.js
    npx tailwindcss -i ./src.css -o ./core/static/core/out.css --watch
(src.css ใส่ @tailwind base; @tailwind components; @tailwind utilities;)
จากนั้นแทนที่ <script src="cdn.tailwindcss.com"> ใน base.html ด้วย <link> ไปยัง out.css

## เปิดด้วย VS Code
1. แตก zip แล้วเปิดโฟลเดอร์ด้วย File > Open Folder (หรือดับเบิลคลิก ncvc.code-workspace)
2. กด Install เมื่อ VS Code ถามให้ติดตั้ง extension ที่แนะนำ
3. เปิด Terminal (Ctrl+`) แล้วรัน: python -m venv venv และ pip install -r requirements.txt
4. กด Ctrl+Shift+P > Tasks: Run Task > รัน 1), 2), 3) ตามลำดับ
5. กด F5 เพื่อรันเซิร์ฟเวอร์ (Django: runserver) แล้วเปิด http://127.0.0.1:8000/
ดูหน้าพรีวิวแบบสถิตได้ที่ preview/index.html (คลิกขวา > Open with Live Server)

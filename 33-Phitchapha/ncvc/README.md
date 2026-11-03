# เว็บไซต์ วิทยาลัยอาชีวศึกษานครราชสีมา (Django + Tailwind)

## ติดตั้ง (Windows: python / macOS-Linux: python3)
python -m venv venv
venv\Scripts\activate        # macOS/Linux: source venv/bin/activate
pip install -r requirements.txt
python manage.py makemigrations core
python manage.py migrate
python manage.py createsuperuser
python manage.py seed_demo   # ข้อมูลตัวอย่าง (ไม่บังคับ)
python manage.py runserver

- หน้าเว็บ: http://127.0.0.1:8000/   แอดมิน: http://127.0.0.1:8000/admin/
- ข้อมูลทั้งหมดเก็บใน db.sqlite3

## Tailwind
ตอนนี้ใช้ Play CDN (เหมาะตอนพัฒนา). ก่อนขึ้นเว็บจริงให้ build ด้วย Tailwind CLI:
npm init -y && npm i -D tailwindcss@3
npx tailwindcss init   # ตั้ง content: ["./templates/**/*.html"]
npx tailwindcss -i ./static/src.css -o ./static/out.css --watch
แล้วแทน <script src="cdn.tailwindcss.com"> ใน base.html ด้วย <link href="{% static 'out.css' %}">

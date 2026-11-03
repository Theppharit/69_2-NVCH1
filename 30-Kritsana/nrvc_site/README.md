# เว็บไซต์ วิทยาลัยอาชีวศึกษานครราชสีมา (Django + Tailwind CSS + SQLite3)

python -m venv venv && source venv/bin/activate   # Windows: venv\Scripts\activate
pip install -r requirements.txt
python manage.py makemigrations core
python manage.py migrate
python manage.py seed              # ข้อมูลตัวอย่าง (ไม่จำเป็น)
python manage.py createsuperuser
python manage.py runserver

เว็บ: http://127.0.0.1:8000/   แอดมิน: http://127.0.0.1:8000/admin/

Tailwind: ตอนนี้ใช้ CDN (USE_TAILWIND_CDN=True ใน config/settings.py) เปิดใช้ได้ทันที
ขึ้นใช้งานจริง: npm install && npm run build แล้วตั้ง USE_TAILWIND_CDN=False

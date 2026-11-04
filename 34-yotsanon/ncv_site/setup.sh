#!/usr/bin/env bash
# ติดตั้งสำหรับ macOS / Linux
set -e
command -v python3 >/dev/null || { echo "ไม่พบ python3"; exit 1; }
command -v npm >/dev/null || { echo "ไม่พบ Node.js/npm"; exit 1; }

python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt

npm install
npm run build

python manage.py makemigrations core
python manage.py migrate
python manage.py seed

echo
echo "ติดตั้งเสร็จแล้ว! เริ่มใช้งานด้วย:"
echo "  source venv/bin/activate && (npm run watch &) && python manage.py runserver"
echo "แอดมิน: http://127.0.0.1:8000/admin/  (admin / admin1234 — เปลี่ยนรหัสผ่านด้วย)"

from django.core.management.base import BaseCommand
from core.models import (Announcement, Banner, Department, MenuItem, News,
                         NewsCategory, Page, QuickLink, SiteSetting)


class Command(BaseCommand):
    help = "ใส่ข้อมูลตัวอย่าง (รันซ้ำได้ ไม่ซ้ำซ้อน)"

    def handle(self, *a, **kw):
        s = SiteSetting.load()
        s.tagline = s.tagline or "เรียนจริง ทำจริง มีงานทำ"
        s.phone = s.phone or "044-000-000"
        s.email = s.email or "info@example.ac.th"
        s.address = s.address or "จังหวัดนครราชสีมา"
        s.footer_text = s.footer_text or "สงวนลิขสิทธิ์ วิทยาลัยอาชีวศึกษานครราชสีมา"
        s.save()

        about = MenuItem.objects.get_or_create(title="เกี่ยวกับวิทยาลัย", defaults={"order": 1, "url": "/p/about/"})[0]
        for i, (t, u) in enumerate([("ประวัติวิทยาลัย", "/p/about/"), ("ติดต่อเรา", "/p/contact/")]):
            MenuItem.objects.get_or_create(title=t, parent=about, defaults={"url": u, "order": i})
        MenuItem.objects.get_or_create(title="หลักสูตร / แผนกวิชา", defaults={"order": 2, "url": "/departments/"})
        MenuItem.objects.get_or_create(title="ข่าวสาร", defaults={"order": 3, "url": "/news/"})
        MenuItem.objects.get_or_create(title="รับสมัครนักเรียน", defaults={"order": 4, "url": "/p/admission/"})

        for i, (t, sub) in enumerate([("เปิดรับสมัครนักเรียน นักศึกษาใหม่", "ปวช. ปวส. และหลักสูตรระยะสั้น"),
                                     ("เรียนรู้จากงานจริงในโรงฝึกงาน", "ครูผู้สอนและสถานประกอบการร่วมพัฒนาผู้เรียน")]):
            Banner.objects.get_or_create(title=t, defaults={"subtitle": sub, "order": i})

        for i, (ic, t, u) in enumerate([("📝", "สมัครเรียน", "/p/admission/"), ("📚", "แผนกวิชา", "/departments/"),
                                        ("📰", "ข่าวสาร", "/news/"), ("📞", "ติดต่อเรา", "/p/contact/")]):
            QuickLink.objects.get_or_create(title=t, defaults={"icon": ic, "url": u, "order": i})

        cat = NewsCategory.objects.get_or_create(name="ข่าวประชาสัมพันธ์")[0]
        for t in ["ต้อนรับนักเรียนใหม่ ปีการศึกษาใหม่", "นักศึกษาคว้ารางวัลการแข่งขันทักษะวิชาชีพ", "ขอเชิญร่วมงานวันไหว้ครู"]:
            News.objects.get_or_create(title=t, defaults={"category": cat, "summary": "ข้อความตัวอย่าง แก้ไขได้ที่หน้าแอดมิน",
                                                           "body": "<p>เนื้อหาตัวอย่าง สามารถแก้ไขหรือเพิ่มข่าวได้ที่ /admin/</p>"})
        for t in ["ประกาศรายชื่อผู้มีสิทธิ์เข้าศึกษาต่อ", "ปฏิทินการศึกษาภาคเรียนนี้"]:
            Announcement.objects.get_or_create(title=t)
        for i, t in enumerate(["ช่างยนต์", "ช่างไฟฟ้ากำลัง", "อิเล็กทรอนิกส์", "การบัญชี", "คอมพิวเตอร์ธุรกิจ", "การตลาด"]):
            Department.objects.get_or_create(name=t, defaults={"order": i, "description": "รายละเอียดแผนก แก้ไขได้ที่หน้าแอดมิน"})
        for slug, title in [("about", "ประวัติวิทยาลัย"), ("contact", "ติดต่อเรา"), ("admission", "รับสมัครนักเรียน")]:
            Page.objects.get_or_create(slug=slug, defaults={"title": title, "body": f"<p>เนื้อหาหน้า{title} แก้ไขได้ที่ /admin/</p>"})
        self.stdout.write(self.style.SUCCESS("ใส่ข้อมูลตัวอย่างเรียบร้อย"))

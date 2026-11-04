import datetime
from django.core.management.base import BaseCommand
from core.models import *
class Command(BaseCommand):
    help = "สร้างข้อมูลตัวอย่าง"
    def handle(self, *a, **k):
        SiteSetting.objects.get_or_create(pk=1, defaults=dict(address="นครราชสีมา", phone="044-000-000",
            about="สถาบันการอาชีวศึกษาที่มุ่งผลิตกำลังคนที่มีคุณภาพ ทักษะเยี่ยม คุณธรรมนำ"))
        for i,(t,u) in enumerate([("หน้าแรก","/"),("ข่าวสาร","/news/"),("แผนกวิชา","/#departments"),("ติดต่อเรา","/#contact")]):
            MenuItem.objects.get_or_create(title=t, defaults=dict(url=u, order=i))
        for i,(t,e) in enumerate([("รับสมัครนักเรียน","📝"),("ปฏิทินการศึกษา","📅"),("ระบบงานทะเบียน","🗂️"),("ติดต่อสอบถาม","☎️")]):
            QuickLink.objects.get_or_create(title=t, defaults=dict(url="#", icon=e, order=i))
        for i,(t,e) in enumerate([("ช่างยนต์","🚗"),("ช่างไฟฟ้ากำลัง","⚡"),("อิเล็กทรอนิกส์","🔌"),("เทคโนโลยีสารสนเทศ","💻"),("การบัญชี","📊"),("การโรงแรม","🏨")]):
            Department.objects.get_or_create(name=t, defaults=dict(icon=e, order=i, description="หลักสูตร ปวช./ปวส."))
        for i in range(1,7):
            News.objects.get_or_create(title=f"ข่าวตัวอย่างที่ {i}", defaults=dict(summary="ตัวอย่างเนื้อหาย่อของข่าว",
                content="เนื้อหาข่าวตัวอย่าง แก้ไขได้ที่ /admin", published=datetime.date.today()-datetime.timedelta(days=i), featured=(i==1)))
        self.stdout.write("seed เสร็จแล้ว")

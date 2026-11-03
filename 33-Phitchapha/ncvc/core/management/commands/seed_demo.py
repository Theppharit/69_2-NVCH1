from django.core.management.base import BaseCommand
from django.utils import timezone
from core.models import *
class Command(BaseCommand):
    def handle(self, *a, **k):
        SiteSetting.objects.get_or_create(pk=1, defaults=dict(address="นครราชสีมา", phone="044-000-000", footer_text="© วิทยาลัยอาชีวศึกษานครราชสีมา"))
        c,_ = NewsCategory.objects.get_or_create(name="ข่าวประชาสัมพันธ์")
        for i in range(1,7): News.objects.get_or_create(title=f"ข่าวตัวอย่าง {i}", defaults=dict(category=c, summary="รายละเอียดข่าวโดยย่อ", body="<p>เนื้อหาข่าวตัวอย่าง</p>", published=timezone.now()))
        for i,(t,ic) in enumerate([("รับสมัครนักศึกษา","📝"),("ปฏิทินการศึกษา","📅"),("ระบบ e-Learning","💻"),("ติดต่อเรา","☎️")]): QuickLink.objects.get_or_create(title=t, defaults=dict(icon=ic,url="#",order=i))
        for i,t in enumerate(["ช่างยนต์","ช่างไฟฟ้ากำลัง","อิเล็กทรอนิกส์","การบัญชี","เทคโนโลยีสารสนเทศ","การตลาด"]): Department.objects.get_or_create(name=t, defaults=dict(order=i, description="รายละเอียดแผนกวิชา"))
        Page.objects.get_or_create(slug="about", defaults=dict(title="เกี่ยวกับวิทยาลัย", body="<p>ประวัติและข้อมูลวิทยาลัย</p>"))
        self.stdout.write("seed เรียบร้อย")

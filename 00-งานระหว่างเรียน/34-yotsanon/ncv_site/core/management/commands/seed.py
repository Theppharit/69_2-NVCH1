from datetime import timedelta

from django.contrib.auth import get_user_model
from django.core.management.base import BaseCommand
from django.utils import timezone

from core.models import (
    Announcement, Banner, Department, MenuItem, News, NewsCategory, Page,
    QuickLink, SiteSetting, Stat,
)


class Command(BaseCommand):
    help = 'ใส่ข้อมูลตัวอย่างลงฐานข้อมูล (แก้ไขทั้งหมดได้ในหน้าแอดมิน)'

    def add_arguments(self, parser):
        parser.add_argument('--force', action='store_true', help='ลบข้อมูลเดิมแล้วใส่ใหม่')

    def handle(self, *args, **opts):
        if opts['force']:
            for m in (MenuItem, Banner, QuickLink, Announcement, News, NewsCategory,
                      Department, Page, Stat):
                m.objects.all().delete()
        elif News.objects.exists() or MenuItem.objects.exists():
            self.stdout.write('มีข้อมูลอยู่แล้ว ข้ามการ seed (ใช้ --force เพื่อใส่ใหม่)')
            self._ensure_admin()
            return

        s = SiteSetting.load()
        s.name_th = 'วิทยาลัยอาชีวศึกษานครราชสีมา'
        s.name_en = 'Nakhon Ratchasima Vocational College'
        s.tagline = 'สร้างคนดี มีฝีมือ พร้อมสู่โลกอาชีพ'
        s.about_text = ('ข้อความตัวอย่าง: แนะนำวิทยาลัยโดยสังเขป พันธกิจด้านการจัดการอาชีวศึกษา '
                        'การพัฒนาทักษะวิชาชีพ และความร่วมมือกับสถานประกอบการ '
                        'แก้ไขข้อความนี้ได้ที่ ระบบแอดมิน > ตั้งค่าเว็บไซต์')
        s.address = 'ที่อยู่ตัวอย่าง อำเภอเมือง จังหวัดนครราชสีมา (แก้ไขในหน้าแอดมิน)'
        s.phone = '044-000-000 (ตัวอย่าง)'
        s.email = 'info@example.ac.th'
        s.footer_text = 'สงวนลิขสิทธิ์ © วิทยาลัยอาชีวศึกษานครราชสีมา'
        s.save()

        # เมนู
        about = MenuItem.objects.create(title='เกี่ยวกับวิทยาลัย', url='#', order=1)
        for i, (t, u) in enumerate([('ประวัติวิทยาลัย', '/page/history/'),
                                    ('วิสัยทัศน์และพันธกิจ', '/page/vision/')], 1):
            MenuItem.objects.create(title=t, url=u, parent=about, order=i)
        MenuItem.objects.create(title='แผนกวิชา', url='/departments/', order=2)
        MenuItem.objects.create(title='ข่าวประชาสัมพันธ์', url='/news/', order=3)
        MenuItem.objects.create(title='ติดต่อเรา', url='/contact/', order=4)

        # แบนเนอร์ (ยังไม่มีรูป จะแสดงพื้นหลังไล่สี — อัปโหลดรูปได้ในแอดมิน)
        Banner.objects.create(title='ยินดีต้อนรับสู่ วิทยาลัยอาชีวศึกษานครราชสีมา',
                              subtitle='เรียนรู้ ฝึกทักษะ สร้างอาชีพ', link='/departments/', order=1)
        Banner.objects.create(title='เปิดรับสมัครนักเรียน นักศึกษาใหม่',
                              subtitle='ข้อความตัวอย่าง — แก้ไขได้ในแอดมิน', link='/news/', order=2)
        Banner.objects.create(title='ร่วมมือกับสถานประกอบการ ทวิภาคี',
                              subtitle='เรียนจริง ปฏิบัติจริง ในสถานประกอบการ', link='/page/vision/', order=3)

        for i, (ic, t, u) in enumerate([
            ('📝', 'สมัครเรียน', '/contact/'), ('🏫', 'แผนกวิชา', '/departments/'),
            ('📰', 'ข่าวสาร', '/news/'), ('📅', 'ปฏิทินการศึกษา', '#'),
            ('🎓', 'ระบบทะเบียน', '#'), ('☎️', 'ติดต่อเรา', '/contact/'),
        ], 1):
            QuickLink.objects.create(icon=ic, title=t, url=u, order=i)

        today = timezone.localdate()
        Announcement.objects.create(title='ประกาศตัวอย่าง: กำหนดการปฐมนิเทศนักเรียนใหม่', date=today)
        Announcement.objects.create(title='ประกาศตัวอย่าง: ตารางสอบกลางภาค', date=today - timedelta(days=2))

        cats = {n: NewsCategory.objects.create(name=n, slug=sl) for n, sl in
                [('ประชาสัมพันธ์', 'pr'), ('กิจกรรม', 'activity'), ('รับสมัคร', 'admission')]}
        samples = [
            ('ตัวอย่างข่าว: เปิดรับสมัครนักเรียน นักศึกษา ปีการศึกษาใหม่', 'sample-admission', 'รับสมัคร', True),
            ('ตัวอย่างข่าว: กิจกรรมวันไหว้ครูของวิทยาลัย', 'sample-teachers-day', 'กิจกรรม', False),
            ('ตัวอย่างข่าว: นักศึกษาร่วมแข่งขันทักษะวิชาชีพ', 'sample-skill-contest', 'กิจกรรม', False),
            ('ตัวอย่างข่าว: ประกาศผลการสอบ', 'sample-exam-result', 'ประชาสัมพันธ์', False),
            ('ตัวอย่างข่าว: ความร่วมมือกับสถานประกอบการ', 'sample-cooperation', 'ประชาสัมพันธ์', False),
            ('ตัวอย่างข่าว: ปรับปรุงห้องปฏิบัติการ', 'sample-lab', 'ประชาสัมพันธ์', False),
        ]
        for i, (t, sl, c, feat) in enumerate(samples):
            News.objects.create(
                title=t, slug=sl, category=cats[c], is_featured=feat,
                published_at=today - timedelta(days=i * 3),
                summary='เนื้อหาข่าวตัวอย่างสำหรับทดสอบระบบ แก้ไขหรือลบได้ในหน้าแอดมิน',
                content='<p>นี่คือเนื้อหาข่าวตัวอย่าง คุณสามารถแก้ไข เพิ่ม หรือลบข่าวนี้ได้ที่ '
                        '<strong>ระบบแอดมิน &gt; ข่าวประชาสัมพันธ์</strong></p>'
                        '<h2>หัวข้อย่อย</h2><p>ช่องเนื้อหารองรับแท็ก HTML เช่น หัวข้อ ลิสต์ รูปภาพ และลิงก์</p>')

        for i, (n, sl, ic) in enumerate([
            ('ช่างยนต์', 'automotive', '🚗'), ('ช่างไฟฟ้ากำลัง', 'electrical', '⚡'),
            ('ช่างอิเล็กทรอนิกส์', 'electronics', '📟'), ('ช่างกลโรงงาน', 'machinery', '⚙️'),
            ('การบัญชี', 'accounting', '📊'), ('การตลาด', 'marketing', '🛒'),
            ('เทคโนโลยีสารสนเทศ', 'it', '💻'), ('การโรงแรม', 'hotel', '🏨'),
        ], 1):
            Department.objects.create(
                name=n, slug=sl, icon=ic, order=i,
                summary='ข้อความตัวอย่าง: แนะนำแผนกวิชาโดยสังเขป',
                content=f'<p>รายละเอียดแผนกวิชา{n} (ข้อความตัวอย่าง) แก้ไขได้ที่ ระบบแอดมิน &gt; แผนกวิชา</p>')

        Page.objects.create(title='ประวัติวิทยาลัย', slug='history',
                            content='<p>ข้อความตัวอย่าง: ใส่ประวัติความเป็นมาของวิทยาลัยที่นี่ (แก้ไขในแอดมิน)</p>')
        Page.objects.create(title='วิสัยทัศน์และพันธกิจ', slug='vision',
                            content='<h2>วิสัยทัศน์</h2><p>ข้อความตัวอย่าง</p><h2>พันธกิจ</h2><ul><li>ข้อความตัวอย่าง 1</li><li>ข้อความตัวอย่าง 2</li></ul>')

        for i, (lab, val) in enumerate([('นักเรียน นักศึกษา', '0,000+'), ('แผนกวิชา', '8'),
                                        ('ครูและบุคลากร', '000+'), ('สถานประกอบการร่วมมือ', '00+')], 1):
            Stat.objects.create(label=lab, value=val, order=i)

        self.stdout.write(self.style.SUCCESS('ใส่ข้อมูลตัวอย่างเรียบร้อย (ตัวเลขและข้อความทั้งหมดเป็นตัวอย่าง)'))
        self._ensure_admin()

    def _ensure_admin(self):
        User = get_user_model()
        if not User.objects.filter(is_superuser=True).exists():
            User.objects.create_superuser('admin', 'admin@example.com', 'admin1234')
            self.stdout.write(self.style.WARNING(
                'สร้างผู้ดูแลเริ่มต้น: admin / admin1234 — กรุณาเปลี่ยนรหัสผ่านทันที'))

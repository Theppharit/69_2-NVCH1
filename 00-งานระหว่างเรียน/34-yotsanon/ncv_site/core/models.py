from django.db import models
from django.urls import reverse
from django.utils import timezone


class SiteSetting(models.Model):
    """ตั้งค่าทั่วไปของเว็บไซต์ (มีเรคอร์ดเดียว)"""
    name_th = models.CharField('ชื่อสถานศึกษา (ไทย)', max_length=200, default='วิทยาลัยอาชีวศึกษานครราชสีมา')
    name_en = models.CharField('ชื่อสถานศึกษา (อังกฤษ)', max_length=200, blank=True, default='Nakhon Ratchasima Vocational College')
    tagline = models.CharField('คำขวัญ/สโลแกน', max_length=200, blank=True)
    logo = models.ImageField('โลโก้', upload_to='site/', blank=True)
    about_text = models.TextField('ข้อความแนะนำ (หน้าแรก)', blank=True)
    address = models.TextField('ที่อยู่', blank=True)
    phone = models.CharField('โทรศัพท์', max_length=100, blank=True)
    email = models.EmailField('อีเมล', blank=True)
    facebook_url = models.URLField('Facebook', blank=True)
    youtube_url = models.URLField('YouTube', blank=True)
    map_embed_url = models.URLField('ลิงก์ฝังแผนที่ (Google Maps embed)', blank=True, max_length=600)
    footer_text = models.CharField('ข้อความท้ายเว็บ', max_length=300, blank=True)

    class Meta:
        verbose_name = 'ตั้งค่าเว็บไซต์'
        verbose_name_plural = 'ตั้งค่าเว็บไซต์'

    def save(self, *args, **kwargs):
        self.pk = 1
        super().save(*args, **kwargs)

    @classmethod
    def load(cls):
        obj, _ = cls.objects.get_or_create(pk=1)
        return obj

    def __str__(self):
        return self.name_th


class MenuItem(models.Model):
    title = models.CharField('ชื่อเมนู', max_length=100)
    url = models.CharField('ลิงก์', max_length=300, default='#', help_text='เช่น /news/ หรือ https://example.com')
    parent = models.ForeignKey(
        'self', verbose_name='เมนูหลัก', null=True, blank=True,
        on_delete=models.CASCADE, related_name='children',
        limit_choices_to={'parent__isnull': True},
        help_text='เว้นว่างถ้าเป็นเมนูระดับบนสุด',
    )
    order = models.PositiveIntegerField('ลำดับ', default=0)
    is_active = models.BooleanField('แสดงผล', default=True)
    new_tab = models.BooleanField('เปิดในแท็บใหม่', default=False)

    class Meta:
        verbose_name = 'เมนู'
        verbose_name_plural = 'เมนูนำทาง'
        ordering = ['order', 'id']

    def __str__(self):
        return f'{self.parent.title} › {self.title}' if self.parent else self.title


class Banner(models.Model):
    title = models.CharField('หัวข้อ', max_length=200)
    subtitle = models.CharField('ข้อความรอง', max_length=300, blank=True)
    image = models.ImageField('รูปแบนเนอร์ (แนะนำ 1600×600)', upload_to='banners/', blank=True)
    link = models.CharField('ลิงก์', max_length=300, blank=True)
    order = models.PositiveIntegerField('ลำดับ', default=0)
    is_active = models.BooleanField('แสดงผล', default=True)

    class Meta:
        verbose_name = 'แบนเนอร์สไลด์'
        verbose_name_plural = 'แบนเนอร์สไลด์หน้าแรก'
        ordering = ['order', 'id']

    def __str__(self):
        return self.title


class QuickLink(models.Model):
    title = models.CharField('ชื่อ', max_length=100)
    icon = models.CharField('ไอคอน (อีโมจิ)', max_length=10, default='🎓')
    url = models.CharField('ลิงก์', max_length=300, default='#')
    order = models.PositiveIntegerField('ลำดับ', default=0)
    is_active = models.BooleanField('แสดงผล', default=True)

    class Meta:
        verbose_name = 'ลิงก์ด่วน'
        verbose_name_plural = 'ลิงก์ด่วนหน้าแรก'
        ordering = ['order', 'id']

    def __str__(self):
        return self.title


class Announcement(models.Model):
    title = models.CharField('ข้อความประกาศ', max_length=250)
    url = models.CharField('ลิงก์ (ถ้ามี)', max_length=300, blank=True)
    date = models.DateField('วันที่', default=timezone.localdate)
    is_active = models.BooleanField('แสดงผล', default=True)

    class Meta:
        verbose_name = 'ประกาศ'
        verbose_name_plural = 'ประกาศ (แถบด้านบน)'
        ordering = ['-date', '-id']

    def __str__(self):
        return self.title


class NewsCategory(models.Model):
    name = models.CharField('ชื่อหมวด', max_length=100)
    slug = models.SlugField('slug', allow_unicode=True, unique=True)

    class Meta:
        verbose_name = 'หมวดข่าว'
        verbose_name_plural = 'หมวดข่าว'
        ordering = ['name']

    def __str__(self):
        return self.name


class News(models.Model):
    title = models.CharField('หัวข้อข่าว', max_length=250)
    slug = models.SlugField('slug (ใช้ใน URL)', allow_unicode=True, unique=True, max_length=250)
    category = models.ForeignKey(NewsCategory, verbose_name='หมวดข่าว', null=True, blank=True,
                                 on_delete=models.SET_NULL, related_name='news')
    summary = models.CharField('สรุปสั้น', max_length=300, blank=True)
    content = models.TextField('เนื้อหา (ใส่ HTML ได้)')
    cover = models.ImageField('รูปปก', upload_to='news/', blank=True)
    published_at = models.DateField('วันที่เผยแพร่', default=timezone.localdate)
    is_featured = models.BooleanField('ข่าวเด่น', default=False)
    is_published = models.BooleanField('เผยแพร่', default=True)

    class Meta:
        verbose_name = 'ข่าว'
        verbose_name_plural = 'ข่าวประชาสัมพันธ์'
        ordering = ['-published_at', '-id']

    def get_absolute_url(self):
        return reverse('news_detail', args=[self.slug])

    def __str__(self):
        return self.title


class Department(models.Model):
    name = models.CharField('ชื่อแผนกวิชา', max_length=150)
    slug = models.SlugField('slug', allow_unicode=True, unique=True)
    icon = models.CharField('ไอคอน (อีโมจิ)', max_length=10, default='🛠️')
    summary = models.CharField('สรุปสั้น', max_length=300, blank=True)
    content = models.TextField('รายละเอียด (ใส่ HTML ได้)', blank=True)
    image = models.ImageField('รูปภาพ', upload_to='departments/', blank=True)
    order = models.PositiveIntegerField('ลำดับ', default=0)
    is_active = models.BooleanField('แสดงผล', default=True)

    class Meta:
        verbose_name = 'แผนกวิชา'
        verbose_name_plural = 'แผนกวิชา'
        ordering = ['order', 'id']

    def get_absolute_url(self):
        return reverse('department_detail', args=[self.slug])

    def __str__(self):
        return self.name


class Page(models.Model):
    """หน้าเนื้อหาทั่วไป เช่น ประวัติวิทยาลัย วิสัยทัศน์ พันธกิจ"""
    title = models.CharField('ชื่อหน้า', max_length=200)
    slug = models.SlugField('slug', allow_unicode=True, unique=True)
    content = models.TextField('เนื้อหา (ใส่ HTML ได้)')
    is_published = models.BooleanField('เผยแพร่', default=True)

    class Meta:
        verbose_name = 'หน้าเนื้อหา'
        verbose_name_plural = 'หน้าเนื้อหาทั่วไป'
        ordering = ['title']

    def get_absolute_url(self):
        return reverse('page_detail', args=[self.slug])

    def __str__(self):
        return self.title


class Stat(models.Model):
    label = models.CharField('ป้ายกำกับ', max_length=100)
    value = models.CharField('ตัวเลข/ค่า', max_length=50)
    order = models.PositiveIntegerField('ลำดับ', default=0)
    is_active = models.BooleanField('แสดงผล', default=True)

    class Meta:
        verbose_name = 'ตัวเลขสถิติ'
        verbose_name_plural = 'ตัวเลขสถิติ (แถบสีน้ำเงิน)'
        ordering = ['order', 'id']

    def __str__(self):
        return f'{self.label}: {self.value}'


class ContactMessage(models.Model):
    name = models.CharField('ชื่อ', max_length=150)
    email = models.EmailField('อีเมล')
    phone = models.CharField('เบอร์โทร', max_length=50, blank=True)
    subject = models.CharField('หัวข้อ', max_length=200)
    message = models.TextField('ข้อความ')
    created_at = models.DateTimeField('ส่งเมื่อ', auto_now_add=True)
    is_read = models.BooleanField('อ่านแล้ว', default=False)

    class Meta:
        verbose_name = 'ข้อความติดต่อ'
        verbose_name_plural = 'ข้อความติดต่อจากผู้เยี่ยมชม'
        ordering = ['-created_at']

    def __str__(self):
        return f'{self.subject} — {self.name}'

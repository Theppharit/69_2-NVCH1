from django.db import models
from django.urls import reverse
from django.utils import timezone


class SiteSetting(models.Model):
    name_th = models.CharField("ชื่อสถานศึกษา (ไทย)", max_length=200, default="วิทยาลัยอาชีวศึกษานครราชสีมา")
    name_en = models.CharField("ชื่อสถานศึกษา (อังกฤษ)", max_length=200, blank=True, default="Nakhon Ratchasima Vocational College")
    tagline = models.CharField("คำขวัญ", max_length=200, blank=True)
    logo = models.ImageField("โลโก้", upload_to="site/", blank=True)
    phone = models.CharField("โทรศัพท์", max_length=100, blank=True)
    email = models.EmailField("อีเมล", blank=True)
    address = models.TextField("ที่อยู่", blank=True)
    facebook = models.URLField("Facebook", blank=True)
    footer_text = models.CharField("ข้อความท้ายเว็บ", max_length=255, blank=True)

    class Meta:
        verbose_name = verbose_name_plural = "ตั้งค่าเว็บไซต์"

    def __str__(self):
        return self.name_th

    def save(self, *a, **kw):
        self.pk = 1
        super().save(*a, **kw)

    @classmethod
    def load(cls):
        return cls.objects.get_or_create(pk=1)[0]


class Banner(models.Model):
    title = models.CharField("หัวข้อ", max_length=200)
    subtitle = models.CharField("คำอธิบายสั้น", max_length=300, blank=True)
    image = models.ImageField("รูปแบนเนอร์", upload_to="banners/", blank=True)
    link = models.CharField("ลิงก์", max_length=300, blank=True)
    order = models.PositiveIntegerField("ลำดับ", default=0)
    active = models.BooleanField("แสดง", default=True)

    class Meta:
        ordering = ["order", "id"]
        verbose_name = verbose_name_plural = "แบนเนอร์หน้าแรก"

    def __str__(self):
        return self.title


class MenuItem(models.Model):
    title = models.CharField("ชื่อเมนู", max_length=100)
    url = models.CharField("ลิงก์ (เช่น /news/ หรือ https://...)", max_length=300, blank=True)
    parent = models.ForeignKey("self", null=True, blank=True, on_delete=models.CASCADE,
                               related_name="children", verbose_name="เมนูหลัก")
    order = models.PositiveIntegerField("ลำดับ", default=0)
    active = models.BooleanField("แสดง", default=True)

    class Meta:
        ordering = ["order", "id"]
        verbose_name = verbose_name_plural = "เมนูนำทาง"

    def __str__(self):
        return f"{self.parent} › {self.title}" if self.parent else self.title

    def active_children(self):
        return self.children.filter(active=True)


class QuickLink(models.Model):
    title = models.CharField("ชื่อ", max_length=100)
    icon = models.CharField("ไอคอน (อีโมจิหรืออักษร)", max_length=8, blank=True)
    url = models.CharField("ลิงก์", max_length=300)
    order = models.PositiveIntegerField("ลำดับ", default=0)

    class Meta:
        ordering = ["order", "id"]
        verbose_name = verbose_name_plural = "ลิงก์ด่วน"

    def __str__(self):
        return self.title


class NewsCategory(models.Model):
    name = models.CharField("ชื่อหมวด", max_length=100)

    class Meta:
        verbose_name = verbose_name_plural = "หมวดข่าว"

    def __str__(self):
        return self.name


class News(models.Model):
    title = models.CharField("หัวข้อข่าว", max_length=250)
    category = models.ForeignKey(NewsCategory, null=True, blank=True, on_delete=models.SET_NULL, verbose_name="หมวด")
    summary = models.CharField("เนื้อหาย่อ", max_length=300, blank=True)
    image = models.ImageField("รูปปก", upload_to="news/", blank=True)
    body = models.TextField("เนื้อหา (ใส่ HTML ได้)")
    published_at = models.DateTimeField("วันที่เผยแพร่", default=timezone.now)
    is_published = models.BooleanField("เผยแพร่", default=True)

    class Meta:
        ordering = ["-published_at"]
        verbose_name = verbose_name_plural = "ข่าวสาร"

    def __str__(self):
        return self.title

    def get_absolute_url(self):
        return reverse("news_detail", args=[self.pk])


class Announcement(models.Model):
    title = models.CharField("หัวข้อประกาศ", max_length=250)
    url = models.CharField("ลิงก์ (ไฟล์/หน้าเว็บ)", max_length=300, blank=True)
    date = models.DateField("วันที่", default=timezone.localdate)
    active = models.BooleanField("แสดง", default=True)

    class Meta:
        ordering = ["-date", "-id"]
        verbose_name = verbose_name_plural = "ประกาศ"

    def __str__(self):
        return self.title


class Department(models.Model):
    name = models.CharField("ชื่อแผนกวิชา", max_length=150)
    description = models.TextField("รายละเอียด", blank=True)
    image = models.ImageField("รูปภาพ", upload_to="departments/", blank=True)
    order = models.PositiveIntegerField("ลำดับ", default=0)

    class Meta:
        ordering = ["order", "id"]
        verbose_name = verbose_name_plural = "แผนกวิชา"

    def __str__(self):
        return self.name


class Page(models.Model):
    slug = models.CharField("ชื่อในลิงก์ (ภาษาอังกฤษ เช่น about)", max_length=100, unique=True)
    title = models.CharField("หัวข้อหน้า", max_length=200)
    body = models.TextField("เนื้อหา (ใส่ HTML ได้)")
    updated_at = models.DateTimeField(auto_now=True)

    class Meta:
        verbose_name = verbose_name_plural = "หน้าเนื้อหาทั่วไป"

    def __str__(self):
        return f"{self.title} (/p/{self.slug}/)"

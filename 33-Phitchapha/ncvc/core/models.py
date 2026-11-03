from django.db import models
from django.urls import reverse

class SiteSetting(models.Model):
    name_th = models.CharField("ชื่อสถานศึกษา (ไทย)", max_length=200, default="วิทยาลัยอาชีวศึกษานครราชสีมา")
    name_en = models.CharField("ชื่อ (อังกฤษ)", max_length=200, default="Nakhon Ratchasima Vocational College")
    logo = models.ImageField("โลโก้", upload_to="site/", blank=True)
    address = models.TextField("ที่อยู่", blank=True)
    phone = models.CharField("โทรศัพท์", max_length=100, blank=True)
    email = models.EmailField("อีเมล", blank=True)
    facebook = models.URLField("Facebook", blank=True)
    footer_text = models.CharField("ข้อความท้ายเว็บ", max_length=255, blank=True)
    class Meta: verbose_name = verbose_name_plural = "ตั้งค่าเว็บไซต์"
    def __str__(self): return self.name_th

class Banner(models.Model):
    title = models.CharField("หัวข้อ", max_length=200)
    subtitle = models.CharField("คำอธิบาย", max_length=255, blank=True)
    image = models.ImageField("ภาพสไลด์", upload_to="banners/")
    link = models.CharField("ลิงก์", max_length=255, blank=True)
    order = models.PositiveIntegerField("ลำดับ", default=0)
    active = models.BooleanField("แสดง", default=True)
    class Meta: ordering = ["order"]; verbose_name = verbose_name_plural = "แบนเนอร์สไลด์"
    def __str__(self): return self.title

class NewsCategory(models.Model):
    name = models.CharField("หมวดหมู่", max_length=100)
    class Meta: verbose_name = verbose_name_plural = "หมวดข่าว"
    def __str__(self): return self.name

class News(models.Model):
    title = models.CharField("หัวข้อข่าว", max_length=250)
    category = models.ForeignKey(NewsCategory, on_delete=models.SET_NULL, null=True, blank=True, verbose_name="หมวด")
    cover = models.ImageField("ภาพปก", upload_to="news/", blank=True)
    summary = models.CharField("สรุปย่อ", max_length=300, blank=True)
    body = models.TextField("เนื้อหา (HTML ได้)")
    published = models.DateTimeField("วันที่เผยแพร่")
    active = models.BooleanField("เผยแพร่", default=True)
    class Meta: ordering = ["-published"]; verbose_name = verbose_name_plural = "ข่าวสาร"
    def __str__(self): return self.title
    def get_absolute_url(self): return reverse("news_detail", args=[self.pk])

class QuickLink(models.Model):
    title = models.CharField("ชื่อ", max_length=100)
    icon = models.CharField("อีโมจิ/ไอคอน", max_length=10, default="🔗")
    url = models.CharField("ลิงก์", max_length=255)
    order = models.PositiveIntegerField("ลำดับ", default=0)
    class Meta: ordering = ["order"]; verbose_name = verbose_name_plural = "ลิงก์ด่วน"
    def __str__(self): return self.title

class Department(models.Model):
    name = models.CharField("แผนกวิชา", max_length=150)
    description = models.TextField("รายละเอียด", blank=True)
    image = models.ImageField("ภาพ", upload_to="dept/", blank=True)
    order = models.PositiveIntegerField("ลำดับ", default=0)
    class Meta: ordering = ["order"]; verbose_name = verbose_name_plural = "แผนกวิชา/หลักสูตร"
    def __str__(self): return self.name

class Page(models.Model):
    title = models.CharField("ชื่อหน้า", max_length=200)
    slug = models.SlugField("slug (URL)", unique=True, allow_unicode=True)
    body = models.TextField("เนื้อหา (HTML ได้)")
    in_menu = models.BooleanField("แสดงในเมนู", default=True)
    order = models.PositiveIntegerField("ลำดับเมนู", default=0)
    class Meta: ordering = ["order"]; verbose_name = verbose_name_plural = "หน้าเว็บทั่วไป"
    def __str__(self): return self.title

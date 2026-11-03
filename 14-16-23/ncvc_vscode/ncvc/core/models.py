from django.db import models

class SiteSetting(models.Model):
    name_th = models.CharField("ชื่อวิทยาลัย", max_length=200, default="วิทยาลัยอาชีวศึกษานครราชสีมา")
    name_en = models.CharField("ชื่ออังกฤษ", max_length=200, default="Nakhon Ratchasima Vocational College")
    logo = models.ImageField("โลโก้", upload_to="logo/", blank=True)
    address = models.TextField("ที่อยู่", blank=True)
    phone = models.CharField("โทรศัพท์", max_length=100, blank=True)
    email = models.EmailField("อีเมล", blank=True)
    facebook = models.URLField("Facebook", blank=True)
    about = models.TextField("เกี่ยวกับวิทยาลัย", blank=True)
    class Meta:
        verbose_name = verbose_name_plural = "ตั้งค่าเว็บไซต์"
    def __str__(self): return self.name_th

class Banner(models.Model):
    title = models.CharField("หัวข้อ", max_length=200)
    subtitle = models.CharField("คำอธิบาย", max_length=300, blank=True)
    image = models.ImageField("รูปแบนเนอร์", upload_to="banners/")
    link = models.CharField("ลิงก์", max_length=300, blank=True)
    order = models.PositiveIntegerField("ลำดับ", default=0)
    active = models.BooleanField("แสดง", default=True)
    class Meta:
        ordering = ["order"]; verbose_name = verbose_name_plural = "แบนเนอร์สไลด์"
    def __str__(self): return self.title

class News(models.Model):
    CATS = [("news","ข่าวประชาสัมพันธ์"),("activity","ข่าวกิจกรรม"),("admission","รับสมัครนักเรียน"),("award","รางวัล/เกียรติยศ")]
    title = models.CharField("หัวข้อข่าว", max_length=250)
    category = models.CharField("หมวด", max_length=20, choices=CATS, default="news")
    summary = models.CharField("เนื้อหาย่อ", max_length=300, blank=True)
    content = models.TextField("เนื้อหา")
    image = models.ImageField("รูปปก", upload_to="news/", blank=True)
    published = models.DateField("วันที่เผยแพร่")
    featured = models.BooleanField("ข่าวเด่น", default=False)
    active = models.BooleanField("แสดง", default=True)
    class Meta:
        ordering = ["-published","-id"]; verbose_name = verbose_name_plural = "ข่าว"
    def __str__(self): return self.title

class Department(models.Model):
    name = models.CharField("แผนกวิชา", max_length=150)
    description = models.CharField("คำอธิบาย", max_length=300, blank=True)
    icon = models.CharField("ไอคอน (emoji)", max_length=8, default="🎓")
    order = models.PositiveIntegerField("ลำดับ", default=0)
    class Meta:
        ordering = ["order"]; verbose_name = verbose_name_plural = "แผนกวิชา"
    def __str__(self): return self.name

class QuickLink(models.Model):
    title = models.CharField("ชื่อ", max_length=100)
    url = models.CharField("URL", max_length=300)
    icon = models.CharField("ไอคอน (emoji)", max_length=8, default="🔗")
    order = models.PositiveIntegerField("ลำดับ", default=0)
    class Meta:
        ordering = ["order"]; verbose_name = verbose_name_plural = "ลิงก์ด่วน"
    def __str__(self): return self.title

class MenuItem(models.Model):
    title = models.CharField("เมนู", max_length=80)
    url = models.CharField("URL", max_length=300)
    order = models.PositiveIntegerField("ลำดับ", default=0)
    class Meta:
        ordering = ["order"]; verbose_name = verbose_name_plural = "เมนูหลัก"
    def __str__(self): return self.title

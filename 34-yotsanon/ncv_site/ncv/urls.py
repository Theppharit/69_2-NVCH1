from django.conf import settings
from django.conf.urls.static import static
from django.contrib import admin
from django.urls import include, path

admin.site.site_header = 'ระบบจัดการเว็บไซต์ วิทยาลัยอาชีวศึกษานครราชสีมา'
admin.site.site_title = 'จัดการเว็บไซต์'
admin.site.index_title = 'แก้ไขเนื้อหาหน้าเว็บ'

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('core.urls')),
] + static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)

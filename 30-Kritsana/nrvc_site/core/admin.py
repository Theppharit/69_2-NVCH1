from django.contrib import admin
from .models import (Announcement, Banner, Department, MenuItem, News,
                     NewsCategory, Page, QuickLink, SiteSetting)

admin.site.site_header = "ระบบจัดการเว็บไซต์ วิทยาลัยอาชีวศึกษานครราชสีมา"
admin.site.site_title = "จัดการเว็บไซต์"
admin.site.index_title = "แก้ไขเนื้อหาหน้าเว็บ"


@admin.register(SiteSetting)
class SiteSettingAdmin(admin.ModelAdmin):
    def has_add_permission(self, request):
        return not SiteSetting.objects.exists()

    def has_delete_permission(self, request, obj=None):
        return False


@admin.register(Banner)
class BannerAdmin(admin.ModelAdmin):
    list_display = ("title", "order", "active")
    list_editable = ("order", "active")


@admin.register(MenuItem)
class MenuItemAdmin(admin.ModelAdmin):
    list_display = ("__str__", "url", "order", "active")
    list_editable = ("order", "active")


@admin.register(QuickLink)
class QuickLinkAdmin(admin.ModelAdmin):
    list_display = ("title", "url", "order")
    list_editable = ("order",)


@admin.register(News)
class NewsAdmin(admin.ModelAdmin):
    list_display = ("title", "category", "published_at", "is_published")
    list_filter = ("category", "is_published")
    search_fields = ("title", "body")
    date_hierarchy = "published_at"


@admin.register(Announcement)
class AnnouncementAdmin(admin.ModelAdmin):
    list_display = ("title", "date", "active")
    list_editable = ("active",)


@admin.register(Department)
class DepartmentAdmin(admin.ModelAdmin):
    list_display = ("name", "order")
    list_editable = ("order",)


admin.site.register(NewsCategory)
admin.site.register(Page)

from django.contrib import admin
from .models import *

@admin.register(SiteSetting)
class SiteSettingAdmin(admin.ModelAdmin):
    def has_add_permission(self, r): return not SiteSetting.objects.exists()
@admin.register(Banner)
class BannerAdmin(admin.ModelAdmin):
    list_display = ("title","order","active"); list_editable = ("order","active")
@admin.register(News)
class NewsAdmin(admin.ModelAdmin):
    list_display = ("title","category","published","active"); list_filter = ("category","active"); search_fields = ("title",)
@admin.register(QuickLink)
class QuickLinkAdmin(admin.ModelAdmin):
    list_display = ("title","url","order"); list_editable = ("order",)
@admin.register(Department)
class DepartmentAdmin(admin.ModelAdmin):
    list_display = ("name","order"); list_editable = ("order",)
@admin.register(Page)
class PageAdmin(admin.ModelAdmin):
    list_display = ("title","slug","in_menu","order"); prepopulated_fields = {"slug":("title",)}
admin.site.register(NewsCategory)

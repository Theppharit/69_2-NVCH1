from django.contrib import admin
from .models import *

@admin.register(SiteSetting)
class SiteSettingAdmin(admin.ModelAdmin):
    def has_add_permission(self, request): return not SiteSetting.objects.exists()

@admin.register(News)
class NewsAdmin(admin.ModelAdmin):
    list_display = ("title","category","published","featured","active")
    list_filter = ("category","featured","active"); search_fields = ("title","content")
    date_hierarchy = "published"

for m in (Banner, Department, QuickLink, MenuItem):
    admin.site.register(m, type(m.__name__+"Admin",(admin.ModelAdmin,),{"list_display":("__str__","order"),"list_editable":("order",)}))

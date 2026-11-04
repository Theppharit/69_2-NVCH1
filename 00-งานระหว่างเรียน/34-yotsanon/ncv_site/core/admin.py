from django.contrib import admin
from django.utils.html import format_html

from .models import (
    Announcement, Banner, ContactMessage, Department, MenuItem, News,
    NewsCategory, Page, QuickLink, SiteSetting, Stat,
)


@admin.register(SiteSetting)
class SiteSettingAdmin(admin.ModelAdmin):
    fieldsets = (
        ('ข้อมูลสถานศึกษา', {'fields': ('name_th', 'name_en', 'tagline', 'logo', 'about_text')}),
        ('ติดต่อ', {'fields': ('address', 'phone', 'email', 'map_embed_url')}),
        ('โซเชียลมีเดีย', {'fields': ('facebook_url', 'youtube_url')}),
        ('ท้ายเว็บ', {'fields': ('footer_text',)}),
    )

    def has_add_permission(self, request):
        return not SiteSetting.objects.exists()

    def has_delete_permission(self, request, obj=None):
        return False


@admin.register(MenuItem)
class MenuItemAdmin(admin.ModelAdmin):
    list_display = ('title', 'parent', 'url', 'order', 'is_active')
    list_editable = ('order', 'is_active')
    list_filter = ('parent', 'is_active')


@admin.register(Banner)
class BannerAdmin(admin.ModelAdmin):
    list_display = ('title', 'preview', 'order', 'is_active')
    list_editable = ('order', 'is_active')

    @admin.display(description='ตัวอย่าง')
    def preview(self, obj):
        if obj.image:
            return format_html('<img src="{}" style="height:50px;border-radius:4px">', obj.image.url)
        return '—'


@admin.register(QuickLink)
class QuickLinkAdmin(admin.ModelAdmin):
    list_display = ('icon', 'title', 'url', 'order', 'is_active')
    list_editable = ('order', 'is_active')


@admin.register(Announcement)
class AnnouncementAdmin(admin.ModelAdmin):
    list_display = ('title', 'date', 'is_active')
    list_editable = ('is_active',)


@admin.register(NewsCategory)
class NewsCategoryAdmin(admin.ModelAdmin):
    list_display = ('name', 'slug')
    prepopulated_fields = {'slug': ('name',)}


@admin.register(News)
class NewsAdmin(admin.ModelAdmin):
    list_display = ('title', 'category', 'published_at', 'is_featured', 'is_published')
    list_editable = ('is_featured', 'is_published')
    list_filter = ('category', 'is_featured', 'is_published')
    search_fields = ('title', 'summary', 'content')
    date_hierarchy = 'published_at'
    prepopulated_fields = {'slug': ('title',)}


@admin.register(Department)
class DepartmentAdmin(admin.ModelAdmin):
    list_display = ('icon', 'name', 'order', 'is_active')
    list_editable = ('order', 'is_active')
    prepopulated_fields = {'slug': ('name',)}


@admin.register(Page)
class PageAdmin(admin.ModelAdmin):
    list_display = ('title', 'slug', 'is_published')
    list_editable = ('is_published',)
    prepopulated_fields = {'slug': ('title',)}


@admin.register(Stat)
class StatAdmin(admin.ModelAdmin):
    list_display = ('label', 'value', 'order', 'is_active')
    list_editable = ('order', 'is_active')


@admin.register(ContactMessage)
class ContactMessageAdmin(admin.ModelAdmin):
    list_display = ('subject', 'name', 'email', 'created_at', 'is_read')
    list_editable = ('is_read',)
    list_filter = ('is_read',)
    search_fields = ('subject', 'name', 'email', 'message')
    readonly_fields = ('name', 'email', 'phone', 'subject', 'message', 'created_at')

    def has_add_permission(self, request):
        return False

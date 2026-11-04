from django.db.models import Prefetch

from .models import Announcement, MenuItem, SiteSetting


def site(request):
    kids = Prefetch('children', queryset=MenuItem.objects.filter(is_active=True), to_attr='kids')
    return {
        'site': SiteSetting.load(),
        'menu_items': MenuItem.objects.filter(is_active=True, parent__isnull=True).prefetch_related(kids),
        'announcements': Announcement.objects.filter(is_active=True)[:5],
    }

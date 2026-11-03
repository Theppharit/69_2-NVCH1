from django.conf import settings
from .models import MenuItem, SiteSetting


def site(request):
    return {
        "site": SiteSetting.load(),
        "menu": MenuItem.objects.filter(parent__isnull=True, active=True),
        "USE_CDN": settings.USE_TAILWIND_CDN,
    }

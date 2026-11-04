from .models import SiteSetting, MenuItem, QuickLink
def site(request):
    return {"site": SiteSetting.objects.first(), "menu": MenuItem.objects.all(), "quicklinks": QuickLink.objects.all()}

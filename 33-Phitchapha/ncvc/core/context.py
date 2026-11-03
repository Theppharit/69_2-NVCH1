from .models import SiteSetting, Page
def site(request):
    return {"site": SiteSetting.objects.first() or SiteSetting(), "menu_pages": Page.objects.filter(in_menu=True)}

from django.core.paginator import Paginator
from django.shortcuts import get_object_or_404, render
from django.utils import timezone
from .models import Announcement, Banner, Department, News, Page, QuickLink


def _news():
    return News.objects.filter(is_published=True, published_at__lte=timezone.now()).select_related("category")


def home(request):
    news = list(_news()[:7])
    return render(request, "home.html", {
        "banners": Banner.objects.filter(active=True),
        "quick_links": QuickLink.objects.all(),
        "top_news": news[:1],
        "news": news[1:],
        "announcements": Announcement.objects.filter(active=True)[:8],
        "departments": Department.objects.all()[:8],
    })


def news_list(request):
    qs = _news()
    q = request.GET.get("q", "").strip()
    if q:
        qs = qs.filter(title__icontains=q)
    page = Paginator(qs, 9).get_page(request.GET.get("page"))
    return render(request, "news_list.html", {"page": page, "q": q})


def news_detail(request, pk):
    return render(request, "news_detail.html", {"item": get_object_or_404(_news(), pk=pk)})


def departments(request):
    return render(request, "departments.html", {"departments": Department.objects.all()})


def page_detail(request, slug):
    return render(request, "page.html", {"page": get_object_or_404(Page, slug=slug)})

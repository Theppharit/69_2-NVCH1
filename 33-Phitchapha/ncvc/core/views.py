from django.shortcuts import render, get_object_or_404
from django.core.paginator import Paginator
from .models import *
def home(r):
    return render(r, "home.html", {"banners": Banner.objects.filter(active=True),
        "news": News.objects.filter(active=True)[:6], "links": QuickLink.objects.all(),
        "depts": Department.objects.all()})
def news_list(r):
    p = Paginator(News.objects.filter(active=True), 9).get_page(r.GET.get("page"))
    return render(r, "news_list.html", {"page": p})
def news_detail(r, pk): return render(r, "news_detail.html", {"n": get_object_or_404(News, pk=pk, active=True)})
def page(r, slug): return render(r, "page.html", {"p": get_object_or_404(Page, slug=slug)})

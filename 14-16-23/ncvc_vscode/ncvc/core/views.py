from django.shortcuts import render, get_object_or_404
from django.core.paginator import Paginator
from .models import *

def home(request):
    qs = News.objects.filter(active=True)
    return render(request, "core/home.html", {
        "banners": Banner.objects.filter(active=True),
        "featured": qs.filter(featured=True).first() or qs.first(),
        "latest": qs[:6], "departments": Department.objects.all()})

def news_list(request):
    qs = News.objects.filter(active=True)
    cat = request.GET.get("cat")
    if cat: qs = qs.filter(category=cat)
    page = Paginator(qs, 9).get_page(request.GET.get("page"))
    return render(request, "core/news_list.html", {"page": page, "cats": News.CATS, "cat": cat})

def news_detail(request, pk):
    return render(request, "core/news_detail.html", {"n": get_object_or_404(News, pk=pk, active=True)})

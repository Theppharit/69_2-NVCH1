from django.contrib import messages
from django.core.paginator import Paginator
from django.db.models import Q
from django.shortcuts import get_object_or_404, redirect, render

from .forms import ContactForm
from .models import (
    Banner, Department, News, NewsCategory, Page, QuickLink, Stat,
)


def home(request):
    published = News.objects.filter(is_published=True).select_related('category')
    featured = published.filter(is_featured=True).first() or published.first()
    latest = published.exclude(pk=featured.pk)[:5] if featured else []
    return render(request, 'home.html', {
        'banners': Banner.objects.filter(is_active=True),
        'quick_links': QuickLink.objects.filter(is_active=True),
        'featured': featured,
        'latest': latest,
        'stats': Stat.objects.filter(is_active=True),
        'departments': Department.objects.filter(is_active=True),
    })


def news_list(request):
    qs = News.objects.filter(is_published=True).select_related('category')
    q = request.GET.get('q', '').strip()
    cat_slug = request.GET.get('category', '').strip()
    category = None
    if q:
        qs = qs.filter(Q(title__icontains=q) | Q(summary__icontains=q) | Q(content__icontains=q))
    if cat_slug:
        category = NewsCategory.objects.filter(slug=cat_slug).first()
        if category:
            qs = qs.filter(category=category)
    page_obj = Paginator(qs, 9).get_page(request.GET.get('page'))
    params = request.GET.copy()
    params.pop('page', None)
    return render(request, 'news_list.html', {
        'page_obj': page_obj,
        'categories': NewsCategory.objects.all(),
        'current_category': category,
        'q': q,
        'qs': params.urlencode(),
    })


def news_detail(request, slug):
    item = get_object_or_404(News, slug=slug, is_published=True)
    related = News.objects.filter(is_published=True).exclude(pk=item.pk)[:4]
    return render(request, 'news_detail.html', {'item': item, 'related': related})


def department_list(request):
    return render(request, 'departments.html', {
        'departments': Department.objects.filter(is_active=True),
    })


def department_detail(request, slug):
    dept = get_object_or_404(Department, slug=slug, is_active=True)
    others = Department.objects.filter(is_active=True).exclude(pk=dept.pk)
    return render(request, 'department_detail.html', {'dept': dept, 'others': others})


def page_detail(request, slug):
    page = get_object_or_404(Page, slug=slug, is_published=True)
    return render(request, 'page_detail.html', {'page': page})


def contact(request):
    if request.method == 'POST':
        form = ContactForm(request.POST)
        if form.is_valid():
            form.save()
            messages.success(request, 'ส่งข้อความเรียบร้อยแล้ว ขอบคุณที่ติดต่อเรา')
            return redirect('contact')
    else:
        form = ContactForm()
    return render(request, 'contact.html', {'form': form})

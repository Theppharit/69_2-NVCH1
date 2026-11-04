from django.urls import path

from . import views

urlpatterns = [
    path('', views.home, name='home'),
    path('news/', views.news_list, name='news_list'),
    path('news/<str:slug>/', views.news_detail, name='news_detail'),
    path('departments/', views.department_list, name='department_list'),
    path('departments/<str:slug>/', views.department_detail, name='department_detail'),
    path('page/<str:slug>/', views.page_detail, name='page_detail'),
    path('contact/', views.contact, name='contact'),
]

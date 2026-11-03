from django.urls import path
from . import views

urlpatterns = [
    path("", views.home, name="home"),
    path("news/", views.news_list, name="news_list"),
    path("news/<int:pk>/", views.news_detail, name="news_detail"),
    path("departments/", views.departments, name="departments"),
    path("p/<str:slug>/", views.page_detail, name="page"),
]

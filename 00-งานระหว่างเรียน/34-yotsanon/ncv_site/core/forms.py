from django import forms

from .models import ContactMessage


class ContactForm(forms.ModelForm):
    class Meta:
        model = ContactMessage
        fields = ['name', 'email', 'phone', 'subject', 'message']
        widgets = {
            'name': forms.TextInput(attrs={'class': 'form-input', 'placeholder': 'ชื่อ-นามสกุล'}),
            'email': forms.EmailInput(attrs={'class': 'form-input', 'placeholder': 'name@example.com'}),
            'phone': forms.TextInput(attrs={'class': 'form-input', 'placeholder': 'เบอร์โทร (ไม่บังคับ)'}),
            'subject': forms.TextInput(attrs={'class': 'form-input', 'placeholder': 'หัวข้อ'}),
            'message': forms.Textarea(attrs={'class': 'form-input', 'rows': 6, 'placeholder': 'ข้อความของคุณ'}),
        }

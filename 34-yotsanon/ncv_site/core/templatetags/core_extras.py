from django import template
from django.utils import timezone

register = template.Library()

THAI_MONTHS = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
               'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']


@register.filter
def thai_date(value):
    """แสดงวันที่แบบไทย พ.ศ. เช่น 3 พ.ย. 2569"""
    if not value:
        return ''
    if hasattr(value, 'tzinfo') and value.tzinfo is not None:
        value = timezone.localtime(value)
    return f'{value.day} {THAI_MONTHS[value.month - 1]} {value.year + 543}'

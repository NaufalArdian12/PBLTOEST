@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
 <a href="{{ $url }}" class="button" style="background-color: #3b82f6; padding: 14px 28px; color: #ffffff; border-radius: 6px; text-decoration: none; display: inline-block;">
        {{ $slot }}
    </a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a').forEach(link => {
            link.setAttribute('target', '_self');
        });
    });
</script>


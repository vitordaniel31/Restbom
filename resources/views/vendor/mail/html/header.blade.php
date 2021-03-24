<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://restbom.herokuapp.com/images/logo.png" class="logo" alt="Restbom Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

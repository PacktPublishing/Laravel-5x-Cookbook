Hello,

A new release for {{ $comic->title }} see more <a href="{!! $comic->url !!}">here</a>

<br>
<br>

Description:
{!! $comic->getDescriptionSafe() !!}



From your friendly neighborhood ICDB!




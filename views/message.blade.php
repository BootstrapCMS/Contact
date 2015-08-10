@extends(Config::get('contact.layout'))

@section('content')
<p>{{ $name }} has sent you a message through the contact form on <a href="{{ $url }}">{{ $platform }}</a>.<p>
<p>Their message was:<p>
<blockquote>{!! $quote !!}</blockquote>
<p>You may contact them via their email address: <a href="mailto:{{ $contact }}">{{ $contact }}</a>.<p>
@stop

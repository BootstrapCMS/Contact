@extends(Config::get('contact.layout'))

@section('content')
<p>Thank you {{ $name }} for contacting <a href="{{ $url }}">{{ $platform}}</a>.</p>
<p>Your message will be reviewed, and you may be contacted again via this email address if required.</p>
<p>For reference, your message was:<p>
<blockquote>{!! $quote !!}</blockquote>
@stop

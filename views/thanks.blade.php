@extends(Config::get('contact.layout'))

@section('content')
<p>{{ trans('contact.thank_you_for_contacting', ['name' => $name]) }}<a href="{{ $url }}">{{ $platform}}</a>.</p>
<p>{{ trans('contact.your_message_will_be_reviewed') }}</p>
<p>{{ trans('contact.for_reference_your_message_was') }}:<p>
<blockquote>{!! $quote !!}</blockquote>
@stop

@extends(Config::get('contact.layout'))

@section('content')
<p>{{ $name }} {{ trans('contact.has_sent_you_a_message_through_the_contact_form_on') }} <a href="{{ $url }}">{{ $platform }}</a>.<p>
<p>{{ trans('contact.their_message_was') }}:<p>
<blockquote>{!! $quote !!}</blockquote>
<p>{{ trans('contact.you_may_contact_them_via_their_email_address') }}: <a href="mailto:{{ $contact }}">{{ $contact }}</a>.<p>
@stop

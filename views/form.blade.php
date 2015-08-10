<form class="form-horizontal" action="{{ URL::route('contact.post') }}" method="POST">

    {{ csrf_field() }}

    <div class="form-group{!! ($errors->has('first_name')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">First Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="first_name" id="first_name" value="{!! Request::old('first_name') !!}" type="text" class="form-control" placeholder="First Name">
            {!! ($errors->has('first_name') ? $errors->first('first_name') : '') !!}
        </div>
    </div>

    <div class="form-group{!! ($errors->has('last_name')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="last_name">Last Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="last_name" id="last_name" value="{!! Request::old('last_name') !!}" type="text" class="form-control" placeholder="Last Name">
            {!! ($errors->has('last_name') ? $errors->first('last_name') : '') !!}
        </div>
    </div>

    <div class="form-group{!! ($errors->has('email')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="email">Email</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="email" id="email" value="{!! Request::old('email') !!}" type="text" class="form-control" placeholder="Email">
            {!! ($errors->has('email') ? $errors->first('email') : '') !!}
        </div>
    </div>

    <div class="form-group{!! ($errors->has('message')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="message">Message</label>
        <div class="col-lg-6 col-md-8 col-sm-9 col-xs-12">
            <textarea name="message" id="message" class="form-control" placeholder="Message" rows="8">{!! Request::old('message') !!}</textarea>
            {!! ($errors->has('message') ? $errors->first('message') : '') !!}
        </div>
    </div>

    <div class="form-group">
    <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
        <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> Submit</button>
        <button class="btn btn-inverse" type="reset">Reset</button>
    </div>
</div>

</form>

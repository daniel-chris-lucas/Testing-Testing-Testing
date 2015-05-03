{{ Form::open() }}
    {{ Form::text('password', null, ['placeholder' => 'Some password']) }}
    {{ Form::submit('Hash String') }}
{{ Form::close() }}
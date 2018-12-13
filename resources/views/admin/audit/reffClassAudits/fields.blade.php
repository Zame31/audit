<!-- Definition Field -->
<div class="form-group col-sm-12">
    {!! Form::label('definition', 'Definition:') !!}
    {!! Form::text('definition', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_active', 'Is Active:') !!}
    {!! Form::select('is_active', ['t' => 't', 'f' => 'f'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.audit.reffClassAudits.index') !!}" class="btn btn-default">Cancel</a>
</div>

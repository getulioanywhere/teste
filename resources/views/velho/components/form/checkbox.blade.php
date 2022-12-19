<div class="form-group">
    @include('velho.components.form.label')

    @include('velho.components.form.prefix')

    @if (isset($multiple))
        <div class="multiple-checkbox">
            <div class="row">
                @isset($flat)
                    @foreach ($options as $id => $title)
                        <div class="col-md-{{ $grid ?? 12 }}">
                            <div class="checkbox">
                                <div class="icheck-primary d-inline">
                                    <input {{ $model && $model->{$name}->contains($id) ? ' checked' : '' }} id="{{ $name }}-{{ $id }}" type="checkbox" name="{{ $name }}[]" value="{{ $id }}" />
                                    <label for="{{ $name }}-{{ $id }}">
                                        {{ $title }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($options as $record)
                        <div class="col-md-{{ $grid ?? 12 }}">
                            <div class="checkbox">
                                <div class="icheck-primary d-inline">
                                    <input {{ $model && $model->{$name}->contains($record) ? ' checked' : '' }} id="{{ $name }}-{{ $record->id }}" type="checkbox" name="{{ $name }}[]" value="{{ $record->id }}" />
                                    <label for="{{ $name }}-{{ $record->id }}">
                                        {{ $record->{$display ?? 'title'} }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    @endif

    @include('velho.components.form.suffix')

    @include('velho.components.form.error-message')
</div>
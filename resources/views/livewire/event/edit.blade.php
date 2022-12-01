<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('event.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.event.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="event.name">
        <div class="validation-message">
            {{ $errors->first('event.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.event_file') ? 'invalid' : '' }}">
        <label class="form-label required" for="file">{{ trans('cruds.event.fields.file') }}</label>
        <x-dropzone id="file" name="file" action="{{ route('admin.events.storeMedia') }}" collection-name="event_file" max-file-size="2" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.event_file') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.file_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
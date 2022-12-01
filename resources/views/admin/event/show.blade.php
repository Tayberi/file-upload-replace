@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.event.title_singular') }}:
                    {{ trans('cruds.event.fields.id') }}
                    {{ $event->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.id') }}
                            </th>
                            <td>
                                {{ $event->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.name') }}
                            </th>
                            <td>
                                {{ $event->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.file') }}
                            </th>
                            <td>
                                @foreach($event->file as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('event_edit')
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
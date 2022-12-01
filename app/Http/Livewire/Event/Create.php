<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Event $event;

    public array $mediaToRemove = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.event.create');
    }

    public function submit()
    {
        $this->validate();

        $this->event->save();
        $this->syncMedia();

        return redirect()->route('admin.events.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->event->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'event.name' => [
                'string',
                'required',
                'unique:events,name',
            ],
            'mediaCollections.event_file' => [
                'array',
                'required',
            ],
            'mediaCollections.event_file.*.id' => [
                'integer',
                'exists:media,id',
            ],
        ];
    }
}

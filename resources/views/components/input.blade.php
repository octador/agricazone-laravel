@props(['id', 'type' => 'text', 'label' => null, 'value' => null, 'required' => false, 'autofocus' => false])

<div>
    <x-input-label :for="$id" :value="$label ?? __('Label')" />

    <x-input id="{{ $id }}"
             class="block mt-1 w-full"
             type="{{ $type }}"
             name="{{ $id }}"
             :value="$value"
             @if($required) required @endif
             @if($autofocus) autofocus @endif />
</div>

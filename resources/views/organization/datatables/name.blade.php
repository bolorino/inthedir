<strong><a href="{{ route('frontend.view', $row->slug) }}">{{ $row->name }}</a></strong>
<button class="text-gray-300" wire:click='$emit("openModal", "view-organization", {{ json_encode(["organization" => $row->organization_id]) }})'
        title="{{ __('Vista rápida') }}">
    👁
</button>

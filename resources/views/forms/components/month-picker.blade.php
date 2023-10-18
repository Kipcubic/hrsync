<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <!-- Interact with the `state` property in Alpine.js -->
        <input class="border rounded" value="{{now()->format('yyyy-MM')}}" type="month" x-model="state" />
    </div>
</x-dynamic-component>

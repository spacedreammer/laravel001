{{-- if you wanna add a class to it you do like this below(second) --}}

<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{$slot}}    
    </div> 
{{--first <div class="bg-gray-50 border border-gray-200 rounded p-6">
{{$slot}}    
</div> --}}
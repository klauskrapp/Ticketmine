<span style="font-size: 14px;"
      @if( $entity->icon_class != '')
        class="btn {{$entity->icon_class}} btn-sm"
      @endif
>
    {{$entity->name}}
</span>

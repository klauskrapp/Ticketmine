<?php /**  $row \App\Models\Ticket */ ?>
@foreach( $rows as $row )

    <tr class="align-middle {{\App\Helpers\Grid::getEvenOrOdd()}}">
        @if( auth()->user()->getSetting('show_column_unique_id') == 1 )
            <td style="width: 100px;">{{$row->unique_id}}</td>
        @endif

        @if( auth()->user()->getSetting('show_column_project') == 1 )
            <td>{{$row->project->name}}</td>
        @endif

        @if( auth()->user()->getSetting('show_column_name') == 1 )
            <td>{{$row->name}}</td>
        @endif

        @if( auth()->user()->getSetting('show_column_created_by') == 1 )
            <td>{{$row->creator->name}}</td>
        @endif

        @if( auth()->user()->getSetting('show_assigned_to') == 1 )
            <td>
                <?php
                    $users     = $row->assigned->pluck('name')->toArray();
                ?>
                {{implode(' ', $users)}}
            </td>
        @endif

        @if( auth()->user()->getSetting('show_priority') == 1 )
            <td style="width: 100px;ext-align: center"><span class="btn {{$row->priority->icon_class}} btn-sm">{{$row->priority->name}}</span></td>
        @endif

        @if( auth()->user()->getSetting('show_state') == 1 )
            <td style="width: 100px;ext-align: center"><span class="btn {{$row->state->icon_class}} btn-sm">{{$row->state->name}}</span></td>
        @endif

        @if( auth()->user()->getSetting('show_action') == 1 )
            <td style="width: 100px;text-align: center"><span class="btn {{$row->action->icon_class}} btn-sm">{{$row->action->name}}</span></td>
        @endif


        <td style="width: 50px; text-align: center">
            <a class="btn btn-success me-2" href="{{$row->getUrl()}}">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                </svg>
            </a>
        </td>

    </tr>
@endforeach

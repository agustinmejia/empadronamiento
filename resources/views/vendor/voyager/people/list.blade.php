<div class="col-md-12">
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre completo</th>
                    <th>CI</th>
                    <th>Fecha nac.</th>
                    <th>Telefono</th>
                    <th>Localidad</th>
                    <th>Cargo</th>
                    <th>Operador</th>
                    <th>Estado</th>
                    <th>Registrado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nombre_completo }}</td>
                    <td>{{ $item->ci }}</td>
                    <td>
                        @php
                            $now = \Carbon\Carbon::now();
                            $fecha_nacimiento = new \Carbon\Carbon($item->fecha_nacimiento);
                            $age = $fecha_nacimiento->diffInYears($now);
                        @endphp
                        {{ $item->fecha_nacimiento ? date('d/m/Y', strtotime($item->fecha_nacimiento)) : '' }} <br> 
                        <small @if($age < 18) class="text-danger" @endif>{{ $age }} años</small>
                    </td>
                    <td>{{ $item->celular ? $item->celular : '' }}</td>
                    <td>
                        {{ $item->localidad }} {{ $item->localidad != $item->municipio ? ' - '.$item->municipio : '' }} <br>
                        <b>{{ $item->provincia }}</b>
                    </td>
                    <td>{{ $item->cargo }}</td>
                    <td>{{ $item->operador }}</td>
                    <td><label class="label label-{{ $item->estado ? 'success' : 'danger' }}">{{ $item->estado ? 'Habilitado' : 'Anulado' }}</label></td>
                    <td>
                        {{ $item->user ? $item->user->name : '' }} <br>
                        {{ date('d/m/Y H:i', strtotime($item->created_at)) }} <br>
                        <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                    </td>
                    <td class="no-sort no-click bread-actions text-right">
                        @if (auth()->user()->hasPermission('read_people'))
                        <a href="{{ route('people.credential.download', $item->id) }}" title="Credencial" class="btn btn-sm btn-dark" style="margin: 5px; border: 0px" target="_blank">
                            <i class="voyager-credit-cards"></i> <span class="hidden-xs hidden-sm">Credencial</span>
                        </a>
                        <a href="{{ route('voyager.people.show', ['id' => $item->id]) }}" title="Ver" class="btn btn-sm btn-warning view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        @endif
                        @if (auth()->user()->hasPermission('edit_people'))
                        <a href="{{ route('voyager.people.edit', ['id' => $item->id]) }}" title="Editar" class="btn btn-sm btn-primary edit">
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                        </a>
                        @endif
                        @if (auth()->user()->hasPermission('delete_people'))
                        <button title="Borrar" class="btn btn-sm btn-danger delete" onclick="deleteItem('{{ route('voyager.people.destroy', ['id' => $item->id]) }}')" data-toggle="modal" data-target="#delete_modal">
                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr class="odd">
                        <td valign="top" colspan="11" class="dataTables_empty">No hay datos disponibles en la tabla</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-4" style="overflow-x:auto">
        @if(count($data)>0)
            <p class="text-muted">Mostrando del {{$data->firstItem()}} al {{$data->lastItem()}} de {{$data->total()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $data->links() }}
        </nav>
    </div>
</div>

<script>
    var page = "{{ request('page') }}";
    $(document).ready(function(){
        $('.page-link').click(function(e){
            e.preventDefault();
            let link = $(this).attr('href');
            if(link){
                page = link.split('=')[1];
                list(page);
            }
        });
    });
</script>
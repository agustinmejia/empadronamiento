<div class="col-md-12 text-right">
    @if (count($people))
        {{-- <button type="button" onclick="report_export('print')" class="btn btn-danger"><i class="glyphicon glyphicon-print"></i> Imprimir</button>
        <button type="button" onclick="report_export('excel')" class="btn btn-success"><i class="glyphicon glyphicon-download"></i> Excel</button> --}}
    @endif
</div>
@php
    $months = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
@endphp
<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                @if (!$group_by)
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>N&deg;</th>
                                <th>Nombre completo</th>
                                <th>CI</th>
                                <th>Fecha nac.</th>
                                <th>Telefono</th>
                                <th>Localidad</th>
                                <th>Cargo</th>
                                <th>Operador</th>
                                <th>Estado</th>
                                <th>Registrado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cont = 1;
                            @endphp
                            @forelse ($people as $item)
                            <tr>
                                <td>{{ $cont }}</td>
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
                            </tr>
                            @php
                                $cont++;
                            @endphp
                            @empty
                                <tr class="odd">
                                    <td valign="top" colspan="10" class="dataTables_empty">No hay datos disponibles en la tabla</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    @if ($summary)
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Detalle</th>
                                    <th class="text-right">Cantidad</th>
                                    <th class="text-right">Porncentaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = $people->count();
                                @endphp
                                @foreach ($people->groupBy($group_by) as $key => $item)
                                    <tr>
                                        <td>{{ $key != '' ? $key : 'No definido'}}</td>
                                        <td class="text-right">{{ count($item) }}</td>
                                        <td class="text-right">{{ number_format((count($item) * 100) / $people->count(), 2, ',') }}%</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-right"><b>TOTAL</b></td>
                                    <td class="text-right"><b>{{ $total }}</b></td>
                                    <td class="text-right"><b>100%</b></td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table table-bordered table-hover">
                            @forelse ($people->groupBy($group_by) as $key => $item_group_by)
                                <thead>
                                    <tr>
                                        <th colspan="10"><h4 class="text-center">{{ $key != '' ? $key : 'No definido' }}</h4></th>
                                    </tr>
                                    <tr>
                                        <th>N&deg;</th>
                                        <th>Nombre completo</th>
                                        <th>CI</th>
                                        <th>Fecha nac.</th>
                                        <th>Telefono</th>
                                        <th>Localidad</th>
                                        <th>Cargo</th>
                                        <th>Operador</th>
                                        <th>Estado</th>
                                        <th>Registrado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @forelse ($item_group_by as $item)
                                        <tr>
                                            <td>{{ $cont }}</td>
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
                                        </tr>
                                        @php
                                            $cont++;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="10">No hay datos disponibles en la tabla</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            @empty
                                <tr>
                                    <td>No hay datos disponibles en la tabla</td>
                                </tr>
                            @endforelse
                        </table>
                    @endif
                @endif
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

    })
</script>
<div class="row">

        <!-- LISTA DE VIDEOS -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">PRODUCTOS</h2>
                </div>
                <div class="panel-body contenedor_videos">

                    <table class="table table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th width="5%">Nº</th>
                                <th>Producto</th>
                                <th width="5%">C. U. Bs.</th>
                                <th width="5%">Stock</th>
                                <th width="5%">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_productos">
                            @foreach($productos as $producto)
                            <tr class="fila" data-cod="{{$producto->id}}" data-url = "{{route('productos.infoProducto',$producto->id)}}">
                                <td>#</td>
                                <td>{{$producto->nom}}</td>
                                <td class="centreado">{{$producto->costo}}</td>
                                <td class="centreado">{{$producto->disponible}}</td>
                                <td class="btns-opciones">
                                    @if($producto->disponible > 0)
                                    <a href="#" class="ir-evaluacion agregar"><i class="fa fa-plus" data-toggle="tooltip" data-placement="left" title="Agregar"></i></a>
                                    @else
                                    <button class="ir-evaluacion agregar" disabled><i class="fa fa-plus" data-toggle="tooltip" data-placement="left" title="Agregar"></i></button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>

        <!-- AGREGADOS -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">LISTA</h2>
                </div>
                <div class="panel-body">
                    <small>Expresado en Bolivianos</small>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">Nº</th>
                                <th>Producto</th>
                                <th width="12%">C. U. Bs.</th>
                                <th width="7%">Descuento %</th>
                                <th width="2%">Cantidad</th>
                                <th width="2%">Total Bs.</th>
                                <th width="2%">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_detalle">
                            <tr class="sin_registros">
                                <td colspan="7">NO HAY REGISTROS</td>
                            </tr>
                            <tr class="total">
                                <td colspan="4">TOTAL</td>
                                <td class="centreado">0</td>
                                <td class="centreado">0.00</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="col-md-12">
                        
                    </div>
                    <div class="col-md-12">
                        <table class="table_detalle_prestamo" style="border-collapse:separate;border-spacing: 10px;">
                            <tbody id="contenedorDetalle">
                                <tr>
                                    <td><label>TOTAL FINAL:</label></td>
                                    <td><input type="text" class="form-control" value="0.00" id="total_final" readonly></td>
                                </tr>
                                <tr>
                                    <td><label>CLIENTE:</label></td>
                                    <td>{{Form::select('cliente',$array_clientes,null,['class'=>'form-control','id'=>'cliente'])}}
                                </tr>
                                {{-- <tr>
                                    <td><label>NIT/C.I.:</label><small>(Obligatorio)</small></td>
                                    <td><input type="text" class="form-control" value="" id="nit"></td>
                                </tr> --}}
                                <tr>
                                    <td><label>FECHA DE VENTA:</label></td>
                                    <td><input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" id="fecha_venta" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-danger oculto" id="error-fechas"></div>
                        <br>
                        <div class="col-md-12">
                            <button class="btn btn-success" id="registrarVenta" style="width:100%;">Registrar venta</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col col-md-1">
                    <label for="nro">Nro. Cotización</label>
                    <input type="text" wire:model="quotation.nro" class="form-control" placeholder="Nro. Cotización">
                </div>
                <div class="col col-md-2">
                    <label for="fecha">Fecha</label>
                    <input type="date" wire:model="quotation.fecha" class="form-control" placeholder="Fecha">
                </div>
                <div class="col col-md-3">
                    <!--select for clientes-->
                    <label for="client_id">Cliente</label>
                    <select wire:model="quotation.client_id" class="form-control">
                        <option value="">Seleccione un cliente</option>
                        @foreach ($clients as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-md-2">
                    <!--select for quotationTypes-->
                    <label for="quotation_type_id">Tipo</label>
                    <select wire:model="quotation.quotation_type_id" class="form-control">
                        @foreach ($quotationTypes as $quotationType)
                        <option value="{{ $quotationType->id }}">{{ $quotationType->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-md-2">
                    <!--select for quotationStates-->
                    <label for="quotation_state_id">Estado</label>
                    <select wire:model="quotation.quotation_state_id" class="form-control">
                        @foreach ($quotationStates as $quotationState)
                        <option value="{{ $quotationState->id }}">{{ $quotationState->state }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-md-2">
                    <label>Total</label>
                    <span class="badge badge-success" style="font-size: 1.3em; width:100%">
                        $ {{ number_format($total,2,",",".") }}
                    </span>
                </div>

            </div>
            <div class="row">
                <!--select for contacto-->
                <div class="col col-md-3">
                    <label for="contacto_id">Contacto</label>
                    <select wire:model="quotation.contacto" class="form-control">
                        <option value="">Seleccione un contacto</option>
                        @foreach ($contacts as $contacto)
                        <option value="{{ $contacto->id }}">{{ $contacto->apellido_nombre }} - {{ $contacto->mail }} -
                            {{ $contacto->puesto }}</option>
                        @endforeach
                    </select>
                </div>
                <!--input trex for ref   -->
                <div class="col col-md-7">
                    <label for="ref">Ref.</label>
                    <input type="text" wire:model="quotation.ref" class="form-control" placeholder="Ref.">
                </div>
                <div class="col col-md-2">
                    <!--select for quotationPriorities-->
                    <label for="quotation_priority_id">Prioridad</label>
                    <select wire:model="quotation.quotation_priority_id" class="form-control">
                        @foreach ($quotationPriorities as $quotationPriority)
                        <option value="{{ $quotationPriority->id }}">{{ $quotationPriority->priority }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <!-- input date for fechaCOntacto -->
                <div class="col col-md-2">
                    <label for="fecha_contacto">Fecha Contacto</label>
                    <input type="date" wire:model="quotation.fechaContacto" class="form-control"
                        placeholder="Fecha Contacto">
                </div>
                <!-- input date for detalleContacto -->
                <div class="col col-md-10">
                    <label for="detalle_contacto">Detalle Contacto</label>
                    <input type="text" wire:model="quotation.detalleContacto" class="form-control"
                        placeholder="Detalle Contacto">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <!--table for input quotationDetails-->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th style="width: 10%">Precio Unit</th>
                                <th>Moneda</th>
                                <th>Cotizacion</th>
                                <th>Precio Ars</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Facturado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotationDetails as $index => $quotationDetail)
                            <tr>
                                <td>
                                    <!--select for product-->
                                    {{ $quotationDetail['descripcion'] }}
                                </td>
                                <td>
                                    <!-- input price, copy price from selected product-->
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="number" wire:model="quotationDetails.{{$index}}.precio"
                                            class="form-control text-right">
                                    </div>

                                </td>
                                <td style="white-space: nowrap; text-align:center">
                                    <!-- select for currency_id-->
                                    {{ $quotationDetail['moneda'] }}
                                </td>
                                <td style="white-space: nowrap; text-align:end">
                                    {{ $quotationDetail['cotizacion'] }}
                                </td>
                                <td style="white-space: nowrap; text-align:end">
                                    $ {{ number_format($quotationDetail['precio'] *
                                    $quotationDetail['cotizacion'],2,",",".") }}
                                </td>
                                <td style="width: 1%">
                                    <input type="number" wire:model="quotationDetails.{{$index}}.cantidad"
                                        class="form-control text-right">
                                </td>
                                <td style="white-space: nowrap; text-align:end">
                                    $ {{ number_format($quotationDetail['precio'] * $quotationDetail['cotizacion'] *
                                    $quotationDetail['cantidad'],2,",",".")}}
                                </td>

                                <td>
                                    <!-- input checkbox facturado-->
                                    <input type="checkbox" wire:model="quotationDetails.{{$index}}.facturado"
                                        class="form-control">
                                </td>
                                <td><button class="btn btn-danger"
                                        wire:click="removeQuotationDetail({{$index}})">X</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- button for open modal for find and select products-->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#productModal">Agregar
                        Producto</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col col-md-3">
                    <!--input for validezOferta-->
                    <label for="validezOferta">Validez Oferta</label>
                    <input type="text" wire:model="quotation.validezOferta" class="form-control"
                        placeholder="Validez Oferta">

                    <!--input for plazoEntrega-->
                    <label for="plazoEntrega">Plazo Entrega</label>
                    <input type="text" wire:model="quotation.plazoEntrega" class="form-control"
                        placeholder="Plazo Entrega">

                    <!--input for lugarEntrega-->
                    <label for="lugarEntrega">Lugar Entrega</label>
                    <input type="text" wire:model="quotation.lugarEntrega" class="form-control"
                        placeholder="Lugar Entrega">
                </div>
                <div class="col col-md-3">
                    <!--input for condicion-->
                    <label for="condicion">Condicion</label>
                    <input type="text" wire:model="quotation.condicion" class="form-control" placeholder="Condicion">
                    <!--input for nota-->
                    <label for="nota">Nota</label>
                    <textarea wire:model="quotation.nota" class="form-control" rows="4"></textarea>
                </div>
                <div class="col col-md-3">
                    <!--input for observaciones-->
                    <label for="observaciones">Observaciones</label>
                    <textarea wire:model="quotation.observaciones" class="form-control" rows="7"></textarea>
                </div>
                <div class="col col-md-3">
                    <!--select file solicitudCotizacion-->
                    <label for="solicitudCotizacion">Solicitud Cotizacion</label>
                    <input type="file" wire:model="solicitudCotizacion" class="form-control-file">

                    <!--select file cotizacion-->
                    <label for="cotizacion">Cotizacion</label>
                    <input type="file" wire:model="cotizacion" class="form-control-file">

                    <!--select file ordenCompra-->
                    <label for="ordenCompra">Orden Compra</label>
                    <input type="file" wire:model="ordenCompra" class="form-control-file">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" wire:click="guardar">Guardar</button>
            <a href="{{ route('admin.cotizaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>

    <!-- popup for find and select products-->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="max-height: 90vh; overflow: scroll;">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="productModalLabel">Productos</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        wire:click="clearProduct">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--input for search products-->
                    <input type="text" wire:model="searchTerm" class="form-control" placeholder="Buscar...">
                    <!--table for show products-->
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Moneda</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->descripcion_cotizacion }}</td>
                                <td>{{ $product->moneda()->first()->moneda }}</td>
                                <td>{{ number_format($product->precio_venta, 2, ",",".") }}</td>
                                <td>
                                    <button class="btn btn-primary"
                                        wire:click="addProduct({{ $product->id }})">Agregar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
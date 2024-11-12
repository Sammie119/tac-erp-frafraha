{{-- {{ $product }}--}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Details of {{ $product->name }}</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 20px">#</th>
                <th>Item</th>
                <th>Information</th>
                <th style="width: 40px"></th>
            </tr>
            </thead>
            <tbody>
                @can(\App\Enums\PermissionsEnum::CREATESTORESPRODUCTS->value)
                    @isset($product->image_url)
                        <tr>
                            <td colspan="4" align="center">
                                <div class="input-group mb-1" style="margin-left: auto">
                                    <img src="/storage/{{ $product->image_url }}" alt="Image" width="150">
                                </div>
                            </td>
                        </tr>
                    @endisset
                @endcan
                <tr class="align-middle">
                    <td>1.</td>
                    <td>{{__('Product Name')}}</td>
                    <td>{{ $product->name }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>{{__('Description')}}</td>
                    <td>{{ $product->description }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>{{__('Product Type')}}</td>
                    <td>{{ $product->type_name->name }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>{{__('Division')}}</td>
                    <td>{{ $product->division_name->name  }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>5.</td>
                    <td>{{__('Stock in')}}</td>
                    <td>{{ $product->stock_in }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>6.</td>
                    <td>{{__('Stock Out')}}</td>
                    <td>{{ $product->stock_out }}</td>
                    <td></td>
                </tr>
                @can(\App\Enums\PermissionsEnum::CREATESTORESPRODUCTS->value)
                    <tr class="align-middle">
                        <td>6.</td>
                        <td>{{__('Category')}}</td>
                        <td>{{ getCategoryName($product->category) }}</td>
                        <td></td>
                    </tr>
                    <tr class="align-middle">
                        <td>6.</td>
                        <td>{{__('Sub Category')}}</td>
                        <td>{{ getCategoryName($product->sub_category, 'Sub') }}</td>
                        <td></td>
                    </tr>
                    <tr class="align-middle">
                        <td>6.</td>
                        <td>{{__('Reorder Level')}}</td>
                        <td>{{ $product->reorder_level }}</td>
                        <td></td>
                    </tr>
                @endcan
                <tr class="align-middle">
                    <td>7.</td>
                    <td>{{__('Cost Price')}}</td>
                    <td>{{ $product->cost }}</td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                    <td>8.</td>
                    <td>{{__('Selling')}}</td>
                    <td>{{ $product->price }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->


    {{-- Buttons --}}
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>



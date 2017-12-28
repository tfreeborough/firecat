<div id="opportunity_products" class="block">
    <h3 class="title">Products</h3>
    <div id="opportunity_products_wrapper">
        @if(!$user->isAssigned($opportunity->id))
            <p>
                Non assigned members cannot view partner information on this opportunity, assign yourself first.
            </p>
        @else
            <table id="product-table" class="table table-striped">
                <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Quantity/Size/Model
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($opportunity->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
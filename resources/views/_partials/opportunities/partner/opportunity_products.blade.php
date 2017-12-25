<div id="opportunity_products" class="block">
    <h3 class="title">Products</h3>
    <div id="opportunity_products_wrapper">
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
    </div>
</div>
<div id="opportunity_products">
    <div class="row">
        <h3 class="title">Products</h3>
    </div>
    <div class="row">
        <table id="opportunity-product-table" class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Details</th>
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
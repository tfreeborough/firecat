<h3 class="title">Products</h3>
<div class="row">
    <div class="col-xs-12">
        @if(!$user->isAssigned($opportunity->id))
            <div class="disabled">
                <div class="disabled-block text-center">
                    <p>
                        You cannot view any products in this opportunity until you assign to this opportunity
                    </p>
                    <div>
                        <button onClick="assignmentConfirm()" class="button">Assign me to this opportunity</button>
                    </div>
                </div>
            </div>
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
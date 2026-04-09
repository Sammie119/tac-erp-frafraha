<form method="POST" action="{{ route('returned_product_store') }}">
    @csrf

    <datalist id="products">
        @foreach($products as $product)
            <option data-value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </datalist>

    <table class="table">
        <thead>
        <tr>
            <td colspan="2">
                Invoice No:
                {{--                <input type="text" list="suppliers" class="form-control" >--}}
                <x-input-datalist :options="$invoices" :placeholder="'Enter Invoice Number'" name="invoice_no" id="invoice_no"
                                  :list="'invoices'" autofocus/>
            </td>
            <th colspan="10">
                <button type='button' class="btn btn-primary btn-round ms-auto add_button float-end" title="Add"><i class="bi bi-plus-lg"></i> Add New Line
                </button>
            </th>
        </tr>
        <tr>
            <th style="width: 4px" class="bg-primary text-white">#</th>
            <th class="bg-primary text-white">Product Name</th>
            <th class="bg-primary text-white" style="width: 100px">Qty</th>
            <th class="bg-primary text-white" style="width: 100px">Rate</th>
            <th class="bg-primary text-white" style="width: 100px">Amount</th>
        </tr>
        </thead>
        <tbody class="field_wrapper">

        </tbody>
    </table>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type='button' class="btn btn-secondary btn-round" data-bs-dismiss="modal" title="Delete field"> Close</button>
        <button type='submit' class="btn btn-primary btn-round" title="Submit" id="submitBtn"> Submit</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        var x = 1;
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        // var fieldHTML = `<div><input type="text" name="field_name[]" value=""/><button type="button" class="remove_button btn btn-sm btn-danger" title="Delete field">Del</button></div>`; //New input field html

        // Once add button is clicked
        $(addButton).click(function(){
            const invoice = $('#invoice_no').val();
            const url = 'returned_products';

            if(invoice === ''){
                alert('Input Empty!!!');
            }else {
                // alert(invoice);
                $.ajax({
                    type:'POST',
                    url:`${url}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        invoice
                    },
                    success:function(data) {
                        if(data === 'No_data'){
                            alert('Invoice does not Exist!!!');
                        }else{
                            document.querySelector('.field_wrapper').innerHTML = "";
                            data.forEach(item => {
                                document.querySelector('.field_wrapper').insertAdjacentHTML(
                                    'beforeend',
                                    `<tr class="align-middle">
                                    <td>${x++}</td>
                                    <td>
                                        <input type="text" class="form-control" value="${item.product_name.name}" readonly>
                                    </td>
                                    <td>
                                         <input type="number" class="form-control" value="${item.quantity}" readonly>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" value="${item.unit_price}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="${item.amount}" readonly>
                                    </td>
                                </tr>`
                                );
                            });
                            document.querySelector('.field_wrapper').insertAdjacentHTML(
                                'beforeend',
                                `<tr class="align-middle">
                                    <td colspan="5">
                                        <input type="text" class="form-control" name="reason" placeholder="Enter Reason" required>
                                    </td>
                                </tr>`
                            );
                        }
                    }
                });
            }
        });

        document.getElementById("submitBtn").addEventListener("click", function(e) {
            if (!confirm("This action is not reversible. Click OK to continue?")) {
                e.preventDefault(); // stop form submission
            }
        });
    });
</script>


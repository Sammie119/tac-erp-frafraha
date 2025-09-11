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
                <x-input-datalist :options="$invoices" :placeholder="'Enter Invoice Number'" name="invoice_no"
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
            <th class="bg-primary text-white">Reason</th>
            <th class="bg-primary text-white" style="width: 100px">Qty</th>
            <th class="bg-primary text-white" style="width: 100px">Rate</th>
            <th class="bg-primary text-white" style="width: 100px">Amount</th>
            <th style="width: 20px" class="bg-primary text-white">Action</th>
        </tr>
        </thead>
        <tbody class="field_wrapper">

        </tbody>
    </table>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type='button' class="btn btn-secondary btn-round" data-bs-dismiss="modal" title="Delete field"> Close</button>
        <button type='submit' class="btn btn-primary btn-round" title="Submit"> Submit</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        let x = document.querySelectorAll('.align-middle').length;
        // let x = count; //Initial field counter is 1
        var maxField = 20; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        // var fieldHTML = `<div><input type="text" name="field_name[]" value=""/><button type="button" class="remove_button btn btn-sm btn-danger" title="Delete field">Del</button></div>`; //New input field html

        // Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                $(wrapper).append(`<tr class="align-middle">
                    <td>${x}</td>
                    <td>
                        <input type="text" id="returned_product_${x}" list="products" class="form-control returned_product_${x}" required>
                        <input type="hidden" name="returned_product[${x}][product_id]" id="returned_product_${x}-hidden">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="returned_product[${x}][reason]" required>
                    </td>
                    <td>
                         <input type="number" class="form-control" name="returned_product[${x}][quantity]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="returned_product[${x}][unit_price]" required>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="returned_product[${x}][amount]" required>
                    </td>

                    <td>
                        <button type='button' class="btn btn-icon btn-danger remove_button btn-sm" title="Delete field"> <i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>`); //Add field html

                const el = document.querySelector(`.returned_product_${x}`);
                if (el) {
                    el.addEventListener('input', function (e) {
                        var input = e.target,
                            list = input.getAttribute('list'),
                            options = document.querySelectorAll('#' + list + ' option'),
                            hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
                            inputValue = input.value;

                        hiddenInput.value = inputValue;

                        for (var i = 0; i < options.length; i++) {
                            var option = options[i];

                            if (option.innerText === inputValue) {
                                hiddenInput.value = option.getAttribute('data-value');
                                break;
                            }
                        }
                    });
                }

                x++; //Increase field counter
            }else{
                alert('A maximum of '+maxField+' fields are allowed to be added. ');
            }
        });

        // Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            const id = this.getAttribute('data-bs-id');
            $(this).closest('tr').remove(); //Remove field html
            x--; //Decrease field counter
        });
    });
</script>


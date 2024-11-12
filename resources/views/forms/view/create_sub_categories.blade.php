<form method="POST" action="sub_categories_store">
    @csrf

    <input type="hidden" value="{{ $category }}" name="id" />

    <table class="table">
        <thead>
            <tr>
                <th colspan="3"><button type="button" class="add_button btn btn-outline-primary float-end" title="Add"><i class="bi bi-plus-lg"></i> Add Sub Category</button></th>
            </tr>
            <tr>
                <th>Sub Category Name</th>
                <th style="width: 20%">M. Unit</th>
                <th>Description</th>
                <th style="width: 40px">Action</th>
            </tr>
        </thead>
        <tbody class="field_wrapper">
            @forelse ($values as $value)
                <tr class="align-middle">
                    <td>
                        <input type="hidden" name="value_id[]" value="{{ $value->sub_category_id }}">
                        <input type="text" value="{{ $value->name }}" class="form-control" name="value[]">
                    </td>
                    <td>
                        <x-input-select :options="$units" :selected="isset($category) ? $value->unit : 0" name="unit[]" required />
{{--                        <input type="text" value="{{ $value->unit }}" class="form-control" name="description[]">--}}
                    </td>
                    <td>
                        <input type="text" value="{{ $value->description }}" class="form-control" name="description[]">
                    </td>
                    <td><a class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2" data-bs-url2="form_delete/deleteSubCategory/{{ $value->sub_category_id }}" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></a></td>
                </tr>
            @empty

        @endforelse
        </tbody>
    </table>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        var maxField = 20; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        // var fieldHTML = `<div><input type="text" name="field_name[]" value=""/><button type="button" class="remove_button btn btn-sm btn-danger" title="Delete field">Del</button></div>`; //New input field html
        var fieldHTML = `<tr class="align-middle">
                <td>
                    <input type="text" class="form-control" name="value[]">
                </td>
                <td>
                    <input type="text" class="form-control" name="unit[]">
                </td>
                <td>
                    <input type="text" class="form-control" name="description[]">
                </td>
                <td><button type="button" class="remove_button btn btn-danger" title="Del field"> <i class="bi bi-trash"></i> </button></td>
            </tr>`;
        var x = 1; //Initial field counter is 1

        // Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increase field counter
                $(wrapper).append(fieldHTML); //Add field html
            }else{
                alert('A maximum of '+maxField+' fields are allowed to be added. ');
            }
        });

        // Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).closest('tr').remove(); //Remove field html
            x--; //Decrease field counter
        });
    });
</script>


{{-- @props(['size']) --}}
<div class="modal fade" id="exampleModalToggle2" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalToggleLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Confirm Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- @include('forms.create') --}}
            </div>
        </div>
    </div>
</div>

<script>
    const exampleModalToggle = document.getElementById('exampleModalToggle2')
    if (exampleModalToggle) {
        exampleModalToggle.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget

            // Ajax Request
            const url = button.getAttribute('data-bs-url2')
            $.get(`${url}`, function(result) {
                $(".modal-body").html(result);
            })
        })
    }
</script>

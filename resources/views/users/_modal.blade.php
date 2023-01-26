<div class="modal fade" id="operationModal" tabindex="-1" aria-labelledby="operationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-normal" id="operationModalLabel">Grid Modals</h6>
                <button type="button" class="btn-close text-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="operationModalContent"></div>
            <input type="hidden" name="type_operation" value="0" id="type_operation">
            <input type="hidden" name="id_member" value="0" id="id_member">
            <div class="modal-footer" id="submit_mod">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i
                        class="fa fa-ban"></i> {{trans('messages.cancel')}} </button>
                <button type="button" class="btn btn-sm btn-success" onclick="do_operation()"><i
                        class="fa fa-check"></i> {{trans('messages.submitbutton')}}</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade deleteBizAjaxItemModal" id="deleteBizAjaxItemModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('common.Delete') </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('common.Are you sure to delete ?')</h4>
                    <p>@lang('common.Once deleted, it will deleted all related Data!')</p>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.Cancel')</button>
                    <form id="item_delete_form" action="" method="delete">
                        @method('delete')
                        <button class="primary-btn fix-gr-bg submit" type="submit" >@lang('common.Delete')</button>
                        <button class="primary-btn fix-gr-bg submitting" disabled type="button" style="display: none;" >@lang('common.Deletting')</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

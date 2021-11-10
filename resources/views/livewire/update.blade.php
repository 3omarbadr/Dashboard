<div wire:ignore.self class="modal fade" id="update-product" aria-hidden="true" style="display:none" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form>
                    <div class="row">
                        <div class="col-6">
                            <input type="hidden" wire:model='ids' name="id">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" wire:model='name'>
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" wire:model='description'>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" wire:model='price'>
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <label class="custom-file-label">Choose Image</label>
                                        <input type="file" name="image" class="custom-file-input" wire:model='image'>
                                        @error('image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent='update()'>Update Product</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div wire:ignore.self class="modal fade"  id="add-product" aria-hidden="true" style="display:none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                 <form>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" wire:model='name'>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" wire:model='description'>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" wire:model='price'>
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" wire:model='image'>
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent='store()'>Add Product</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div wire:ignore.self class="modal fade" id="addproductModal" tabindex="-1"  style="display:none" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New product </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
              <div clsss="form-group">
                  <label for="firstname">First Name </label>
                  <input type="text" name="name" class="form-control" wire:model="name"/>
              </div>
              <div clsss="form-group">
                <label for="lastname">Last Name </label>
                <input type="text" name="description" class="form-control" wire:model="description"/>
            </div>
            <div clsss="form-group">
                <label>Price </label>
                <input type="number" name="price" class="form-control"wire:model="price"/>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" wire:click.prevent="store()">Add product</button>
        </div>
      </div>
    </div>
  </div>
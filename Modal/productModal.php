<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Product Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="route.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <center><img src="css/account.png" id="imgProducts" alt="avatar" width="130" height="130" style="border-radius: 50%;">
          </center>
          <input class="form-control" id="fileChooserProducts" type="file" name="file" accept="image/png, image/jpeg" style="margin-top: 8px;">
          <script>
            fileChooserProducts.onchange = (e) => {
                if (e.target.files && e.target.files[0]) {
                    document.querySelector('#imgProducts').src = URL.createObjectURL(event.target.files[0]);
                }
            }
          </script>
        </div>
        <label>Item Name</label>
        <input type="text" name="name" class="form-control" required/>
        <label>Description</label>
        <input type="text" name="desc" class="form-control" required/>
        <label>Category</label>
        <select name="category" class="form-control">
          <?php foreach ($catObj->getCategory() as $cat):?>
            <option value="<?php echo $cat['cat_id'];?>"><?php echo $cat['category'];?></option>
          <?php endforeach;?>
        </select>
        <label>Price</label>
        <input type="number" name="price" class="form-control" required/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        <input type="hidden" name="addProductAction" value="addProductAction"/>
        </form>
      </div>
    </div>
  </div>
</div>
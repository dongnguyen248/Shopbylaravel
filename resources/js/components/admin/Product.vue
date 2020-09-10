<template>
  <div class="container">
    <div class="row pt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Product Table</h3>

            <div style="width:200px; display:inline; margin-left:650px">
              <select
                v-model="filterProduct"
                name="filterProduct"
                class="form-control"
                style="width:200px; display:inline"
              >
                <option value="all">All Product Type</option>
                <option
                  v-for="type in productTypes"
                  :key="type.id"
                  :value="type.name"
                >{{ type.name }}</option>
              </select>
            </div>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal()">
                Add new
                <i class="fa fa-plus fa-fw"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ProductCode</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Uom</th>
                  <th>Type</th>
                  <th>Price</th>
                  <th>PromotionPrice</th>
                  <th>Photo</th>
                  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products" :key="product.id">
                  <td>{{ product.id }}</td>
                  <td>{{ product.name | upFirst }}</td>
                  <td>{{ product.description }}</td>
                  <td>{{ product.uom }}</td>
                  <td>{{ product.product_type }}</td>
                  <td>{{ product.price | myNumber }}</td>
                  <td>{{ product.promotion_price | myNumber }}</td>
                  <td>
                    <img
                      v-if="
                                                product.photo != '' &&
                                                    product.photo != null
                                            "
                      class="media-object"
                      v-bind:src="
                                                'images/product/' +
                                                    product.photo
                                            "
                      alt="Photo"
                    />
                  </td>
                  <td>
                    <a href="#">
                      <i class="fa fa-edit text-blue" @click="editModal(product)"></i>
                    </a>
                    /
                    <a href="#">
                      <i
                        class="fa fa-trash text-red"
                        @click="
                                                    deleteProduct(product.id)
                                                "
                      ></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <div>
          <paginate
            :page-count="totalPage"
            :click-handler="getProductPage"
            :prev-text="'Prev'"
            :next-text="'Next'"
            :container-class="'pagination'"
            :page-class="'page-item'"
            :page-link-class="'page-link'"
            :prev-link-class="'page-link'"
            :next-link-class="'page-link'"
          ></paginate>
        </div>
        <!-- /.card -->
      </div>
    </div>

    <div
      class="modal fade"
      id="productModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="productModal"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEdit ? "Edit Product" : "Add new" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            @submit.prevent="
                            isEdit ? updateProduct() : createProduct()
                        "
          >
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                  placeholder="Name"
                  required
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.description"
                  type="description"
                  name="description"
                  class="form-control"
                  placeholder="description"
                />
              </div>
              <div class="form-group">
                <select v-model="form.uom" name="type" class="form-control">
                  <option value="none" selected>Select Product Uom</option>
                  <option v-for="uom in productUoms" :key="uom.id" :value="uom.name">{{ uom.name }}</option>
                </select>
              </div>
              <div class="form-group">
                <select v-model="form.product_type" name="type" class="form-control">
                  <option value="none" selected>Select Product Type</option>
                  <option
                    v-for="type in productTypes"
                    :key="type.id"
                    :value="type.name"
                  >{{ type.name }}</option>
                </select>
              </div>

              <div class="form-group">
                <input
                  v-model="form.price"
                  type="price"
                  name="price"
                  class="form-control"
                  placeholder="Price"
                  required
                />
              </div>
              <div class="form-group">
                <input
                  v-model="form.promotion_price"
                  type="pricePromotion"
                  name="pricePromotion"
                  class="form-control"
                  placeholder="Price Promotion"
                />
              </div>
              <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                <div class="input-group col-sm-10">
                  <div class="custom-file">
                    <input
                      type="file"
                      class="custom-file-input"
                      id="photo"
                      @change="chooseFile"
                      accept="image/*"
                    />
                    <label class="custom-file-label" for="photo">{{ form.photo }}</label>
                  </div>
                </div>
              </div>

              <p class="note" v-if="sizeFile / 1048576 >= 2">Vui lòng chọn hình nhỏ hơn 2MB</p>
            </div>
            <div class="modal-footer" v-if="sizeFile / 1048576 < 2">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">{{ isEdit ? "Update" : "Create" }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  watch: {
    filterProduct() {
      console.log(this.filterProduct);
      this.getProductFilter();
    }
  },
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        description: "",
        uom: "none",
        product_type: "none",
        price: "",
        promotion_price: 0,
        photo: ""
      }),
      products: [],
      totalPage: 1,
      isEdit: false,
      image: "",
      filterProduct: "all",
      productTypes: [],
      productUoms: [],
      sizeFile: 0
    };
  },
  methods: {
    newModal() {
      this.isEdit = false;
      this.form.reset();
      this.form.clear();
      $("#productModal").modal("show");
    },
    editModal(product) {
      this.isEdit = true;
      this.form.clear();
      this.form.reset();
      $("#productModal").modal("show");
      this.form.fill(product);
    },

    getProduct() {
      this.$Progress.start();
      axios.get("api/product").then(({ data }) => {
        console.log(data.products.data);
        this.products = data.products.data;
        this.totalPage = data.last_page;
      });
      this.$Progress.finish();
    },
    getProductType() {
      axios.get("api/productType").then(({ data }) => {
        this.productTypes = data.data;
      });
    },
    getProductUom() {
      axios.get("api/productUom").then(({ data }) => {
        this.productUoms = data.data;
      });
    },
    getProductPage(page) {
      axios.get("api/product?page=" + page).then(({ data }) => {
        this.products = data.data;
        this.totalPage = data.last_page;
      });
    },
    chooseFile(event) {
      let fileData = event.target.files[0];
      this.form.photo = fileData.name;
      this.sizeFile = fileData.size;
      this.image = fileData;
    },
    getProductFilter() {
      axios.get("api/product/filter/" + this.filterProduct).then(({ data }) => {
        this.products = data.data;
        this.totalPage = data.last_page;
      });
    },
    createProduct() {
      const formData = new FormData();
      formData.set("image", this.image);
      formData.set("name", this.form.name);
      formData.set("description", this.form.description);
      formData.set("uom", this.form.uom);
      formData.set("product_type", this.form.product_type);
      formData.set("price", this.form.price);
      formData.set("promotion_price", this.form.promotion_price);
      axios.post("api/product", formData).then(() => {
        $("#productModal").modal("hide");
        this.image = "";
        this.getProduct();
        Toast.fire({
          icon: "success",
          title: "Creaed product in successfully"
        });
      });
    },
    updateProduct() {
      const formData = new FormData();
      formData.set("image", this.image);
      formData.set("name", this.form.name);
      formData.set("description", this.form.description);
      formData.set("uom", this.form.uom);
      formData.set("product_type", this.form.product_type);
      formData.set("price", this.form.price);
      formData.set("photo", this.form.photo);
      formData.set("promotion_price", this.form.promotion_price);
      axios.post("api/updateProduct/" + this.form.id, formData).then(() => {
        $("#productModal").modal("hide");
        this.image = "";
        this.getProduct();
        Toast.fire({
          icon: "success",
          title: "Updated user in successfully"
        });
      });
    },
    deleteProduct(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("api/product/" + id)
            .then(response => {
              Swal.fire("Deleted!", "Product has been deleted.", "success");
              this.getProduct();
            })
            .catch(() => {
              Swal.fire("Failed!", "There was something wronge.", "warning");
            });
        }
      });
    }
  },
  mounted() {
    this.getProduct();
    this.getProductType();
    this.getProductUom();
  }
};
</script>

<style lang="css" scoped>
.media-object {
  display: inline-block;
  height: 64px;
  width: 64px;
}

.note {
  font-size: 14px;
  color: red;
  font-style: italic;
}
</style>

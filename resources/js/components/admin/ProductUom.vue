<template>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product UOM Table</h3>

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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Creaed At</th>
                                    <th>Updated At</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="productUom in productUoms"
                                    :key="productUom.id"
                                >
                                    <td>{{ productUom.id }}</td>
                                    <td>{{ productUom.name | upFirst }}</td>
                                    <td>{{ productUom.created_at }}</td>
                                    <td>{{ productUom.updated_at }}</td>
                                    <td>
                                        <a href="#">
                                            <i
                                                class="fa fa-edit text-blue"
                                                @click="editModal(productUom)"
                                            ></i>
                                        </a>
                                        /
                                        <a href="#">
                                            <i
                                                class="fa fa-trash text-red"
                                                @click="
                                                    deleteProductUom(
                                                        productUom.id
                                                    )
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
                        :click-handler="getProductUomPage"
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
            id="productUomModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="productUomModal"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{
                                isEdit
                                    ? "Edit Product UOM"
                                    : "Add new Product UOM"
                            }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        @submit.prevent="
                            isEdit ? updateProductUom() : createProductUom()
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
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ isEdit ? "Update" : "Create" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                id: "",
                name: ""
            }),
            productUoms: [],
            totalPage: 1,
            isEdit: false
        };
    },
    methods: {
        newModal() {
            this.isEdit = false;
            this.form.reset();
            this.form.clear();
            $("#productUomModal").modal("show");
        },
        editModal(productUom) {
            this.isEdit = true;
            this.form.clear();
            this.form.reset();
            $("#productUomModal").modal("show");
            this.form.fill(productUom);
        },
        createProductUom() {
            this.form.post("api/productUom").then(({ data }) => {
                $("#productUomModal").modal("hide");
                this.getProductUom();
                Toast.fire({
                    icon: "success",
                    title: "Creaed UOM in successfully"
                });
            });
        },
        getProductUom() {
            this.$Progress.start();
            axios.get("api/productUom").then(({ data }) => {
                this.productUoms = data.data;
                this.totalPage = data.last_page;
            });
            this.$Progress.finish();
        },
        getProductUomPage(page) {
            axios.get("api/productUom?page=" + page).then(({ data }) => {
                this.productUoms = data.data;
                this.totalPage = data.last_page;
            });
        },
        updateProductUom() {
            this.form.put("api/productUom/" + this.form.id).then(() => {
                $("#productUomModal").modal("hide");
                this.getProductUom();
                Toast.fire({
                    icon: "success",
                    title: "Updated UOM in successfully"
                });
            });
        },
        deleteProductUom(id) {
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
                        .delete("api/productUom/" + id)
                        .then(response => {
                            Swal.fire(
                                "Deleted!",
                                "Product Uom has been deleted.",
                                "success"
                            );
                            this.getProductUom();
                        })
                        .catch(() => {
                            Swal.fire(
                                "Failed!",
                                "There was something wronge.",
                                "warning"
                            );
                        });
                }
            });
        }
    },
    mounted() {
        this.getProductUom();
    }
};
</script>

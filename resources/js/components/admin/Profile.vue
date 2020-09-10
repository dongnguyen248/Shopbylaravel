<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div
            class="widget-user-header text-white"
            style="background: url('./images/profile/user-background.jpeg') center center;"
          >
            <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
            <h5 class="widget-user-desc text-right">Web Designer</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" v-bind:src="'images/profile/'+form.photo" alt="User Avatar" />
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">3,200</h5>
                  <span class="description-text">SALES</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">13,000</h5>
                  <span class="description-text">FOLLOWERS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">35</h5>
                  <span class="description-text">PRODUCTS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link" href="#activity" data-toggle="tab">Activity</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#settings" data-toggle="tab">Settings</a>
            </li>
          </ul>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane" id="activity">
              <!-- Post -->
              <div class="post">Activity</div>
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane active" id="settings">
              <form class="form-horizontal">
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input
                      v-model="form.name"
                      type="text"
                      class="form-control"
                      id="name"
                      placeholder="Name"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input
                      v-model="form.email"
                      type="email"
                      class="form-control"
                      id="email"
                      placeholder="Email"
                      disabled
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="photo" class="col-sm-2 col-form-label">Avatar</label>
                  <div class="input-group col-sm-10">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" @change="chooseFile" />
                      <label class="custom-file-label" for="photo">{{ fileName }}</label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" /> I agree to the
                        <a href="#">terms and conditions</a>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button
                      type="submit"
                      @click.prevent="updateProfile"
                      class="btn btn-danger"
                    >Submit</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.card-body -->
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
        name: "",
        password: "",
        email: "",
        type: "",
        photo: "profile.png",
      }),
      fileName: "Choose File",
      image: "",
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.getUser();
  },
  methods: {
    getUser() {
      axios.get("api/profile").then(({ data }) => {
        this.form.fill(data);
      });
    },
    chooseFile(event) {
      let fileData = event.target.files[0];
      this.fileName = fileData.name;
      this.image = fileData;
    },
    updateProfile() {
      const formData = new FormData();
      formData.set("image", this.image);
      formData.set("photo", this.fileName);
      formData.set("id", this.form.id);
      formData.set("name", this.form.name);
      axios
        .post("api/profile", formData)
        .then(() => {
          console.log("success");
        })
        .catch();
    },
  },
};
</script>

<style lang="css" scoped>
.widget-user-header {
  height: 250px;
  background: cover;
}
</style>

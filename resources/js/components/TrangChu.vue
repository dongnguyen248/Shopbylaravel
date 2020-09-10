<template>
  <div>
    <div id="carouselExampleIndicators" class="carousel slide container" data-ride="carousel">
      <ol class="carousel-indicators">
        <li
          data-target="#carouselExampleIndicators"
          :data-slide-to="i"
          :class="i == 0 ? 'active' : ''"
          v-for="(slide, i) in slides"
          :key="i"
        ></li>
      </ol>
      <div class="carousel-inner">
        <div
          :class="
                        slide.id == 0 ? 'carousel-item active' : 'carousel-item'
                    "
          v-for="slide in slides"
          :key="slide.id"
        >
          <img class="d-block w-100" :src="'/image/slide/' + slide.photo" alt="First slide" />
        </div>
      </div>
      <a
        class="carousel-control-prev"
        href="#carouselExampleIndicators"
        role="button"
        data-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a
        class="carousel-control-next"
        href="#carouselExampleIndicators"
        role="button"
        data-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!--slider-->

    <div class="container">
      <div id="content" class="space-top-none">
        <div class="main-content">
          <div class="space60">&nbsp;</div>
          <div class="row">
            <div class="col-sm-12">
              <div class="beta-products-list">
                <h4>Sản phẩm mới</h4>
                <div class="beta-products-details">
                  <p class="pull-left">
                    Tìm thấy {{ newProducts.total }} sản
                    phẩm
                  </p>
                  <div class="clearfix"></div>
                </div>
                <div class="row">
                  <div class="col-sm-3" v-for="product in newProducts" :key="product.id">
                    <div class="single-item">
                      <div
                        class="ribbon-wrapper"
                        v-if="
                                                    product.promotion_price > 0
                                                "
                      >
                        <div class="ribbon sale">Sale</div>
                      </div>
                      <div class="single-item-header">
                        <a href>
                          <img
                            :src="
                                                            'images/product/' +
                                                                product.photo
                                                        "
                            alt
                            height="250px"
                          />
                        </a>
                      </div>
                      <div class="single-item-body">
                        <p class="single-item-title">{{ product.name }}</p>
                        <p class="single-item-price">
                          <span
                            v-if="
                                                            product.promotion_price >
                                                                0 &&
                                                                product.promotion_price <
                                                                    product.price
                                                        "
                          >
                            <span class="flash-del">
                              {{ product.price | myNumber }}
                              đ
                            </span>
                            <span class="flash-sale">
                              {{
                              product.promotion_price | myNumber
                              }}
                              đ
                            </span>
                          </span>
                          <span class v-else>
                            {{ product.price | myNumber }}
                            đ
                          </span>
                        </p>
                      </div>
                      <div class="single-item-caption">
                        <a class="add-to-cart pull-left" href>
                          <i class="fa fa-shopping-cart"></i>
                        </a>
                        <a class="beta-btn primary" href>
                          Details
                          <i class="fa fa-chevron-right"></i>
                        </a>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div>
                    <paginate
                      :page-count="totalNewPage"
                      :click-handler="getNewProductPage"
                      :prev-text="'Prev'"
                      :next-text="'Next'"
                      :container-class="'pagination'"
                      :page-class="'page-item'"
                      :page-link-class="'page-link'"
                      :prev-link-class="'page-link'"
                      :next-link-class="'page-link'"
                    ></paginate>
                  </div>
                </div>
              </div>
              <!-- .beta-products-list -->

              <div class="space50">&nbsp;</div>

              <div class="beta-products-list">
                <h4>Sản phẩm nổi bật</h4>
                <div class="beta-products-details">
                  <p class="pull-left">
                    Tìm thấy {{ topProducts.total }} sản
                    phẩm
                  </p>
                  <div class="clearfix"></div>
                </div>
                <div class="row">
                  <div class="col-sm-3" v-for="topProduct in topProducts" :key="topProduct.id">
                    <div class="single-item">
                      <div
                        class="ribbon-wrapper"
                        v-if="
                                                    topProduct.promotion_price >
                                                        0
                                                "
                      >
                        <div class="ribbon sale">Sale</div>
                      </div>
                      <div class="single-item-header">
                        <a href>
                          <img
                            :src="
                                                            'images/product/' +
                                                                topProduct.photo
                                                        "
                            alt
                            height="250px"
                          />
                        </a>
                      </div>
                      <div class="single-item-body">
                        <p class="single-item-title">{{ topProduct.name }}</p>
                        <p class="single-item-price">
                          <span
                            v-if="
                                                            topProduct.promotion_price >
                                                                0
                                                        "
                          >
                            <span class="flash-del">
                              {{
                              topProduct.price | myNumber
                              }}
                              đ
                            </span>
                            <span class="flash-sale">
                              {{
                              topProduct.promotion_price | myNumber
                              }}
                              đ
                            </span>
                          </span>
                          <span v-else>
                            {{
                            topProduct.price | myNumber
                            }}
                            đ
                          </span>
                        </p>
                      </div>
                      <div class="single-item-caption">
                        <a class="add-to-cart pull-left" href>
                          <i class="fa fa-shopping-cart"></i>
                        </a>
                        <a class="beta-btn primary" href>
                          Details
                          <i class="fa fa-chevron-right"></i>
                        </a>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div>
                    <paginate
                      :page-count="totalTopPage"
                      :click-handler="getTopProductPage"
                      :prev-text="'Prev'"
                      :next-text="'Next'"
                      :container-class="'pagination'"
                      :page-class="'page-item'"
                      :page-link-class="'page-link'"
                      :prev-link-class="'page-link'"
                      :next-link-class="'page-link'"
                    ></paginate>
                  </div>
                </div>
                <div class="space40">&nbsp;</div>
              </div>
              <!-- .beta-products-list -->
            </div>
          </div>
          <!-- end section with sidebar and main content -->
        </div>
        <!-- .main-content -->
      </div>
      <!-- #content -->
    </div>
    <!-- .container -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      slides: [
        {
          id: 0,
          photo: "banner1.jpg"
        },
        {
          id: 1,
          photo: "banner2.jpg"
        },
        {
          id: 2,
          photo: "banner3.jpg"
        },
        {
          id: 4,
          photo: "banner4.jpg"
        }
      ],
      newProducts: [],
      topProducts: [],
      totalNewPage: 0,
      totalTopPage: 0
    };
  },
  methods: {
    getNewProductPage(page) {
      axios.get("api/product?page=" + page).then(({ data }) => {
        this.newProducts = data.pagenew.data;
        this.totalNewPage = data.pagenew.last_page;
        // console.log(data.newproducts);
      });
    },
    getTopProductPage(page) {
      axios.get("api/product?page=" + page).then(({ data }) => {
        this.topProducts = data.pagetop.data;
        // console.log(data.data);
        this.totalPage = data.pagetop.last_page;
      });
    }
  },
  mounted() {
    console.log("Component mounted.");
    this.getNewProductPage(1);
    this.getTopProductPage(1);
  }
};
</script>

<style lang="css" scoped>
.pagination {
  margin-top: 15px;
}
.d-block {
  display: inline-block;
  height: 490px;
  width: 100%;
}
</style>

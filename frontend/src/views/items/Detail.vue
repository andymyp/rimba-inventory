<script>
import { reactive, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";

import api, { apiUrl } from "../../api";

export default {
  setup() {
    const item = reactive({
      nama_item: "",
      unit: "",
      stok: "",
      harga_satuan: "",
    });

    const barang = reactive({
      gambar: "",
    });

    const router = useRouter();
    const route = useRoute();

    onMounted(() => {
      api.get(`/api/items/${route.params.id}`).then((res) => {
        item.nama_item = res.data.data.nama_item;
        item.unit = res.data.data.unit;
        item.stok = res.data.data.stok;
        item.harga_satuan = res.data.data.harga_satuan;
        barang.gambar = res.data.data.barang;
      });
    });

    return { item, barang, router, apiUrl };
  },
};
</script>

<template>
  <div class="row">
    <div class="col-md-12 content-header">
      <h4>Detail Item</h4>
      <router-link
        tag="a"
        class="btn btn-secondary"
        :to="{ name: 'items.index' }"
        >Cancel</router-link
      >
    </div>
    <div class="col-md-12 mt-3 content-body">
      <div class="row">
        <div class="col-md-3">
          <div class="card rounded shadow-sm">
            <div class="card-body">
              <div class="form-group row mb-3">
                <div class="col-sm-12" v-if="barang.gambar">
                  <img
                    class="gambar"
                    v-bind:src="apiUrl + '/storage/items/' + barang.gambar"
                    v-bind:alt="item.nama_item"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card rounded shadow-sm">
            <div class="card-body">
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Nama Item</label>
                <div class="col-sm-9">
                  <input
                    type="text"
                    class="form-control"
                    v-model="item.nama_item"
                    required
                    readonly
                  />
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Unit</label>
                <div class="col-sm-9">
                  <input
                    type="text"
                    class="form-control"
                    v-model="item.unit"
                    required
                    readonly
                  />
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Stok</label>
                <div class="col-sm-9">
                  <input
                    type="number"
                    class="form-control"
                    v-model="item.stok"
                    min="1"
                    required
                    readonly
                  />
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Harga Satuan</label>
                <div class="col-sm-9">
                  <input
                    type="number"
                    class="form-control"
                    v-model="item.harga_satuan"
                    min="1"
                    required
                    readonly
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.content-header {
  display: flex;
  flex-wrap: inherit;
  align-items: center;
  justify-content: space-between;
}
.content-header h4 {
  margin: 0;
}
.card-footer {
  text-align: center;
}
.gambar {
  width: 100%;
  height: 150px;
  object-fit: cover;
}
</style>

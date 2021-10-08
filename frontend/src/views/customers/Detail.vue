<script>
import { reactive, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";

import api, { apiUrl } from "../../api";

export default {
  setup() {
    const customer = reactive({
      nama: "",
      contact: "",
      email: "",
      alamat: "",
      diskon: "",
      tipe_diskon: "",
      ktp: null,
    });

    const ktp = reactive({
      gambar: "",
    });

    const router = useRouter();
    const route = useRoute();

    onMounted(() => {
      api.get(`/api/customers/${route.params.id}`).then((res) => {
        customer.nama = res.data.data.nama;
        customer.contact = res.data.data.contact;
        customer.email = res.data.data.email;
        customer.alamat = res.data.data.alamat;
        customer.diskon = res.data.data.diskon;
        customer.tipe_diskon = res.data.data.tipe_diskon;
        ktp.gambar = res.data.data.ktp;
      });
    });

    return { customer, ktp, router, apiUrl };
  },
};
</script>

<template>
  <div class="row">
    <div class="col-md-12 content-header">
      <h4>Detail Customer</h4>
      <router-link
        tag="a"
        class="btn btn-secondary"
        :to="{ name: 'customers.index' }"
        >Cancel</router-link
      >
    </div>
    <div class="col-md-12 mt-3 content-body">
      <div class="row">
        <div class="col-md-3">
          <div class="card rounded shadow-sm">
            <div class="card-body">
              <div class="form-group row mb-3">
                <div class="col-sm-12" v-if="ktp.gambar">
                  <img
                    class="gambar"
                    v-bind:src="apiUrl + '/storage/ktp/' + ktp.gambar"
                    v-bind:alt="customer.nama"
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
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input
                    type="text"
                    class="form-control"
                    v-model="customer.nama"
                    readonly
                    required
                  />
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Contact</label>
                <div class="col-sm-9">
                  <input
                    type="number"
                    class="form-control"
                    v-model="customer.contact"
                    readonly
                    required
                  />
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input
                    type="email"
                    class="form-control"
                    v-model="customer.email"
                    min="1"
                    readonly
                    required
                  />
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <textarea
                    type="text"
                    class="form-control"
                    v-model="customer.alamat"
                    readonly
                    required
                  ></textarea>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Diskon</label>
                <div class="col-sm-9">
                  <input
                    type="number"
                    class="form-control"
                    v-model="customer.diskon"
                    min="0"
                    readonly
                    required
                  />
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label">Tipe Diskon</label>
                <div class="col-sm-9">
                  <input
                    type="text"
                    class="form-control"
                    v-model="customer.tipe_diskon"
                    readonly
                    required
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

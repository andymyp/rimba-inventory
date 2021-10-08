<template>
  <div class="row">
    <div class="col-md-6">
      <div class="card text-center rounded shadow-sm">
        <div class="card-body">
          <h5 class="card-title">ITEMS</h5>
          <p class="card-text">
            <span class="number">10</span><br />
            <span class="total">Total items</span>
          </p>
          <router-link
            tag="a"
            class="btn btn-primary"
            :to="{ name: 'items.index' }"
            >Lihat</router-link
          >
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-center rounded shadow-sm">
        <div class="card-body">
          <h5 class="card-title">CUSTOMERS</h5>
          <p class="card-text">
            <span class="number">10</span><br />
            <span class="total">Total customers</span>
          </p>
          <router-link
            tag="a"
            class="btn btn-primary"
            :to="{ name: 'customers.index' }"
            >Lihat</router-link
          >
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-4">
      <div class="card text-center rounded shadow-sm">
        <div class="card-body">
          <h5 class="card-title">SALES</h5>
          <p class="card-text">
            <span class="number">10</span><br />
            <span class="total">Total sales</span>
          </p>
          <router-link
            tag="a"
            class="btn btn-primary"
            :to="{ name: 'sales.index' }"
            >Lihat</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.number {
  font-size: 3rem;
  font-weight: bold;
}
</style>

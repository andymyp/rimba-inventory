<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
      <router-link tag="a" class="navbar-brand" :to="{ name: 'home.index' }"
        >Inventory Penjualan</router-link
      >

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link
              tag="a"
              class="nav-link"
              class-active="active"
              :to="{ name: 'home.index' }"
              exact
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              tag="a"
              class="nav-link"
              class-active="active"
              :to="{ name: 'items.index' }"
              >Items</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              tag="a"
              class="nav-link"
              class-active="active"
              :to="{ name: 'customers.index' }"
              >Customers</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              tag="a"
              class="nav-link"
              class-active="active"
              :to="{ name: 'sales.index' }"
              >Sales</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<style>
.navbar-collapse {
  flex-grow: 0 !important;
}
.navbar-nav a {
  color: white !important;
}
.navbar-nav a.router-link-active,
.navbar-nav a.router-link-exact-active {
  font-weight: bold;
}
</style>

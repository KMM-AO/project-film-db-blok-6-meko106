<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
      <router-link to="/Home"><img src="@/assets/logo.png" style="width: 120px; height: 50px"/></router-link>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>

        <form class="d-flex">

          <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-item">
            <li class="nav-item dropdown">
              <a class="btn btn-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
              <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>
          <input class="form-control me-2 nav-item" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-light nav-item" type="submit">Search</button>
          <router-link to="/Home"><i class="fas fa-user fa-2x nav-item"></i></router-link>

        </form>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  
}
</script>
<style scoped>
.nav-item{
  margin-left: 20px;
}

.fas{
  color: black;
  }
</style>
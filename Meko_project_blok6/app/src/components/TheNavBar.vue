<template>
  <div class="root">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <router-link to="/Home" class="navbar-brand" href="#">Home</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          </ul>
          
          <form class="d-flex" action="https://www.google.com">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    
            </ul>
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
            
            <router-link to="/register"><i class="bi bi-box-arrow-right" style="font-size:40px" ></i></router-link>

          </form>
        </div>
      </div>
    </nav>
  </div>
</template>
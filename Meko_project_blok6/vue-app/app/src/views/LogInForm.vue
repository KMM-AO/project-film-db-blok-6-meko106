<template>
  <div class="form">
    <h1>Register From</h1>

    <div class="col mb-3" v-for="input in inputs" :key="input.name">
      <label class="col-sm-2 col-form-label" :for="input.name">
          {{input.name}}
      </label>
      <input :type="input.Type" />
    </div>

    <button type="submit" class="btn">Log in</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inputs: [
        { Type: "text", name: "Email" },
        { Type: "text", name: "Password" },
      ],
    };
  },
};
</script>

<style scoped>
.form {
  background: #fff;
  margin: 2rem auto;
  background-color: #f5f5f5;
  color: #4d4d4d;
  padding: 2rem;
  max-width: 45rem;
  width: 100%;
  font: 1.6rem/1.25 "Helvetica Neue", Helvetica, Arial, sans-serif;
  position: relative;
  box-shadow: 0 6px 4px 0 rgba(51, 50, 50, 0.2),
    0 2.5rem 5rem 0 rgba(0, 0, 0, 0.1);
}

.form h1 {
  display: block;
  min-width: 100%;
  width: 100%;
  text-align: center;
  margin: 0;
  margin-bottom: 1rem;
}

label , input, .routerlink{
      font: 1.4rem/1.25 "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.btn {
  background-color: gray;
  position: relative;
  right: 0;
}
</style>
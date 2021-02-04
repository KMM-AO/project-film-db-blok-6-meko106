<template>
  <div id="nav">
    <navbar></navbar>

    <router-view />
  </div>
</template>

<script>
import navbar from "@/components/TheNavBar";
export default {
  components: {
    navbar,
  },
};
</script>


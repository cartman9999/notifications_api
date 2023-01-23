<template>
  <main class="bg-slate-100">
    <Login v-show="!data.authenticated"/>
    <!-- <TheWelcome v-show="data.authenticated"/> -->
  </main>
</template>

<script setup>
// import TheWelcome from "../components/TheWelcome.vue";
import Login from "../components/Auth/Login.vue";
import { ref, reactive, computed, onMounted } from 'vue'
import { onBeforeMount } from 'vue'

const data = reactive({
  authenticated:  false,
  role_id: null,
})

// Check if user is authenticated, to display correctly the layout
onBeforeMount(async () => {
  // Look for access token
  const access_token = localStorage.getItem('api_access_token')

  // if token exists, then set authenticated as true
  if (access_token) {
    data.authenticated = true
  }
})
</script>
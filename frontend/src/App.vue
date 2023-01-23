<template>
  <header class="flex flex-row justify-between items-center px-10 py-2 bg-blue-600">
    <img
      alt="Vue logo"
      class="logo"
      src="@/assets/images/notify_logo.png"
      width="115"
      height="115"
    />

    <div class="wrapper text-white">
        <nav>
          <RouterLink
          class="mr-5" 
          to="/courses"
          v-show="data.authenticated"
          >
            Courses
          </RouterLink>
          <RouterLink
          class="mr-5" 
          to="/notifications"
          v-show="data.authenticated && data.role_id == 1"
          >
            Notifications
          </RouterLink>
          <RouterLink
          v-show="!data.authenticated"
          class="mr-5" 
          to="/">
            Login
          </RouterLink>
          <button 
          v-if="data.authenticated"
          @click.prevent="logout">
            Log Out
          </button>
        </nav>
    </div>
  </header>

  <RouterView />
</template>

<script setup>
import { RouterLink, RouterView } from "vue-router"
import router from "@/router"
import { reactive, computed, onMounted } from 'vue'
import { onBeforeMount } from 'vue'

const data = reactive({
  authenticated:  false,
  role_id: null,
})

async function logout() {
    // Prepare options for API request
    const options = {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'x-access-token': localStorage.getItem('api_access_token')
      }
    }
    console.log("ggg")
    
    // Execute API request to Login
    const response = await fetch("http://127.0.0.1:5000/api/logout", options)
    console.log(response)

    if (response.status == 200) {
      // Remove local storage variables
      localStorage.removeItem('api_access_token')
      localStorage.removeItem('role_id')
      localStorage.removeItem('organization_id')
      localStorage.removeItem('full_name')

      // Redirect
      router.push({ name: 'home' })
    }
}

// Check if user is authenticated, to display correctly the layout
onBeforeMount(async () => {
  // Look for access token
  const access_token = localStorage.getItem('api_access_token')

  // if token exists, then set authenticated as true
  if (access_token) {
    data.authenticated = true
    data.role_id = localStorage.getItem('role_id')
  }
})
</script>
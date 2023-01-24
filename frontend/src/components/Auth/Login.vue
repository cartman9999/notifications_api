<template>
    <section class="w-screen h-screen flex flex-col justify-center items-center">
        <div class="block mb-20">
            <img :src="logo" class="w-[200px] h-[100px]"/>
        </div>
        <div class="w-[300px] md:w-[400px] lg:w-[500px]">
            <div 
            class="bg-red-400 text-white text-center mb-4"
            v-show="data.errors"
            >
                <h3 class="font-bold">Error:</h3>
                <p>{{ data.message }}</p>
            </div>
            <form @submit.prevent="onSubmit" class="flex flex-col">
                <div class="flex flex-col mb-4">
                    <label for="username" class="font-semibold">E-mail:</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="E-mail"
                        v-model="data.email"
                        required
                        class="mt-2 bg-transparent border-b-2 border-yellow-400">
                </div>

                <div class="flex flex-col mb-4">
                    <label for="password" class="font-semibold">Password:</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Password"
                        v-model="data.password"
                        required
                        class="mt-2 bg-transparent border-b-2 border-yellow-400">
                </div>
                <button type="submit" class="rounded font-bold text-lg bg-yellow-400 hover:bg-yellow-600 py-2">Log In</button>
            </form>
        </div>
    </section>
</template>

<script setup>
import logo from '@/assets/images/notify_logo.png'
import router from "@/router"
import { reactive } from 'vue'
import apiConf from '@/config/api.js'

const data = reactive({
    email: null,
    password: null,
    errors: false,
    message: null
})

async function onSubmit() {
    // Prepare options for API request
    const options = {
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }
    
    // Execute API request to Login
    const url = `${apiConf.baseUrl}/login`
    const response = await fetch(url, options)
    const content = await response.json()

    // If 401, show errors
    if (response.status == 401) {
        data.errors = true
        data.message = "Incorrect credentials."
    }

    // Unexpected error
    if (!(response.status == 200 || response.status == 401)) {
        console.log("Si entra")
        data.errors = true
        data.message = "Unexpected error, please contact your administrator."
    }

    // If login sucessfully, then redirect
    if (response.status == 200) {
        // Set local storage variables
        localStorage.setItem('api_access_token', content.access_token)
        localStorage.setItem('role_id', content.role_id)
        localStorage.setItem('organization_id', content.organization_id)
        localStorage.setItem('full_name', `${content.name} ${content.last_name}`)

        // Clean data
        data.errors = false
        data.message = null

        // Redirect
        router.push({ name: 'courses' })
    }  
}
</script>
<template>
    <section>
        <h2 class="text-center text-2xl font-extrabold my-6">Courses</h2>
        <div class="flex flex-col md:flex-row justify-center items-center">
            <div 
            v-for="course in data.courses[0]" key="{{ course.id }}"
            class="w-[260px] md:w-[400px] h-[300px] md:h-[250px] flex flex-col bg-slate-200 px-3 ml-8 mb-8">
                <h3 class="text-blue-700 text-lg font-semibold">{{ course.name }}</h3>
                <p>Author: <span>{{ course.author }}</span></p>
                <p>{{ course.description }}</p>
                <RouterLink
                class="mr-5" 
                :to="courseUrl(course.id)">
                    <button class="rounded w-full text-center text-white bg-blue-700 font-bold mt-3">Watch</button>
                </RouterLink>
            </div>
        </div>
    </section>
</template>

<script setup>
import { useRoute } from 'vue-router';
import { reactive, onBeforeMount } from 'vue'

const data = reactive({
    courses: []
})

function courseUrl(id) {
    return `/courses/${id}`
}

onBeforeMount(async () => {
    // Obtain Course Details
    // Prepare options for API request
    const options = {
        method: 'GET',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'x-access-token': localStorage.getItem('api_access_token')
        }
    }
    
    const base_url = "http://127.0.0.1:5000/api/"
    const endpoint = `courses`

    // Execute API request to get course detail
    const response = await fetch(base_url+endpoint, options)
    const content = await response.json();

    // Insert courses content into data
    data.courses.push(content)
})

</script>

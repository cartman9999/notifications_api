<template>
    <section class="flex flex-col justify-center items-center mt-10">
        <div 
        v-if="data.message"
        class="w-full h-[30px] pt-[5px] bg-red-500 text-white text-center">
        {{ data.message }}
        </div>
        <div class="flex flex-col w-[280px] sm:w-[400px] md:w-[800px] bg-slate-200 p-4">
            <h2>{{ data.title }}</h2>
            <p class="mb-4">Author: {{ data.author }}</p>
            <div class="flex flex-col md:flex-row">
                <iframe width="240" height="315"
                :src="data.video_url">
                </iframe>
                <p class="ml-4">{{ data.description }}</p>
            </div>

            <button 
            class="w-full bg-blue-700 text-white rounded mt-4"
            v-if="!data.watched"
            @click.prevent="setCourseWatched"
            >
            Mark watched
            </button>

            <button 
            class="w-full bg-blue-400 text-white rounded mt-4"
            disabled
            v-else
            >
            Course Completed
            </button>
        </div>
    </section>
</template>

<script setup>
// import router from "@/router"
import { useRoute } from 'vue-router';
import { reactive, onBeforeMount } from 'vue'
import apiConf from '@/config/api.js'

const data = reactive({
    course_id: null,
    title: null,
    author: null,
    description: null,
    video_url: null,
    watched: false,
    message: null
})

// Call API to set course as watched and create notification for admin
async function setCourseWatched() {
    // Prepare options for API request
    const bodyParams = {
        course_id: data.course_id
    }

    const options = {
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'x-access-token': localStorage.getItem('api_access_token')
        },
        body: JSON.stringify(bodyParams)
    }
    
    const url = apiConf.baseUrl + "/courses/completed"

    // Execute API Request to mark course as watched
    const response = await fetch(url, options)
    const content = await response.json();

    // Set data watched as true if status is 201, else show error
    if (response.status == 201) {
        data.message = null
        data.watched = true
    } else {
        data.message = "Error while trying to update course status."
    }
}

// Read data from API before mounting the component
onBeforeMount(async () => {
    const route = useRoute()
    const course_id = route.params.course_id // read parameter id (it is reactive) 

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
    
    // Define Url
    const url = `${apiConf.baseUrl}/courses/${course_id}`

    // Execute API request to get course detail
    const response = await fetch(url, options)
    const content = await response.json();

    // Insert response content into data object
    data.course_id = content.course.id
    data.title = content.course.name
    data.author = content.course.author
    data.description = content.course.description
    data.video_url = content.course.video_url
    data.watched = content.watched
})

</script>

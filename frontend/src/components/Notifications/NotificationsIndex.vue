<template>
    <section>
        <section class="flex flex-col justify-center items-center w-full">
            <h2 class="text-center text-2xl font-extrabold my-6">New Notifications</h2>
            <div 
            v-for="notification in unReadNotifications"
            key="{{ notification.id }}"
            v-if="unReadNotifications.length"
            class="flex flex-row justify-center items-center px-8 md:px-20 w-full mb-4"
            >
                <div class="flex flex-col justify-center items-center rounded w-[75%] h-[100px] md:h-[60px] bg-blue-400">
                    <div class="w-full pl-6">{{ `${notification.notification_id} ${notification.name} ${notification.last_name}: ${notification.event}` }}</div>
                    <div class="w-full pl-6 text-slate-600">{{ notification.created_at_string }}</div>
                </div>
                <div class="w-[25%] h-[100px] md:h-[60px] ml-4 rounded">
                    <button 
                    @click.prevent="confirmReadNotification(notification.notification_id)"
                    class="rounded bg-green-500 text-white w-full h-full"
                    >
                    Confirm
                    </button>
                </div>
            </div>
            <h3 v-else>No new notifications. Come back later!</h3>
        </section>

        <section class="flex flex-col justify-center items-center w-full">
            <h2 class="text-center text-2xl font-extrabold my-6">Read Notifications</h2>
            <div 
            v-for="notification in readNotifications"
            key="{{ notification.id }}"
            v-if="readNotifications.length"
            class="flex flex-row justify-center items-center px-8 md:px-20 w-full mb-4"
            >
                <div class="flex flex-col justify-center items-center rounded w-full h-[100px] md:h-[60px] bg-blue-400">
                    <div class="w-full pl-6">{{ `${notification.name} ${notification.last_name}: ${notification.event}` }}</div>
                    <div class="w-full pl-6 text-slate-600">{{ notification.created_at_string }}</div>
                </div>
            </div>
            <h3 v-else>No new notifications. Come back later!</h3>
        </section>
    </section>

</template>

<script setup>
import { computed, reactive, onBeforeMount } from 'vue'

const data = reactive({
    notifications: []
})

const unReadNotifications = computed(() => {
    return data.notifications[0].filter(notification => notification.read_at === null)
})

const readNotifications = computed(() => {
    return data.notifications[0].filter(notification => notification.read_at)
})

// Set notification as Read
async function confirmReadNotification(notification_id) {
    // Obtain notification index inside notifications array
    const notificationIndex = data.notifications[0].findIndex(notification => notification.notification_id == notification_id)

    // Set notification as read
    const current_timestamp = new Date().toISOString().replace(/T/, ' ').replace(/\..+/, '')

    data.notifications[0][notificationIndex].read_at = current_timestamp
    
    // Update API
    // Prepare options for API request
    const body_payload = { notification_id }
    
    const options = {
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'x-access-token': localStorage.getItem('api_access_token')
        },
        body: JSON.stringify(body_payload)
    }
    
    const base_url = "http://127.0.0.1:5000/api/"
    const endpoint = `notifications/update`

    // Execute API request to Login
    const response = await fetch(base_url + endpoint, options)
    const content = await response.json()

}

// Obtain notifications
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
    const endpoint = `notifications`

    // Execute API request to get course detail
    const response = await fetch(base_url+endpoint, options)
    const content = await response.json()

    // Insert courses content into data
    data.notifications.push(content.notifications)
})
</script>
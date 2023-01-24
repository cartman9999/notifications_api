<template>
    <section>
        <NotificationsList
        :notifications="unReadNotifications"
        :title="'New Notifications'"
        :unread="true"
        @confirmReadNotification="confirmReadNotification"
        >
            No new notifications. Come back later!
        </NotificationsList>

        <NotificationsList
        :notifications="readNotifications"
        :title="'Read Notifications'"
        :unread="false"
        @confirmReadNotification="confirmReadNotification"
        >
            -
        </NotificationsList>
    </section>
</template>

<script setup>
import { computed, reactive, onBeforeMount } from 'vue'
import apiConf from '@/config/api.js'
import NotificationsList from './NotificationsList.vue'

// DATA
const data = reactive({
    notifications: []
})

// COMPUTED
const unReadNotifications = computed(() => {
    return data.notifications[0].filter(notification => notification.read_at === null)
})

const readNotifications = computed(() => {
    return data.notifications[0].filter(notification => notification.read_at)
})

// METHODS
// Set notification as read
async function confirmReadNotification(notification_id) {
    // Obtain notification index inside notifications array
    const notificationIndex = data.notifications[0].findIndex( (notification) => notification.notification_id == notification_id)

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
    
    // Define URL
    const url = `${apiConf.baseUrl}/notifications/update`

    // Execute API request to Login
    const response = await fetch(url, options)
    const content = await response.json()
}

// Obtain notifications
onBeforeMount(async () => {
    // Prepare options for API request
    const options = {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'x-access-token': localStorage.getItem('api_access_token')
        }
    }
    
    // Define URL
    const url = `${apiConf.baseUrl}/notifications`

    // Execute API request to get course detail
    const response = await fetch(url, options)
    const content = await response.json()

    // Insert courses content into data
    data.notifications.push(content.notifications)
})
</script>
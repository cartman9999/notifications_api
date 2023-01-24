<template>
    <section class="flex flex-col justify-center items-center w-full">
            <h2 class="text-center text-2xl font-extrabold my-6">{{ title }}</h2>
            <div 
            v-for="notification in notifications"
            key="{{ notification.id }}"
            v-show="notifications.length"
            class="flex flex-row justify-center items-center px-8 md:px-20 w-full mb-4"
            >
                <div 
                class="flex flex-col justify-center items-center rounded h-[100px] md:h-[60px] bg-blue-400 text-xs sm:text-base"
                :class="{ 'w-[75%]': unread, 'w-full': !unread }">
                    <div class="w-full pl-6">{{ `${notification.name} ${notification.last_name}: ${notification.event}` }}</div>
                    <div class="w-full pl-6 text-slate-600">{{ notification.created_at_string }}</div>
                </div>
                <div 
                class="w-[25%] h-[100px] md:h-[60px] ml-4 rounded"
                v-show="unread"
                >
                    <button 
                    @click.prevent="confirmReadNotification(notification.notification_id)"
                    class="w-full h-full rounded bg-green-500 text-white text-xs sm:text-base"
                    >
                    Confirm
                    </button>
                </div>
            </div>
            <h3 v-show="notifications.length == 0">
                <slot></slot>
            </h3>
        </section>
</template>

<script setup>
// PROPS
const props = defineProps([
                    'notifications',
                    'title',
                    'unread'
                ])

// EMITS
const emit = defineEmits(['confirmReadNotification'])

const confirmReadNotification = (notification_id) => {
    emit('confirmReadNotification', notification_id)
}
</script>
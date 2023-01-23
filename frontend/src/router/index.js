import { createRouter, createWebHistory } from "vue-router"
import HomeView from "../views/HomeView.vue"
import CoursesIndex from "../components/Courses/CoursesIndex.vue"
import CoursesShow from "../components/Courses/CoursesShow.vue"
import NotificationsIndex from "../components/Notifications/NotificationsIndex.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/courses",
      name: "courses",
      component: CoursesIndex,
    },
    {
      path: "/courses/:course_id",
      name: "showCourse",
      component: CoursesShow,
    },
    {
      path: "/notifications",
      name: "notifications",
      component: NotificationsIndex,
    },
  ],
});

export default router;

import Vue from "vue";
import VueRouter from "vue-router"
import Fallback from "../layout/Fallback";
import examList from "../components/examList";
import examLayout from "../layout/examLayout";
import examView from "../components/examView";

Vue.use(VueRouter);

const routes = [
    {
      path: "/",
      component: examLayout,
      children: [
          {
              path: '',
              component: examList
          },
          {
              path: 'view/:exam_id',
              name: "Exam View",
              component: examView
          }
      ]
    },
    {
        path: "*",
        component: Fallback,
    },
]

const router  = new VueRouter({
    mode: "hash",
    routes
});

export default router;

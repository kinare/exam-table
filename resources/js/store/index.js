import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);


export default new Vuex.Store({
    state: {
        exams: [],
        exam: [],
        categories: []
    },
    mutations: {
        SET_EXAMS: (state, payload) => {
            state.exams = payload
        },

        SET_EXAM: (state, payload) => {
            state.exam = payload
        },

        SET_CATEGORIES: (state, payload) => {
            state.categories = payload
        }
    },
    getters: {
        exams: state => state.exams,
        exam: state => state.exam,
        categories: state => state.categories,
    },

    actions: {
        getExams: context => {
            axios.get('/api/exams').then(res => {
                context.commit('SET_EXAMS', res.data)
            })
        },

        getExam: (context, exam_id) => {
            axios.get( `/api/exams/${exam_id}`).then(res => {
                context.commit('SET_EXAM', res.data)
            })
        },

        submitExam: ({dispatch}, exam) => {
            axios.post( `/api/exams/${exam.id}/submit`, exam).then(() => {
                dispatch('getExam', exam.id)
            })
        },

        getCategories: (context) => {
            axios.get( `/api/categories`).then(res => {
                context.commit('SET_CATEGORIES', res.data)
            })
        },

        addExam: ({dispatch}, exam) => {
            axios.post( `/api/exams/`, exam).then((res) => {
                Event.$emit('added-exam', res.data)
            })
        },

        removeExam: ({dispatch}, exam) => {
            axios.delete( `/api/exams/${exam.id}`).then(() => {
                dispatch('getExams')
            })
        },

        addQuestion: ({dispatch}, question) => {
            axios.post( `/api/questions`, question).then(() => {
                dispatch('getExam', question.exam_id)
            })
        },

        removeQuestion: ({dispatch}, question ) => {
            axios.delete( `/api/questions/${question.id}`).then(() => {
                dispatch('getExam', question.exam_id)
            })
        },

        updateQuestion: ({dispatch}, question) => {
            axios.patch( `/api/questions/${question.id}`, question).then(() => {
                dispatch('getExam', question.exam_id)
            })
        },
    }
})

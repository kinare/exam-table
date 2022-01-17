<template>
    <v-container>
        <v-row>
            <v-col cols="12" offset-md="4" md="4">
                <v-card>
                    <v-card-title>
                        Exam List
                        <v-spacer />

                        <v-btn color="primary" small @click="dialog = true">
                            Add Exam
                        </v-btn>
                    </v-card-title>
                    <v-divider />

                    <v-card-text>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item v-for="(exam, i) in exams" :key="i">
                                    <v-list-item-avatar>{{ i + 1 }}</v-list-item-avatar>
                                    <v-list-item-content>
                                        <v-list-item-title>{{ exam.name }}</v-list-item-title>
                                        <v-list-item-subtitle>{{ exam.description }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                    <v-list-item-action>
                                        <v-btn small icon @click="removeExam(exam)">
                                            <v-icon>mdi-delete</v-icon>
                                        </v-btn>
                                    </v-list-item-action>

                                    <v-list-item-action>
                                        <v-btn small icon :to="{ name: 'Exam View', params: {exam_id: exam.id}}">
                                            <v-icon>mdi-arrow-right</v-icon>
                                        </v-btn>
                                    </v-list-item-action>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="text-h5 grey lighten-2">
                    Add Exam
                </v-card-title>

                <v-divider />

                <v-card-text class="mt-5">
                    <v-text-field outlined label="Exam Name" v-model="formData.name"/>
                    <v-textarea outlined label="Exam Description" v-model="formData.description"/>
                </v-card-text>


                <v-card-actions>
                    <v-spacer />
                    <v-btn
                        text
                        @click="dialog = false"
                    >
                        Cancel
                    </v-btn>

                    <v-btn
                        color="primary"
                        text
                        @click="addExam"
                    >
                        Add Exam
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>


    </v-container>
</template>

<script>
export default {
    name: "examList",

    data: function(){
        return {
            dialog: false,
            formData: {
                name: "",
                description: ""
            }
        }
    },

    mounted() {
        Event.$on('added-exam', data => {
            this.$router.push({ name: 'Exam View', params: {exam_id: data.id}})
        })
    },

    beforeCreate() {
        this.$store.dispatch('getExams')
    },

    computed: {
        exams(){
            return this.$store.getters['exams']
        }
    },

    methods: {
        addExam: function (){
            this.$store.dispatch('addExam', this.formData)
        },

        removeExam: function (exam){
            this.$store.dispatch('removeExam', exam)
        }
    }
}
</script>

<style scoped>

</style>

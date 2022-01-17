<template>
    <v-container>
        <v-row>
            <v-col cols="12" offset-md="3" md="6">
                <v-card>

                    <v-toolbar flat>

                        <v-toolbar-title>Exam Questions</v-toolbar-title>

                        <v-spacer />

                        <v-btn color="primary" small @click="dialog = true">
                            Add Question
                        </v-btn>

                        <template v-slot:extension>
                            <v-tabs grow>
                                <v-tab v-for="(cat, i) in categories" :key="i" @click="category = cat.id">
                                    {{ cat.description }}
                                </v-tab>
                            </v-tabs>
                        </template>

                    </v-toolbar>


                    <v-divider />


                    <v-card-text v-for="(question, i) in questions" :key="i">

                        <v-icon @click="removeQuestion(question)" v-ripple class="float-end" small color="error">mdi-delete</v-icon>
                        <v-icon @click="editQuestion(question)" v-ripple class="float-end" small color="primary">mdi-pencil</v-icon>

                        <h4 class="subtitle-1">
                            {{ i + 1 }}. {{ question.question }}
                        </h4>
                        <v-radio-group v-model="question.option_id" class="ml-5">
                            <v-radio  v-for="(option, n) in question.options" :key="n" :label="option.description" :value="option.id"/>
                        </v-radio-group>
                    </v-card-text>

                    <v-divider />

                    <v-card-actions>
                        <v-spacer />

                        <v-btn color="primary" small @click="submit">
                            Submit
                        </v-btn>
                    </v-card-actions>


                </v-card>
            </v-col>
        </v-row>


        <v-dialog persistent v-model="dialog" width="500">
            <v-card>
                <v-card-title class="text-h5 grey lighten-2" >
                    Add Question
                </v-card-title>

                <v-divider />

                <v-card-text class="mt-5">
                    <v-select dense outlined label="Category" v-model="formData.category_id" :items="categories" item-value="id" item-text="description" />
                    <v-textarea dense outlined label="Question" v-model="formData.question" />
                    <v-text-field v-if="!editing" dense outlined label="Option One" v-model="formData.options[0]"/>
                    <v-text-field v-if="!editing" dense outlined label="Option Two" v-model="formData.options[1]"/>
                    <v-text-field v-if="!editing" dense outlined label="Option Three" v-model="formData.options[2]"/>
                    <v-text-field v-if="!editing" dense outlined label="Option Four" v-model="formData.options[3]"/>

                    <v-text-field v-if="editing" v-for="(option, i) in formData.options" :key="i" dense outlined label="Option Four" v-model="option.description"/>
                </v-card-text>


                <v-card-actions>
                    <v-spacer />
                    <v-btn text  @click="clearForm" >
                        Cancel
                    </v-btn>

                    <v-btn v-if="!editing" color="primary"  @click="addQuestion" >
                        Add Question
                    </v-btn>

                    <v-btn v-else color="primary"  @click="updateQuestion" >
                        Save Question
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>


    </v-container>
</template>

<script>
export default {
    name: "examView",

    data: function(){
        return {
            dialog: false,
            editing: false,
            formData: {
                question: "",
                options: []
            },
            category: 1,
            options: [],
        }
    },

    beforeRouteEnter(to, from, next){
        next( v=> {
            v.$store.dispatch('getExam', v.$route.params.exam_id);
            v.$store.dispatch('getCategories');
        })
    },

    computed: {
        exam(){
            return this.$store.getters['exam']
        },

        questions(){

            return this.exam && this.exam.questions ?  this.exam.questions.filter( q => q.category_id === this.category) : []
        },

        categories(){
            return this.$store.getters['categories']
        }
    },

    methods: {
        addQuestion: function (){
            this.$store.dispatch('addQuestion', { ...this.formData, exam_id: this.$route.params.exam_id});
            this.clearForm()
        },

        clearForm: function (){
            this.formData= {
                question: "",
                options: []
            }
            this.dialog = false;
            this.editing = false;
        },

        removeQuestion: function (question){
            this.$store.dispatch('removeQuestion', question)
        },

        submit: function (){
            this.$store.dispatch('submitExam', { ...this.exam });
            this.clearForm()
        },

        updateQuestion: function (){
            this.$store.dispatch('updateQuestion', this.formData)
            this.clearForm()
        },

        editQuestion: function (question){
            this.formData = { ... question }
            this.editing = true;
            this.dialog = true;
        }
    }
}
</script>

<style scoped>

</style>

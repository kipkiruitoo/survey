<script >
// import Layout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/vue3';
import "survey-core/defaultV2.min.css";
import "survey-creator-core/survey-creator-core.min.css";

import { SurveyCreator } from "survey-creator-knockout";

const creatorOptions = {
    showLogicTab: true,
    isAutoSave: true,
    showThemeTab: true,
    showJSONEditorTab: true,
    showTranslationTab: true,
    haveCommercialLicense: true,
    showErrorOnFailedSave: true,
    showPagesInPreviewTab:true,
    previewOrientation: "portrait"
};

export default {
    name: "survey-creator",
    data() {
        return {
            survey: {},
            surveyName: '',
            nameField: false,
        }
    },
    mounted() {
        let creator = new SurveyCreator(creatorOptions);
        creator
        creator.render("surveyCreator");
        creator.saveSurveyFunc = (saveNo, callback) => {

        }
    },

    methods:  {
        getSurvey(id) {
                axios.get('/survey/' + id)
                    .then((response) => {
                        this.survey = response.data.data;
                        this.surveyName = response.data.data.name;
                    })
                    .catch((error) => {
                        console.log(error.response)
                    })
            },
            onCancelEdit() {
                this.nameField = false;
                this.surveyName = this.survey.name;
            },
            postEdit() {
                axios.put('/survey/' + this.survey.id, {name: this.surveyName})
                    .then((response) => {
                        this.nameField = false;
                        this.$root.snackbarMsg = response.data.message;
                        this.$root.snackbar = true;
                    })
                    .catch((error) => {
                        console.error(error.response);
                    })
            }
    }
}

// const props = defineProps(['user']);
</script>
 
<template>
    <Head title="Create a Survey" />

    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a Survey
            </h2>
        </template>

        <div class="py-12">
            <div id="surveyCreator" />
        </div>
    </Layout>
</template>

<style scoped>
#surveyCreator {
    height: 100vh;
    width: 100vw;
}
</style>
<script >
// import Layout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/vue3';
import "survey-core/defaultV2.min.css";
import "survey-creator-core/survey-creator-core.min.css";
import "axios";

import { SurveyCreator } from "survey-creator-knockout";

// const props = ['structure'];
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
    props:['structure', 'surveyid', 'name'],
    data() {
        return {
            survey: {},
            surveyName: '',
            nameField: false,
        }
    },
    mounted() {
        let creator = new SurveyCreator(creatorOptions);
        
        creator.render("surveyCreator");
        creator.text = this.structure;
        console.log(this.structure);
        // console.warn("The survey id is",this.surveyid);
        let curr = window.location.href;
        let ida = curr.split("/")
        creator.saveSurveyFunc = (saveNo, callback) => {
            saveSurveyJson(
          "https://test.survey/api/surveys/create/" + ida.at(-1),

          creator.JSON,
          saveNo,
          callback
      );
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

function saveSurveyJson(url, json, saveNo, callback) {

    let formData = new FormData();
    // formData.append("structure", )

    axios.put(url, {
        'json': JSON.stringify(json)
    })
  .then(response => {
    if (response.ok) {
      callback(saveNo, true);
    } else {
      callback(saveNo, false);
    }
  })
  .catch(error => {
    callback(saveNo, false);
  });
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
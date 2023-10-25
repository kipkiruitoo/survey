


<template>
    <Head :title=props.name>

    </Head>



    <div >
        <SurveyComponent height="100vh" :model="survey" />
    </div>
</template>
<script setup>
import { Model } from "survey-core";
// import { surveyPlugin } from "survey-vue3-ui";
import "survey-core/defaultV2.min.css";
// import {Layout} from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/vue3';
import {v4 as uuidv4} from 'uuid';
import axios from "axios";
import { LayeredDarkPanelless } from "survey-core/themes/layered-dark-panelless";



const props = defineProps(['structure', 'surveyid', 'name']);

const survey = new Model(props.structure);
// survey.applyTheme(LayeredDarkPanelless);
// console.log(props.structure);
survey.onComplete.add((sender, options) => {
    let curr = window.location.href;
    let ida = curr.split("/")
    saveSurveyResults("/api/survey/" +ida.at(-1) +"/result" , sender.data)
});

function saveSurveyResults(url,json) {
    axios.post(url, {
        'uuid': uuidv4(),
        'json': JSON.stringify(json)
    })
        .then(response => {
            if (response.ok) {

            } else {
                // Handle error
            }
        })
        .catch(error => {
            // Handle error
        });
}



</script>

<style>
.survey{
    height: 100vh;
}</style>
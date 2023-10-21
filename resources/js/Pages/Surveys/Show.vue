


<template>
    <Head :title=props.name>

    </Head>
   
        
 
        <div class="py-12">
            <SurveyComponent  :model="survey" />
        </div>
   

   
</template>
<script setup lang="ts" >
import { Model } from "survey-core";
// import { surveyPlugin } from "survey-vue3-ui";
import "survey-core/defaultV2.min.css";
// import {Layout} from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['structure', 'surveyid', 'name']);

const survey = new Model(props.structure);
// console.log(props.structure);
survey.onComplete.add((sender, options) => {
    console.log(JSON.stringify(sender.data, null, 3));
});
survey.data = { 
    "nps-score": 9,
    "promoter-features": [
        "performance",
        "ui"
    ]
};


</script>

<style></style>
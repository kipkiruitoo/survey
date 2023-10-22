<template>
    <Head :title="'Survey Results - ' +this.name  " />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Survey Results - {{ this.name }}</h2>
        </template>
        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <button @click="jsonToCsv()" type="button"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Export
                    as CSV</button>
            </div>
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div id="surveyVizPanel" />
            </div>
        </div>

    </AuthenticatedLayout>
</template>
  
<script>
import 'survey-analytics/survey.analytics.min.css';
import { Model } from 'survey-core';
import { VisualizationPanel } from 'survey-analytics';
import { json2csv } from 'json-2-csv';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


//   const props = defineProps();


const vizPanelOptions = {
    allowHideQuestions: true,
    haveCommercialLicense: true,
}

export default {
    props: ['results', 'structure', 'surveyid', 'name'],
    name: 'survey-analytics',
    components: {
        Head,
        AuthenticatedLayout
    },
    mounted() {

        const results = JSON.parse(this.results);
        // console.log(this.structure);

        const survey = new Model(this.structure);
        const vizPanel = new VisualizationPanel(
            survey.getAllQuestions(),
            results,
            vizPanelOptions
        );
        vizPanel.showHeader = true;
        vizPanel.render(document.getElementById("surveyVizPanel"));

    },
    methods: {
        jsonToCsv() {
            let options = {
                "expandArrayObjects": true,
            }
            json2csv(JSON.parse(this.results), options).then((csv) => {

                console.log(csv);
                let anchor = document.createElement('a');
                anchor.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
                anchor.click();

            }).catch((error) => {
                console.error(error);
            });



        },
    }

}



</script>
<style>
.sa-toolbar__button{
    color: aliceblue;
}
</style>